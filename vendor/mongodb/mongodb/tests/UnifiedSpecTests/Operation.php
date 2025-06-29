<?php

namespace MongoDB\Tests\UnifiedSpecTests;

use Error;
use MongoDB\BSON\Javascript;
use MongoDB\ChangeStream;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use MongoDB\Driver\ClientEncryption;
use MongoDB\Driver\Cursor;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\GridFS\Bucket;
use MongoDB\Model\CollectionInfo;
use MongoDB\Model\DatabaseInfo;
use MongoDB\Model\IndexInfo;
use MongoDB\Operation\DatabaseCommand;
use MongoDB\Operation\FindOneAndReplace;
use MongoDB\Operation\FindOneAndUpdate;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Exception as PHPUnitException;
use stdClass;
use Throwable;

use function array_diff_key;
use function array_intersect_key;
use function array_key_exists;
use function array_map;
use function current;
use function fopen;
use function fwrite;
use function get_class;
use function hex2bin;
use function iterator_to_array;
use function key;
use function MongoDB\with_transaction;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsInt;
use function PHPUnit\Framework\assertIsObject;
use function PHPUnit\Framework\assertIsString;
use function PHPUnit\Framework\assertMatchesRegularExpression;
use function PHPUnit\Framework\assertNotContains;
use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertObjectHasAttribute;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\equalTo;
use function PHPUnit\Framework\logicalOr;
use function property_exists;
use function rewind;
use function stream_get_contents;
use function strtolower;

final class Operation
{
    public const OBJECT_TEST_RUNNER = 'testRunner';

    /** @var bool */
    private $isTestRunnerOperation;

    /** @var string */
    private $name;

    /** @var ?string */
    private $object;

    /** @var array */
    private $arguments = [];

    /** @var Context */
    private $context;

    /** @var EntityMap */
    private $entityMap;

    /** @var ExpectedError */
    private $expectError;

    /** @var ExpectedResult */
    private $expectResult;

    /** @var bool */
    private $ignoreResultAndError;

    /** @var string */
    private $saveResultAsEntity;

    public function __construct(stdClass $o, Context $context)
    {
        $this->context = $context;
        $this->entityMap = $context->getEntityMap();

        assertIsString($o->name);
        $this->name = $o->name;

        assertIsString($o->object);
        $this->isTestRunnerOperation = $o->object === self::OBJECT_TEST_RUNNER;
        $this->object = $this->isTestRunnerOperation ? null : $o->object;

        if (isset($o->arguments)) {
            assertIsObject($o->arguments);
            $this->arguments = (array) $o->arguments;
        }

        if (isset($o->ignoreResultAndError) && (isset($o->expectError) || property_exists($o, 'expectResult') || isset($o->saveResultAsEntity))) {
            Assert::fail('ignoreResultAndError is mutually exclusive with expectError, expectResult, and saveResultAsEntity');
        }

        if (isset($o->expectError) && (property_exists($o, 'expectResult') || isset($o->saveResultAsEntity))) {
            Assert::fail('expectError is mutually exclusive with expectResult and saveResultAsEntity');
        }

        $this->ignoreResultAndError = $o->ignoreResultAndError ?? false;
        $this->expectError = new ExpectedError($o->expectError ?? null, $this->entityMap);
        $this->expectResult = new ExpectedResult($o, $this->entityMap, $this->object);

        if (isset($o->saveResultAsEntity)) {
            assertIsString($o->saveResultAsEntity);
            $this->saveResultAsEntity = $o->saveResultAsEntity;
        }
    }

