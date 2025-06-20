<?php

namespace MongoDB\Tests\Operation;

use MongoDB\BSON\Javascript;
use MongoDB\Driver\BulkWrite;
use MongoDB\MapReduceResult;
use MongoDB\Operation\Find;
use MongoDB\Operation\MapReduce;
use MongoDB\Tests\CommandObserver;

use function is_object;
use function iterator_to_array;
use function usort;
use function version_compare;

/**
 * @group matrix-testing-exclude-server-4.4-driver-4.0
 * @group matrix-testing-exclude-server-4.4-driver-4.2
 * @group matrix-testing-exclude-server-5.0-driver-4.0
 * @group matrix-testing-exclude-server-5.0-driver-4.2
 */
class MapReduceFunctionalTest extends FunctionalTestCase
{
    public function testDefaultReadConcernIsOmitted(): void
    {
        // Collection must exist for mapReduce command
        $this->createCollection($this->getDatabaseName(), $this->getCollectionName());

        (new CommandObserver())->observe(
            function (): void {
                $operation = new MapReduce(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    new Javascript('function() { emit(this.x, this.y); }'),
                    new Javascript('function(key, values) { return Array.sum(values); }'),
                    ['inline' => 1],
                    ['readConcern' => $this->createDefaultReadConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectNotHasAttribute('readConcern', $event['started']->getCommand());
            }
        );
    }

    public function testDefaultWriteConcernIsOmitted(): void
    {
        // Collection must exist for mapReduce command
        $this->createCollection($this->getDatabaseName(), $this->getCollectionName());
        $this->dropCollection($this->getDatabaseName(), $this->getCollectionName() . '.output');

        (new CommandObserver())->observe(
            function (): void {
                $operation = new MapReduce(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    new Javascript('function() { emit(this.x, this.y); }'),
                    new Javascript('function(key, values) { return Array.sum(values); }'),
                    $this->getCollectionName() . '.output',
                    ['writeConcern' => $this->createDefaultWriteConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectNotHasAttribute('writeConcern', $event['started']->getCommand());
            }
        );
    }

    public function testFinalize(): void
    {
        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = ['inline' => 1];
        $finalize = new Javascript('function(key, reducedValue) { return reducedValue; }');

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out, ['finalize' => $finalize]);
        $result = $operation->execute($this->getPrimaryServer());

        $this->assertNotNull($result);
    }

    public function testResult(): void
    {
        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = ['inline' => 1];

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out);
        $result = $operation->execute($this->getPrimaryServer());

        $this->assertInstanceOf(MapReduceResult::class, $result);

        if (version_compare($this->getServerVersion(), '4.3.0', '<')) {
            $this->assertGreaterThanOrEqual(0, $result->getExecutionTimeMS());
            $this->assertNotEmpty($result->getCounts());
        }
    }

    public function testResultIncludesTimingWithVerboseOption(): void
    {
        $this->skipIfServerVersion('>=', '4.3.0', 'mapReduce statistics are no longer exposed');

        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = ['inline' => 1];

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out, ['verbose' => true]);
        $result = $operation->execute($this->getPrimaryServer());

        $this->assertInstanceOf(MapReduceResult::class, $result);
        $this->assertGreaterThanOrEqual(0, $result->getExecutionTimeMS());
        $this->assertNotEmpty($result->getCounts());
        $this->assertNotEmpty($result->getTiming());
    }

    public function testResultDoesNotIncludeTimingWithoutVerboseOption(): void
    {
        $this->skipIfServerVersion('>=', '4.3.0', 'mapReduce statistics are no longer exposed');

        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = ['inline' => 1];

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out, ['verbose' => false]);
        $result = $operation->execute($this->getPrimaryServer());

        $this->assertInstanceOf(MapReduceResult::class, $result);
        $this->assertGreaterThanOrEqual(0, $result->getExecutionTimeMS());
        $this->assertNotEmpty($result->getCounts());
        $this->assertEmpty($result->getTiming());
    }

