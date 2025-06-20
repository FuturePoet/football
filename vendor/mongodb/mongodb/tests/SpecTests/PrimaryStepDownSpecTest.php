<?php

namespace MongoDB\Tests\SpecTests;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Driver\Command;
use MongoDB\Driver\Exception\BulkWriteException;
use MongoDB\Driver\Exception\Exception as DriverException;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\Server;
use MongoDB\Driver\WriteConcern;
use MongoDB\Operation\BulkWrite;
use MongoDB\Tests\CommandObserver;
use UnexpectedValueException;

use function current;
use function sprintf;

/** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests */
class PrimaryStepDownSpecTest extends FunctionalTestCase
{
    public const INTERRUPTED_AT_SHUTDOWN = 11600;
    public const NOT_PRIMARY = 10107;
    public const SHUTDOWN_IN_PROGRESS = 91;

    /** @var Client */
    private $client;

    /** @var Collection */
    private $collection;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = self::createTestClient(null, ['retryWrites' => false, 'heartbeatFrequencyMS' => 500, 'serverSelectionTimeoutMS' => 20000, 'serverSelectionTryOnce' => false]);

        $this->dropAndRecreateCollection();
        $this->collection = $this->client->selectCollection($this->getDatabaseName(), $this->getCollectionName());
    }

    /** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests#not-primary-keep-connection-pool */
    public function testNotPrimaryKeepsConnectionPool(): void
    {
        $runOn = [(object) ['minServerVersion' => '4.1.11', 'topology' => [self::TOPOLOGY_REPLICASET]]];
        $this->checkServerRequirements($runOn);

        // Set a fail point
        $this->configureFailPoint([
            'configureFailPoint' => 'failCommand',
            'mode' => ['times' => 1],
            'data' => [
                'failCommands' => ['insert'],
                'errorCode' => self::NOT_PRIMARY,
            ],
        ]);

        $totalConnectionsCreated = $this->getTotalConnectionsCreated();

        // Execute an insert into the test collection of a {test: 1} document.
        try {
            $this->insertDocuments(1);
        } catch (BulkWriteException $e) {
            // Verify that the insert failed with an operation failure with 10107 code.
            $this->assertSame(self::NOT_PRIMARY, $e->getCode());
        }

        // Execute an insert into the test collection of a {test: 1} document and verify that it succeeds.
        $result = $this->insertDocuments(1);
        $this->assertSame(1, $result->getInsertedCount());

        // Verify that the connection pool has not been cleared
        $this->assertSame($totalConnectionsCreated, $this->getTotalConnectionsCreated());
    }

    /** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests#not-primary-reset-connection-pool */
    public function testNotPrimaryResetConnectionPool(): void
    {
        $runOn = [(object) ['minServerVersion' => '4.0.0', 'maxServerVersion' => '4.0.999', 'topology' => [self::TOPOLOGY_REPLICASET]]];
        $this->checkServerRequirements($runOn);

        // Set a fail point
        $this->configureFailPoint([
            'configureFailPoint' => 'failCommand',
            'mode' => ['times' => 1],
            'data' => [
                'failCommands' => ['insert'],
                'errorCode' => self::NOT_PRIMARY,
            ],
        ]);

        $totalConnectionsCreated = $this->getTotalConnectionsCreated();

        // Execute an insert into the test collection of a {test: 1} document.
        try {
            $this->insertDocuments(1);
        } catch (BulkWriteException $e) {
            // Verify that the insert failed with an operation failure with 10107 code.
            $this->assertSame(self::NOT_PRIMARY, $e->getCode());
        }

        /* Verify that the connection pool has been cleared and that a new
         * connection has been created. Use ">=" to allow for the possibility
         * that the server created additional connections unrelated to this
         * test. */
        $this->assertGreaterThanOrEqual($totalConnectionsCreated + 1, $this->getTotalConnectionsCreated());

        // Execute an insert into the test collection of a {test: 1} document and verify that it succeeds.
        $result = $this->insertDocuments(1);
        $this->assertSame(1, $result->getInsertedCount());
    }

    /** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests#shutdown-in-progress-reset-connection-pool */
    public function testShutdownResetConnectionPool(): void
    {
        $runOn = [(object) ['minServerVersion' => '4.0.0']];
        $this->checkServerRequirements($runOn);

        // Set a fail point
        $this->configureFailPoint([
            'configureFailPoint' => 'failCommand',
            'mode' => ['times' => 1],
            'data' => [
                'failCommands' => ['insert'],
                'errorCode' => self::SHUTDOWN_IN_PROGRESS,
            ],
        ]);

        $totalConnectionsCreated = $this->getTotalConnectionsCreated();

        // Execute an insert into the test collection of a {test: 1} document.
        try {
            $this->insertDocuments(1);
        } catch (BulkWriteException $e) {
            // Verify that the insert failed with an operation failure with 91 code.
            $this->assertSame(self::SHUTDOWN_IN_PROGRESS, $e->getCode());
        }

        /* Verify that the connection pool has been cleared and that a new
         * connection has been created. Use ">=" to allow for the possibility
         * that the server created additional connections unrelated to this
         * test. */
        $this->assertGreaterThanOrEqual($totalConnectionsCreated + 1, $this->getTotalConnectionsCreated());

        // Execute an insert into the test collection of a {test: 1} document and verify that it succeeds.
        $result = $this->insertDocuments(1);
        $this->assertSame(1, $result->getInsertedCount());
    }

    /** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests#interrupted-at-shutdown-reset-connection-pool */
    public function testInterruptedAtShutdownResetConnectionPool(): void
    {
        $runOn = [(object) ['minServerVersion' => '4.0.0']];
        $this->checkServerRequirements($runOn);

        // Set a fail point
        $this->configureFailPoint([
            'configureFailPoint' => 'failCommand',
            'mode' => ['times' => 1],
            'data' => [
                'failCommands' => ['insert'],
                'errorCode' => self::INTERRUPTED_AT_SHUTDOWN,
            ],
        ]);

        $totalConnectionsCreated = $this->getTotalConnectionsCreated();

        // Execute an insert into the test collection of a {test: 1} document.
        try {
            $this->insertDocuments(1);
        } catch (BulkWriteException $e) {
            // Verify that the insert failed with an operation failure with 11600 code.
            $this->assertSame(self::INTERRUPTED_AT_SHUTDOWN, $e->getCode());
        }

        /* Verify that the connection pool has been cleared and that a new
         * connection has been created. Use ">=" to allow for the possibility
         * that the server created additional connections unrelated to this
         * test. */
        $this->assertGreaterThanOrEqual($totalConnectionsCreated + 1, $this->getTotalConnectionsCreated());

        // Execute an insert into the test collection of a {test: 1} document and verify that it succeeds.
        $result = $this->insertDocuments(1);
        $this->assertSame(1, $result->getInsertedCount());
    }

    /** @see https://github.com/mongodb/specifications/tree/master/source/connections-survive-step-down/tests#getmore-iteration */
    public function testGetMoreIteration(): void
    {
        $this->markTestSkipped('Test causes subsequent failures in other tests (see PHPLIB-471)');

        $runOn = [(object) ['minServerVersion' => '4.1.11', 'topology' => [self::TOPOLOGY_REPLICASET]]];
        $this->checkServerRequirements($runOn);

        // Insert 5 documents into a collection with a majority write concern.
        $this->insertDocuments(5);

        // Start a find operation on the collection with a batch size of 2, and retrieve the first batch of results.
        $cursor = $this->collection->find([], ['batchSize' => 2]);

        $cursor->rewind();
        $this->assertTrue($cursor->valid());

        $cursor->next();
        $this->assertTrue($cursor->valid());

        $totalConnectionsCreated = $this->getTotalConnectionsCreated();

        // Send a {replSetStepDown: 5, force: true} command to the current primary and verify that the command succeeded
        $primary = $this->client->getManager()->selectServer();

        $success = false;
        $attempts = 0;
        do {
            try {
                $attempts++;
                $primary->executeCommand('admin', new Command(['replSetStepDown' => 5, 'force' => true]));
                $success = true;
            } catch (DriverException $e) {
                if ($attempts == 10) {
                    $this->fail(sprintf('Could not successfully execute replSetStepDown within %d attempts', $attempts));
                }
            }
        } while (! $success);

        // Retrieve the next batch of results from the cursor obtained in the find operation, and verify that this operation succeeded.
        $events = [];
        $observer = new CommandObserver();
        $observer->observe(
            function () use ($cursor): void {
                $cursor->next();
            },
            function ($event) use (&$events): void {
                $events[] = $event;
            }
        );
        $this->assertTrue($cursor->valid());
        $this->assertCount(1, $events);
        $this->assertSame('getMore', $events[0]['started']->getCommandName());

        // Verify that no new connections have been created
        $this->assertSame($totalConnectionsCreated, $this->getTotalConnectionsCreated($cursor->getServer()));

        // Wait to allow primary election to complete and prevent subsequent test failures
        $this->waitForPrimaryReelection();
    }

    private function insertDocuments($count)
    {
        $operations = [];

        for ($i = 1; $i <= $count; $i++) {
            $operations[] = [
                BulkWrite::INSERT_ONE => [['test' => $i]],
            ];
        }

        return $this->collection->bulkWrite($operations, ['writeConcern' => new WriteConcern('majority')]);
    }

    private function dropAndRecreateCollection(): void
    {
        $this->client->selectCollection($this->getDatabaseName(), $this->getCollectionName())->drop();
        $this->client->selectDatabase($this->getDatabaseName())->command(['create' => $this->getCollectionName()]);
    }

    private function getTotalConnectionsCreated(?Server $server = null)
    {
        $server = $server ?: $this->client->getManager()->selectServer();

        $cursor = $server->executeCommand(
            $this->getDatabaseName(),
            new Command(['serverStatus' => 1]),
            new ReadPreference(ReadPreference::PRIMARY)
        );

        $cursor->setTypeMap(['root' => 'array', 'document' => 'array']);
        $document = current($cursor->toArray());

        if (isset($document['connections'], $document['connections']['totalCreated'])) {
            return (int) $document['connections']['totalCreated'];
        }

        throw new UnexpectedValueException('Could not determine number of total connections');
    }

    private function waitForPrimaryReelection(): void
    {
        try {
            $this->insertDocuments(1);

            return;
        } catch (DriverException $e) {
            $this->client->getManager()->selectServer();

            return;
        }

        $this->fail('Expected primary to be re-elected within 20 seconds.');
    }
}