    /**
     * Execute the operation and assert its outcome.
     */
    public function assert(bool $rethrowExceptions = false): void
    {
        $error = null;
        $result = null;
        $saveResultAsEntity = null;

        try {
            $result = $this->execute();
            $saveResultAsEntity = $this->saveResultAsEntity;
        } catch (Throwable $e) {
            /* Rethrow any internal PHP errors and PHPUnit exceptions, since
             * those are never expected for "expectError".
             *
             * TODO: Consider adding operation details (e.g. operations[] index)
             * to the exception message. Alternatively, throw a new exception
             * and include this as the previous, since PHPUnit will render the
             * chain when reporting a test failure. */
            if ($e instanceof Error || $e instanceof PHPUnitException) {
                throw $e;
            }

            $error = $e;
        }

        if (! $this->ignoreResultAndError) {
            $this->expectError->assert($error);
            $this->expectResult->assert($result, $saveResultAsEntity);
        }

        // Rethrowing is primarily used for withTransaction callbacks
        if ($error && $rethrowExceptions) {
            throw $error;
        }
    }

    private function execute()
    {
        $this->context->setActiveClient(null);

        if ($this->isTestRunnerOperation) {
            return $this->executeForTestRunner();
        }

        $object = $this->entityMap[$this->object];
        assertIsObject($object);

        $this->context->setActiveClient($this->entityMap->getRootClientIdOf($this->object));

        switch (get_class($object)) {
            case Client::class:
                $result = $this->executeForClient($object);
                break;
            case ClientEncryption::class:
                $result = $this->executeForClientEncryption($object);
                break;
            case Database::class:
                $result = $this->executeForDatabase($object);
                break;
            case Collection::class:
                $result = $this->executeForCollection($object);
                break;
            case ChangeStream::class:
                $result = $this->executeForChangeStream($object);
                break;
            case Cursor::class:
                $result = $this->executeForCursor($object);
                break;
            case Session::class:
                $result = $this->executeForSession($object);
                break;
            case Bucket::class:
                $result = $this->executeForBucket($object);
                break;
            default:
                Assert::fail('Unsupported entity type: ' . get_class($object));
        }

        return $result;
    }

    private function executeForChangeStream(ChangeStream $changeStream)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(ChangeStream::class, $this->name, $args);

