<?php

namespace MongoDB\Tests\Operation;

use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Operation\ReplaceOne;

class ReplaceOneTest extends TestCase
{
    /** @dataProvider provideInvalidDocumentValues */
    public function testConstructorFilterArgumentTypeCheck($filter): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ReplaceOne($this->getDatabaseName(), $this->getCollectionName(), $filter, ['y' => 1]);
    }

    /** @dataProvider provideInvalidDocumentValues */
    public function testConstructorReplacementArgumentTypeCheck($replacement): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ReplaceOne($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1], $replacement);
    }

    /**
     * @dataProvider provideReplacementDocuments
     * @doesNotPerformAssertions
     */
    public function testConstructorReplacementArgument($replacement): void
    {
        new ReplaceOne($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1], $replacement);
    }

    /** @dataProvider provideUpdateDocuments */
    public function testConstructorReplacementArgumentProhibitsUpdateDocument($replacement): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('First key in $replacement is an update operator');
        new ReplaceOne($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1], $replacement);
    }

    /**
     * @dataProvider provideUpdatePipelines
     * @dataProvider provideEmptyUpdatePipelinesExcludingArray
     */
    public function testConstructorReplacementArgumentProhibitsUpdatePipeline($replacement): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$replacement is an update pipeline');
        new ReplaceOne($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1], $replacement);
    }
}
