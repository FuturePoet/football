<?php

/* Enable strict types to disable type coercion for arguments. Without this, the
 * non-int test values 3.14 and true would be silently coerced to integers,
 * which is not what we're expecting to test here. */
declare(strict_types=1);

namespace MongoDB\Tests\Model;

use MongoDB\Collection;
use MongoDB\Driver\Exception\LogicException;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\ChangeStreamIterator;
use MongoDB\Operation\Find;
use MongoDB\Tests\CommandObserver;
use MongoDB\Tests\FunctionalTestCase;
use TypeError;

use function array_merge;
use function sprintf;

class ChangeStreamIteratorTest extends FunctionalTestCase
{
    /** @var Collection */
    private $collection;

    public function setUp(): void
    {
        parent::setUp();

        // Drop and re-create the collection
        $this->collection = $this->createCollection($this->getDatabaseName(), $this->getCollectionName(), ['capped' => true, 'size' => 8192]);
    }

    /** @dataProvider provideInvalidIntegerValues */
    public function testFirstBatchArgumentTypeCheck($firstBatchSize): void
    {
        $this->expectException(TypeError::class);
        new ChangeStreamIterator($this->collection->find(), $firstBatchSize, null, null);
    }

    public function testInitialResumeToken(): void
    {
        $iterator = new ChangeStreamIterator($this->collection->find(), 0, null, null);
        $this->assertNull($iterator->getResumeToken());

        $iterator = new ChangeStreamIterator($this->collection->find(), 0, ['resumeToken' => 1], null);
        $this->assertSameDocument(['resumeToken' => 1], $iterator->getResumeToken());

        $iterator = new ChangeStreamIterator($this->collection->find(), 0, (object) ['resumeToken' => 2], null);
        $this->assertSameDocument((object) ['resumeToken' => 2], $iterator->getResumeToken());
    }

    /** @dataProvider provideInvalidDocumentValues */
    public function testInitialResumeTokenArgumentTypeCheck($initialResumeToken): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ChangeStreamIterator($this->collection->find(), 0, $initialResumeToken, null);
    }

    /** @dataProvider provideInvalidObjectValues */
    public function testPostBatchResumeTokenArgumentTypeCheck($postBatchResumeToken): void
    {
        $this->expectException(TypeError::class);
        new ChangeStreamIterator($this->collection->find(), 0, null, $postBatchResumeToken);
    }

    public function provideInvalidObjectValues()
    {
        return $this->wrapValuesForDataProvider(array_merge($this->getInvalidDocumentValues(), [[]]));
    }

    public function testPostBatchResumeTokenIsReturnedForLastElementInFirstBatch(): void
    {
        $this->collection->insertOne(['_id' => ['resumeToken' => 1], 'x' => 1]);
        $this->collection->insertOne(['_id' => ['resumeToken' => 2], 'x' => 2]);
        $postBatchResumeToken = (object) ['resumeToken' => 'pb'];

        $cursor = $this->collection->find([], ['cursorType' => Find::TAILABLE]);
        $iterator = new ChangeStreamIterator($cursor, 2, null, $postBatchResumeToken);

        $this->assertNoCommandExecuted(function () use ($iterator): void {
            $iterator->rewind();
        });
        $this->assertTrue($iterator->valid());
        $this->assertSameDocument(['resumeToken' => 1], $iterator->getResumeToken());
        $this->assertSameDocument(['_id' => ['resumeToken' => 1], 'x' => 1], $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSameDocument($postBatchResumeToken, $iterator->getResumeToken());
        $this->assertSameDocument(['_id' => ['resumeToken' => 2], 'x' => 2], $iterator->current());
    }

    public function testRewindIsNopWhenFirstBatchIsEmpty(): void
    {
        $this->collection->insertOne(['_id' => ['resumeToken' => 1], 'x' => 1]);

        $cursor = $this->collection->find(['x' => ['$gt' => 1]], ['cursorType' => Find::TAILABLE]);
        $iterator = new ChangeStreamIterator($cursor, 0, null, null);

        $this->assertNoCommandExecuted(function () use ($iterator): void {
            $iterator->rewind();
        });
        $this->assertFalse($iterator->valid());

        $this->collection->insertOne(['_id' => ['resumeToken' => 2], 'x' => 2]);

        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSameDocument(['_id' => ['resumeToken' => 2], 'x' => 2], $iterator->current());

        $this->expectException(LogicException::class);
        $iterator->rewind();
    }

    public function testRewindAdvancesWhenFirstBatchIsNotEmpty(): void
    {
        $this->collection->insertOne(['_id' => ['resumeToken' => 1], 'x' => 1]);

        $cursor = $this->collection->find([], ['cursorType' => Find::TAILABLE]);
        $iterator = new ChangeStreamIterator($cursor, 1, null, null);

        $this->assertNoCommandExecuted(function () use ($iterator): void {
            $iterator->rewind();
        });
        $this->assertTrue($iterator->valid());
        $this->assertSameDocument(['_id' => ['resumeToken' => 1], 'x' => 1], $iterator->current());

        $this->collection->insertOne(['_id' => ['resumeToken' => 2], 'x' => 2]);

        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSameDocument(['_id' => ['resumeToken' => 2], 'x' => 2], $iterator->current());

        $this->expectException(LogicException::class);
        $iterator->rewind();
    }

    private function assertNoCommandExecuted(callable $callable): void
    {
        $commands = [];

        (new CommandObserver())->observe(
            $callable,
            function (array $event) use (&$commands): void {
                $this->fail(sprintf('"%s" command was executed', $event['started']->getCommandName()));
            }
        );

        $this->assertEmpty($commands);
    }
}