        switch ($this->name) {
            case 'iterateUntilDocumentOrError':
                /* Note: the first iteration should use rewind, otherwise we may
                 * miss a document from the initial batch (possible if using a
                 * resume token). We can infer this from a null key; however,
                 * if a test ever calls this operation consecutively to expect
                 * multiple errors from the same ChangeStream we will need a
                 * different approach (e.g. examining internal hasAdvanced
                 * property on the ChangeStream). */
                if ($changeStream->key() === null) {
                    $changeStream->rewind();

                    if ($changeStream->valid()) {
                        return $changeStream->current();
                    }
                }

                do {
                    $changeStream->next();
                } while (! $changeStream->valid());

                return $changeStream->current();

            default:
                Assert::fail('Unsupported change stream operation: ' . $this->name);
        }
    }

    private function executeForClient(Client $client)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Client::class, $this->name, $args);

        switch ($this->name) {
            case 'createChangeStream':
                assertArrayHasKey('pipeline', $args);
                assertIsArray($args['pipeline']);

                return $client->watch(
                    $args['pipeline'],
                    array_diff_key($args, ['pipeline' => 1])
                );

            case 'listDatabaseNames':
                return iterator_to_array($client->listDatabaseNames($args));

            case 'listDatabases':
                return array_map(
                    function (DatabaseInfo $info) {
                        return $info->__debugInfo();
                    },
                    iterator_to_array($client->listDatabases($args))
                );

            default:
                Assert::fail('Unsupported client operation: ' . $this->name);
        }
    }

    private function executeForClientEncryption(ClientEncryption $clientEncryption)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(ClientEncryption::class, $this->name, $args);

        switch ($this->name) {
            case 'addKeyAltName':
                assertArrayHasKey('id', $args);
                assertArrayHasKey('keyAltName', $args);

                return $clientEncryption->addKeyAltName($args['id'], $args['keyAltName']);

            case 'createDataKey':
                assertArrayHasKey('kmsProvider', $args);
                // CSFLE spec tests nest options under an "opts" key (see: DRIVERS-2414)
                $options = array_key_exists('opts', $args) ? (array) $args['opts'] : [];

                return $clientEncryption->createDataKey($args['kmsProvider'], $options);

            case 'deleteKey':
                assertArrayHasKey('id', $args);

                return $clientEncryption->deleteKey($args['id']);

            case 'getKey':
                assertArrayHasKey('id', $args);

                return $clientEncryption->getKey($args['id']);

            case 'getKeyByAltName':
                assertArrayHasKey('keyAltName', $args);

                return $clientEncryption->getKeyByAltName($args['keyAltName']);

            case 'getKeys':
                return iterator_to_array($clientEncryption->getKeys());

            case 'removeKeyAltName':
                assertArrayHasKey('id', $args);
                assertArrayHasKey('keyAltName', $args);

                return $clientEncryption->removeKeyAltName($args['id'], $args['keyAltName']);

            case 'rewrapManyDataKey':
                assertArrayHasKey('filter', $args);
                // CSFLE spec tests nest options under an "opts" key (see: DRIVERS-2414)
                $options = array_key_exists('opts', $args) ? (array) $args['opts'] : [];

                return static::prepareRewrapManyDataKeyResult($clientEncryption->rewrapManyDataKey($args['filter'], $options));

            default:
                Assert::fail('Unsupported clientEncryption operation: ' . $this->name);
        }
    }

    private function executeForCollection(Collection $collection)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Collection::class, $this->name, $args);

        switch ($this->name) {
            case 'aggregate':
                assertArrayHasKey('pipeline', $args);
                assertIsArray($args['pipeline']);

                return iterator_to_array($collection->aggregate(
                    $args['pipeline'],
                    array_diff_key($args, ['pipeline' => 1])
                ));

            case 'bulkWrite':
                assertArrayHasKey('requests', $args);
                assertIsArray($args['requests']);

                return $collection->bulkWrite(
                    array_map(
                        static function ($request) {
                            return self::prepareBulkWriteRequest($request);
                        },
                        $args['requests']
                    ),
                    array_diff_key($args, ['requests' => 1])
                );

            case 'createChangeStream':
                assertArrayHasKey('pipeline', $args);
                assertIsArray($args['pipeline']);

                return $collection->watch(
                    $args['pipeline'],
                    array_diff_key($args, ['pipeline' => 1])
                );

            case 'createFindCursor':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return $collection->find(
                    $args['filter'],
                    array_diff_key($args, ['filter' => 1])
                );

            case 'createIndex':
                assertArrayHasKey('keys', $args);
                assertInstanceOf(stdClass::class, $args['keys']);

                return $collection->createIndex(
                    $args['keys'],
                    array_diff_key($args, ['keys' => 1])
                );

            case 'dropIndex':
                assertArrayHasKey('name', $args);
                assertIsString($args['name']);

                return $collection->dropIndex(
                    $args['name'],
                    array_diff_key($args, ['name' => 1])
                );

            case 'count':
            case 'countDocuments':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return $collection->{$this->name}(
                    $args['filter'],
                    array_diff_key($args, ['filter' => 1])
                );

            case 'estimatedDocumentCount':
                return $collection->estimatedDocumentCount($args);

            case 'deleteMany':
            case 'deleteOne':
            case 'findOneAndDelete':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return $collection->{$this->name}(
                    $args['filter'],
                    array_diff_key($args, ['filter' => 1])
                );

            case 'distinct':
                if (isset($args['session']) && $args['session']->isInTransaction()) {
                    // Transaction, but sharded cluster?
                    $collection->distinct('foo');
                }

                assertArrayHasKey('fieldName', $args);
                assertArrayHasKey('filter', $args);
                assertIsString($args['fieldName']);
                assertInstanceOf(stdClass::class, $args['filter']);

                return $collection->distinct(
                    $args['fieldName'],
                    $args['filter'],
                    array_diff_key($args, ['fieldName' => 1, 'filter' => 1])
                );

            case 'drop':
                return $collection->drop($args);

            case 'find':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return iterator_to_array($collection->find(
                    $args['filter'],
                    array_diff_key($args, ['filter' => 1])
                ));

            case 'findOne':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return $collection->findOne(
                    $args['filter'],
                    array_diff_key($args, ['filter' => 1])
                );

            case 'findOneAndReplace':
                if (isset($args['returnDocument'])) {
                    $args['returnDocument'] = strtolower($args['returnDocument']);
                    assertThat($args['returnDocument'], logicalOr(equalTo('after'), equalTo('before')));

                    $args['returnDocument'] = 'after' === $args['returnDocument']
                        ? FindOneAndReplace::RETURN_DOCUMENT_AFTER
                        : FindOneAndReplace::RETURN_DOCUMENT_BEFORE;
                }
                // Fall through
            case 'replaceOne':
                assertArrayHasKey('filter', $args);
                assertArrayHasKey('replacement', $args);
                assertInstanceOf(stdClass::class, $args['filter']);
                assertInstanceOf(stdClass::class, $args['replacement']);

                return $collection->{$this->name}(
                    $args['filter'],
                    $args['replacement'],
                    array_diff_key($args, ['filter' => 1, 'replacement' => 1])
                );

            case 'findOneAndUpdate':
                if (isset($args['returnDocument'])) {
                    $args['returnDocument'] = strtolower($args['returnDocument']);
                    assertThat($args['returnDocument'], logicalOr(equalTo('after'), equalTo('before')));

                    $args['returnDocument'] = 'after' === $args['returnDocument']
                        ? FindOneAndUpdate::RETURN_DOCUMENT_AFTER
                        : FindOneAndUpdate::RETURN_DOCUMENT_BEFORE;
                }
                // Fall through
            case 'updateMany':
            case 'updateOne':
                assertArrayHasKey('filter', $args);
                assertArrayHasKey('update', $args);
                assertInstanceOf(stdClass::class, $args['filter']);
                assertThat($args['update'], logicalOr(new IsType('array'), new IsType('object')));

                return $collection->{$this->name}(
                    $args['filter'],
                    $args['update'],
                    array_diff_key($args, ['filter' => 1, 'update' => 1])
                );

            case 'insertMany':
                assertArrayHasKey('documents', $args);
                assertIsArray($args['documents']);

                return $collection->insertMany(
                    $args['documents'],
                    array_diff_key($args, ['documents' => 1])
                );

            case 'insertOne':
                assertArrayHasKey('document', $args);
                assertInstanceOf(stdClass::class, $args['document']);

                return $collection->insertOne(
                    $args['document'],
                    array_diff_key($args, ['document' => 1])
                );

            case 'listIndexes':
                return array_map(
                    function (IndexInfo $info) {
                        return $info->__debugInfo();
                    },
                    iterator_to_array($collection->listIndexes($args))
                );

            case 'mapReduce':
                assertArrayHasKey('map', $args);
                assertArrayHasKey('reduce', $args);
                assertArrayHasKey('out', $args);
                assertInstanceOf(Javascript::class, $args['map']);
                assertInstanceOf(Javascript::class, $args['reduce']);
                assertIsString($args['out']);

                return $collection->mapReduce(
                    $args['map'],
                    $args['reduce'],
                    $args['out'],
                    array_diff_key($args, ['map' => 1, 'reduce' => 1, 'out' => 1])
                );

            case 'rename':
                assertArrayHasKey('to', $args);
                assertIsString($args['to']);

                return $collection->rename(
                    $args['to'],
                    null, /* $toDatabaseName */
                    array_diff_key($args, ['to' => 1])
                );

            default:
                Assert::fail('Unsupported collection operation: ' . $this->name);
        }
    }

    private function executeForCursor(Cursor $cursor)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Cursor::class, $this->name, $args);

        switch ($this->name) {
            case 'close':
                /* PHPC does not provide an API to directly close a cursor.
                 * mongoc_cursor_destroy is only invoked from the Cursor's
                 * free_object handler, which requires unsetting the object from
                 * the entity map to trigger garbage collection. This will need
                 * a different approach if tests ever attempt to access the
                 * cursor entity after calling the "close" operation. */
                $this->entityMap->closeCursor($this->object);
                assertFalse($this->entityMap->offsetExists($this->object));
                break;
            case 'iterateUntilDocumentOrError':
                /* Note: the first iteration should use rewind, otherwise we may
                 * miss a document from the initial batch (possible if using a
                 * resume token). We can infer this from a null key; however,
                 * if a test ever calls this operation consecutively to expect
                 * multiple errors from the same ChangeStream we will need a
                 * different approach (e.g. examining internal hasAdvanced
                 * property on the ChangeStream). */

                /* Note: similar to iterateUntilDocumentOrError for ChangeStream
                 * entities, a different approach will be needed if a test ever
                 * calls this operation consecutively to expect multiple errors.
                 */
                if ($cursor->key() === null) {
                    $cursor->rewind();

                    if ($cursor->valid()) {
                        return $cursor->current();
                    }
                }

                do {
                    $cursor->next();
                } while (! $cursor->valid());

                return $cursor->current();

            default:
                Assert::fail('Unsupported cursor operation: ' . $this->name);
        }
    }

    private function executeForDatabase(Database $database)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Database::class, $this->name, $args);

        switch ($this->name) {
            case 'aggregate':
                assertArrayHasKey('pipeline', $args);
                assertIsArray($args['pipeline']);

                return iterator_to_array($database->aggregate(
                    $args['pipeline'],
                    array_diff_key($args, ['pipeline' => 1])
                ));

            case 'createChangeStream':
                assertArrayHasKey('pipeline', $args);
                assertIsArray($args['pipeline']);

                return $database->watch(
                    $args['pipeline'],
                    array_diff_key($args, ['pipeline' => 1])
                );

            case 'createCollection':
                assertArrayHasKey('collection', $args);
                assertIsString($args['collection']);

                return $database->createCollection(
                    $args['collection'],
                    array_diff_key($args, ['collection' => 1])
                );

            case 'dropCollection':
                assertArrayHasKey('collection', $args);
                assertIsString($args['collection']);

                return $database->dropCollection(
                    $args['collection'],
                    array_diff_key($args, ['collection' => 1])
                );

            case 'listCollectionNames':
                return iterator_to_array($database->listCollectionNames($args));

            case 'listCollections':
                return array_map(
                    function (CollectionInfo $info) {
                        return $info->__debugInfo();
                    },
                    iterator_to_array($database->listCollections($args))
                );

            case 'modifyCollection':
                assertArrayHasKey('collection', $args);
                assertIsString($args['collection']);

                /* ModifyCollection takes collection and command options
                 * separately, so we must split the array after initially
                 * filtering out the collection name.
                 *
                 * The typeMap option is intentionally omitted since it is
                 * specific to PHPLIB and will never appear in spec tests. */
                $options = array_diff_key($args, ['collection' => 1]);
                $collectionOptions = array_diff_key($options, ['session' => 1, 'writeConcern' => 1]);
                $options = array_intersect_key($options, ['session' => 1, 'writeConcern' => 1]);

                return $database->modifyCollection($args['collection'], $collectionOptions, $options);

            case 'runCommand':
                assertArrayHasKey('command', $args);
                assertInstanceOf(stdClass::class, $args['command']);

                // Note: commandName is not used by PHP
                $options = array_diff_key($args, ['command' => 1, 'commandName' => 1]);

                /* runCommand spec tests may execute commands that return a
                 * cursor (e.g. aggregate). PHPC creates a cursor automatically
                 * so cannot return the original command result. Existing spec
                 * tests do not evaluate the result, so we can return null here.
                 * If that changes down the line, we can use command monitoring
                 * to capture and return the command result. */
                return $database->command($args['command'], $options)->toArray()[0] ?? null;

            default:
                Assert::fail('Unsupported database operation: ' . $this->name);
        }
    }

    private function executeForSession(Session $session)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Session::class, $this->name, $args);

        switch ($this->name) {
            case 'abortTransaction':
                return $session->abortTransaction();

            case 'commitTransaction':
                return $session->commitTransaction();

            case 'endSession':
                return $session->endSession();

            case 'startTransaction':
                return $session->startTransaction($args);

            case 'withTransaction':
                assertArrayHasKey('callback', $args);
                assertIsArray($args['callback']);

                $operations = array_map(function ($o) {
                    assertIsObject($o);

                    return new Operation($o, $this->context);
                }, $args['callback']);

                $callback = function () use ($operations): void {
                    foreach ($operations as $operation) {
                        $operation->assert(true); // rethrow exceptions
                    }
                };

                return with_transaction($session, $callback, array_diff_key($args, ['callback' => 1]));

            default:
                Assert::fail('Unsupported session operation: ' . $this->name);
        }
    }

    private function executeForBucket(Bucket $bucket)
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(Bucket::class, $this->name, $args);

        switch ($this->name) {
            case 'delete':
                assertArrayHasKey('id', $args);

                return $bucket->delete($args['id']);

            case 'downloadByName':
                assertArrayHasKey('filename', $args);
                assertIsString($args['filename']);

                return stream_get_contents($bucket->openDownloadStreamByName(
                    $args['filename'],
                    array_diff_key($args, ['filename' => 1])
                ));

            case 'download':
                assertArrayHasKey('id', $args);

                return stream_get_contents($bucket->openDownloadStream($args['id']));

            case 'uploadWithId':
                assertArrayHasKey('id', $args);
                $args['_id'] = $args['id'];
                unset($args['id']);

                // Fall through

            case 'upload':
                $args = self::prepareUploadArguments($args);

                return $bucket->uploadFromStream(
                    $args['filename'],
                    $args['source'],
                    array_diff_key($args, ['filename' => 1, 'source' => 1])
                );

            default:
                Assert::fail('Unsupported bucket operation: ' . $this->name);
        }
    }

    private function executeForTestRunner()
    {
        $args = $this->prepareArguments();
        Util::assertArgumentsBySchema(self::OBJECT_TEST_RUNNER, $this->name, $args);

        switch ($this->name) {
            case 'assertCollectionExists':
                assertArrayHasKey('databaseName', $args);
                assertArrayHasKey('collectionName', $args);
                assertIsString($args['databaseName']);
                assertIsString($args['collectionName']);
                $database = $this->context->getInternalClient()->selectDatabase($args['databaseName']);
                assertContains($args['collectionName'], $database->listCollectionNames());
                break;
            case 'assertCollectionNotExists':
                assertArrayHasKey('databaseName', $args);
                assertArrayHasKey('collectionName', $args);
                assertIsString($args['databaseName']);
                assertIsString($args['collectionName']);
                $database = $this->context->getInternalClient()->selectDatabase($args['databaseName']);
                assertNotContains($args['collectionName'], $database->listCollectionNames());
                break;
            case 'assertIndexExists':
                assertArrayHasKey('databaseName', $args);
                assertArrayHasKey('collectionName', $args);
                assertArrayHasKey('indexName', $args);
                assertIsString($args['databaseName']);
                assertIsString($args['collectionName']);
                assertIsString($args['indexName']);
                assertContains($args['indexName'], $this->getIndexNames($args['databaseName'], $args['collectionName']));
                break;
            case 'assertIndexNotExists':
                assertArrayHasKey('databaseName', $args);
                assertArrayHasKey('collectionName', $args);
                assertArrayHasKey('indexName', $args);
                assertIsString($args['databaseName']);
                assertIsString($args['collectionName']);
                assertIsString($args['indexName']);
                assertNotContains($args['indexName'], $this->getIndexNames($args['databaseName'], $args['collectionName']));
                break;
            case 'assertSameLsidOnLastTwoCommands':
                /* Context::getEventObserverForClient() requires the client ID.
                 * Avoid checking $args['client'], which is already resolved. */
                assertArrayHasKey('client', $this->arguments);
                $eventObserver = $this->context->getEventObserverForClient($this->arguments['client']);
                assertEquals(...$eventObserver->getLsidsOnLastTwoCommands());
                break;
            case 'assertDifferentLsidOnLastTwoCommands':
                /* Context::getEventObserverForClient() requires the client ID.
                 * Avoid checking $args['client'], which is already resolved. */
                assertArrayHasKey('client', $this->arguments);
                $eventObserver = $this->context->getEventObserverForClient($this->arguments['client']);
                assertNotEquals(...$eventObserver->getLsidsOnLastTwoCommands());
                break;
            case 'assertNumberConnectionsCheckedOut':
                assertArrayHasKey('connections', $args);
                assertIsInt($args['connections']);
                /* PHP does not implement connection pooling. Check parameters
                 * for the sake of valid-fail tests, but otherwise raise an
                 * error. */
                Assert::fail('Tests using assertNumberConnectionsCheckedOut should be skipped');
                break;
            case 'assertSessionDirty':
                assertArrayHasKey('session', $args);
                assertTrue($args['session']->isDirty());
                break;
            case 'assertSessionNotDirty':
                assertArrayHasKey('session', $args);
                assertFalse($args['session']->isDirty());
                break;
            case 'assertSessionPinned':
                assertArrayHasKey('session', $args);
                assertInstanceOf(Session::class, $args['session']);
                assertInstanceOf(Server::class, $args['session']->getServer());
                break;
            case 'assertSessionTransactionState':
                assertArrayHasKey('session', $args);
                assertInstanceOf(Session::class, $args['session']);
                assertSame($this->arguments['state'], $args['session']->getTransactionState());
                break;
            case 'assertSessionUnpinned':
                assertArrayHasKey('session', $args);
                assertInstanceOf(Session::class, $args['session']);
                assertNull($args['session']->getServer());
                break;
            case 'failPoint':
                assertArrayHasKey('client', $args);
                assertArrayHasKey('failPoint', $args);
                assertInstanceOf(Client::class, $args['client']);
                assertInstanceOf(stdClass::class, $args['failPoint']);
                $args['client']->selectDatabase('admin')->command($args['failPoint']);
                break;
            case 'targetedFailPoint':
                assertArrayHasKey('session', $args);
                assertArrayHasKey('failPoint', $args);
                assertInstanceOf(Session::class, $args['session']);
                assertInstanceOf(stdClass::class, $args['failPoint']);
                assertNotNull($args['session']->getServer(), 'Session is pinned');
                $operation = new DatabaseCommand('admin', $args['failPoint']);
                $operation->execute($args['session']->getServer());
                break;
            case 'loop':
                assertArrayHasKey('operations', $args);
                assertIsArray($args['operations']);

                $operations = array_map(function ($o) {
                    assertIsObject($o);

                    return new Operation($o, $this->context);
                }, $args['operations']);

                return (new Loop($operations, $this->context, array_diff_key($args, ['operations' => 1])))->execute();

            default:
                Assert::fail('Unsupported test runner operation: ' . $this->name);
        }
    }

    private function getIndexNames(string $databaseName, string $collectionName): array
    {
        return array_map(
            function (IndexInfo $indexInfo) {
                return $indexInfo->getName();
            },
            iterator_to_array($this->context->getInternalClient()->selectCollection($databaseName, $collectionName)->listIndexes())
        );
    }

    private function prepareArguments(): array
    {
        $args = $this->arguments;

        if (array_key_exists('client', $args)) {
            assertIsString($args['client']);
            $args['client'] = $this->entityMap->getClient($args['client']);
        }

        if (array_key_exists('session', $args)) {
            assertIsString($args['session']);
            $args['session'] = $this->entityMap->getSession($args['session']);
        }

        // Prepare readConcern, readPreference, and writeConcern
        return Util::prepareCommonOptions($args);
    }

    private static function prepareBulkWriteRequest(stdClass $request): array
    {
        $request = (array) $request;
        assertCount(1, $request);

        $type = key($request);
        $args = current($request);
        assertIsObject($args);
        $args = (array) $args;

        switch ($type) {
            case 'deleteMany':
            case 'deleteOne':
                assertArrayHasKey('filter', $args);
                assertInstanceOf(stdClass::class, $args['filter']);

                return [
                    $type => [
                        $args['filter'],
                        array_diff_key($args, ['filter' => 1]),
                    ],
                ];

            case 'insertOne':
                assertArrayHasKey('document', $args);

                return ['insertOne' => [$args['document']]];

            case 'replaceOne':
                assertArrayHasKey('filter', $args);
                assertArrayHasKey('replacement', $args);
                assertInstanceOf(stdClass::class, $args['filter']);
                assertInstanceOf(stdClass::class, $args['replacement']);

                return [
                    'replaceOne' => [
                        $args['filter'],
                        $args['replacement'],
                        array_diff_key($args, ['filter' => 1, 'replacement' => 1]),
                    ],
                ];

            case 'updateMany':
            case 'updateOne':
                assertArrayHasKey('filter', $args);
                assertArrayHasKey('update', $args);
                assertInstanceOf(stdClass::class, $args['filter']);
                assertThat($args['update'], logicalOr(new IsType('array'), new IsType('object')));

                return [
                    $type => [
                        $args['filter'],
                        $args['update'],
                        array_diff_key($args, ['filter' => 1, 'update' => 1]),
                    ],
                ];

            default:
                Assert::fail('Unsupported bulk write request: ' . $type);
        }
    }

    /**
     * ClientEncryption::rewrapManyDataKey() returns its result as a raw BSON
     * document and does not utilize WriteResult because getServer() cannot be
     * implemented. To satisfy result expectations, unset bulkWriteResult if it
     * is null and rename its fields (per the CRUD spec) otherwise. */
    private static function prepareRewrapManyDataKeyResult(stdClass $result): object
    {
        if ($result->bulkWriteResult === null) {
            unset($result->bulkWriteResult);

            return $result;
        }

        $result->bulkWriteResult = [
            'insertedCount' => $result->bulkWriteResult->nInserted,
            'matchedCount' => $result->bulkWriteResult->nMatched,
            'modifiedCount' => $result->bulkWriteResult->nModified,
            'deletedCount' => $result->bulkWriteResult->nRemoved,
            'upsertedCount' => $result->bulkWriteResult->nUpserted,
            'upsertedIds' => $result->bulkWriteResult->upserted ?? new stdClass(),
        ];

        return $result;
    }

    private static function prepareUploadArguments(array $args): array
    {
        $source = $args['source'] ?? null;
        assertIsObject($source);
        assertObjectHasAttribute('$$hexBytes', $source);
        Util::assertHasOnlyKeys($source, ['$$hexBytes']);
        $hexBytes = $source->{'$$hexBytes'};
        assertIsString($hexBytes);
        assertMatchesRegularExpression('/^([0-9a-fA-F]{2})*$/', $hexBytes);

        $stream = fopen('php://temp', 'w+b');
        fwrite($stream, hex2bin($hexBytes));
        rewind($stream);

        $args['source'] = $stream;

        return $args;
    }
}
