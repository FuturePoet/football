<?php

namespace MongoDB\Tests\Operation;

use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Operation\Aggregate;

class AggregateTest extends TestCase
{
    public function testConstructorPipelineArgumentMustBeAList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$pipeline is not a valid aggregation pipeline');
        new Aggregate($this->getDatabaseName(), $this->getCollectionName(), [1 => ['$match' => ['x' => 1]]]);
    }

    /** @dataProvider provideInvalidConstructorOptions */
    public function testConstructorOptionTypeChecks(array $options): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Aggregate($this->getDatabaseName(), $this->getCollectionName(), [['$match' => ['x' => 1]]], $options);
    }

    public function provideInvalidConstructorOptions()
    {
        $options = [];

        foreach ($this->getInvalidBooleanValues() as $value) {
            $options[][] = ['allowDiskUse' => $value];
        }

        foreach ($this->getInvalidIntegerValues() as $value) {
            $options[][] = ['batchSize' => $value];
        }

        foreach ($this->getInvalidBooleanValues() as $value) {
            $options[][] = ['bypassDocumentValidation' => $value];
        }

        foreach ($this->getInvalidDocumentValues() as $value) {
            $options[][] = ['collation' => $value];
        }

        foreach ($this->getInvalidHintValues() as $value) {
            $options[][] = ['hint' => $value];
        }

        foreach ($this->getInvalidDocumentValues() as $value) {
            $options[][] = ['let' => $value];
        }

        foreach ($this->getInvalidBooleanValues() as $value) {
            $options[][] = ['explain' => $value];
        }

        foreach ($this->getInvalidIntegerValues() as $value) {
            $options[][] = ['maxAwaitTimeMS' => $value];
        }

        foreach ($this->getInvalidIntegerValues() as $value) {
            $options[][] = ['maxTimeMS' => $value];
        }

        foreach ($this->getInvalidReadConcernValues() as $value) {
            $options[][] = ['readConcern' => $value];
        }

        foreach ($this->getInvalidReadPreferenceValues() as $value) {
            $options[][] = ['readPreference' => $value];
        }

        foreach ($this->getInvalidSessionValues() as $value) {
            $options[][] = ['session' => $value];
        }

        foreach ($this->getInvalidArrayValues() as $value) {
            $options[][] = ['typeMap' => $value];
        }

        foreach ($this->getInvalidBooleanValues(true) as $value) {
            $options[][] = ['useCursor' => $value];
        }

        foreach ($this->getInvalidWriteConcernValues() as $value) {
            $options[][] = ['writeConcern' => $value];
        }

        return $options;
    }

    public function testConstructorBatchSizeOptionRequiresUseCursor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"batchSize" option should not be used if "useCursor" is false');
        new Aggregate(
            $this->getDatabaseName(),
            $this->getCollectionName(),
            [['$match' => ['x' => 1]]],
            ['batchSize' => 100, 'useCursor' => false]
        );
    }

    private function getInvalidHintValues()
    {
        return [123, 3.14, true];
    }

    public function testExplainableCommandDocument(): void
    {
        $options = [
            'allowDiskUse' => true,
            'batchSize' => 100,
            'bypassDocumentValidation' => true,
            'collation' => ['locale' => 'fr'],
            'comment' => 'explain me',
            'hint' => '_id_',
            'let' => ['a' => 1],
            'maxTimeMS' => 100,
            'readConcern' => new ReadConcern(ReadConcern::LOCAL),
            'useCursor' => true,
            // Intentionally omitted options
            // The "explain" option is illegal
            'readPreference' => new ReadPreference(ReadPreference::SECONDARY_PREFERRED),
            'typeMap' => ['root' => 'array', 'document' => 'array'],
            'writeConcern' => new WriteConcern(0),
        ];
        $operation = new Aggregate($this->getDatabaseName(), $this->getCollectionName(), [['$project' => ['_id' => 0]]], $options);

        $expected = [
            'aggregate' => $this->getCollectionName(),
            'pipeline' => [['$project' => ['_id' => 0]]],
            'allowDiskUse' => true,
            'bypassDocumentValidation' => true,
            'collation' => (object) ['locale' => 'fr'],
            'comment' => 'explain me',
            'hint' => '_id_',
            'maxTimeMS' => 100,
            'readConcern' => new ReadConcern(ReadConcern::LOCAL),
            'let' => (object) ['a' => 1],
            'cursor' => ['batchSize' => 100],
        ];
        $this->assertEquals($expected, $operation->getCommandDocument());
    }
}