    public function testSessionOption(): void
    {
        $this->createFixtures(3);

        (new CommandObserver())->observe(
            function (): void {
                $operation = new MapReduce(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    new Javascript('function() { emit(this.x, this.y); }'),
                    new Javascript('function(key, values) { return Array.sum(values); }'),
                    ['inline' => 1],
                    ['session' => $this->createSession()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectHasAttribute('lsid', $event['started']->getCommand());
            }
        );
    }

    public function testBypassDocumentValidationSetWhenTrue(): void
    {
        $this->createFixtures(1);

        (new CommandObserver())->observe(
            function (): void {
                $operation = new MapReduce(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    new Javascript('function() { emit(this.x, this.y); }'),
                    new Javascript('function(key, values) { return Array.sum(values); }'),
                    ['inline' => 1],
                    ['bypassDocumentValidation' => true]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectHasAttribute('bypassDocumentValidation', $event['started']->getCommand());
                $this->assertEquals(true, $event['started']->getCommand()->bypassDocumentValidation);
            }
        );
    }

    public function testBypassDocumentValidationUnsetWhenFalse(): void
    {
        $this->createFixtures(1);

        (new CommandObserver())->observe(
            function (): void {
                $operation = new MapReduce(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    new Javascript('function() { emit(this.x, this.y); }'),
                    new Javascript('function(key, values) { return Array.sum(values); }'),
                    ['inline' => 1],
                    ['bypassDocumentValidation' => false]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectNotHasAttribute('bypassDocumentValidation', $event['started']->getCommand());
            }
        );
    }

    /** @dataProvider provideTypeMapOptionsAndExpectedDocuments */
    public function testTypeMapOptionWithInlineResults(?array $typeMap, array $expectedDocuments): void
    {
        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = ['inline' => 1];

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out, ['typeMap' => $typeMap]);
        $results = iterator_to_array($operation->execute($this->getPrimaryServer()));

        $this->assertEquals($this->sortResults($expectedDocuments), $this->sortResults($results));
    }

    public function provideTypeMapOptionsAndExpectedDocuments()
    {
        return [
            [
                null,
                [
                    (object) ['_id' => 1, 'value' => 3],
                    (object) ['_id' => 2, 'value' => 6],
                    (object) ['_id' => 3, 'value' => 9],
                ],
            ],
            [
                ['root' => 'array'],
                [
                    ['_id' => 1, 'value' => 3],
                    ['_id' => 2, 'value' => 6],
                    ['_id' => 3, 'value' => 9],
                ],
            ],
            [
                ['root' => 'object'],
                [
                    (object) ['_id' => 1, 'value' => 3],
                    (object) ['_id' => 2, 'value' => 6],
                    (object) ['_id' => 3, 'value' => 9],
                ],
            ],
        ];
    }

    /** @dataProvider provideTypeMapOptionsAndExpectedDocuments */
    public function testTypeMapOptionWithOutputCollection(?array $typeMap, array $expectedDocuments): void
    {
        $this->createFixtures(3);

        $map = new Javascript('function() { emit(this.x, this.y); }');
        $reduce = new Javascript('function(key, values) { return Array.sum(values); }');
        $out = $this->getCollectionName() . '.output';
        $this->dropCollection($this->getDatabaseName(), $out);

        $operation = new MapReduce($this->getDatabaseName(), $this->getCollectionName(), $map, $reduce, $out, ['typeMap' => $typeMap]);
        $results = iterator_to_array($operation->execute($this->getPrimaryServer()));

        $this->assertEquals($this->sortResults($expectedDocuments), $this->sortResults($results));

        $operation = new Find($this->getDatabaseName(), $out, [], ['typeMap' => $typeMap]);
        $cursor = $operation->execute($this->getPrimaryServer());

        $this->assertEquals($this->sortResults($expectedDocuments), $this->sortResults(iterator_to_array($cursor)));
    }

    /**
     * Create data fixtures.
     */
    private function createFixtures(int $n): void
    {
        $this->dropCollection($this->getDatabaseName(), $this->getCollectionName());
        $bulkWrite = new BulkWrite(['ordered' => true]);

        for ($i = 1; $i <= $n; $i++) {
            $bulkWrite->insert(['x' => $i, 'y' => $i]);
            $bulkWrite->insert(['x' => $i, 'y' => $i * 2]);
        }

        $result = $this->manager->executeBulkWrite($this->getNamespace(), $bulkWrite);

        $this->assertEquals($n * 2, $result->getInsertedCount());
    }

    private function sortResults(array $results): array
    {
        $sortFunction = static function ($resultA, $resultB): int {
            $idA = is_object($resultA) ? $resultA->_id : $resultA['_id'];
            $idB = is_object($resultB) ? $resultB->_id : $resultB['_id'];

            return $idA <=> $idB;
        };

        $sortedResults = $results;
        usort($sortedResults, $sortFunction);

        return $sortedResults;
    }
}
