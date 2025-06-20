<?php

/* Enable strict types to disable type coercion for arguments. Without this, the
 * non-int test values 3.14 and true would be silently coerced to integers,
 * which is not what we're expecting to test here. */
declare(strict_types=1);

namespace MongoDB\Tests\Operation;

use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Operation\Delete;
use TypeError;

class DeleteTest extends TestCase
{
    /** @dataProvider provideInvalidDocumentValues */
    public function testConstructorFilterArgumentTypeCheck($filter): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Delete($this->getDatabaseName(), $this->getCollectionName(), $filter, 0);
    }

    /** @dataProvider provideInvalidIntegerValues */
    public function testConstructorLimitArgumentMustBeInt($limit): void
    {
        $this->expectException(TypeError::class);
        new Delete($this->getDatabaseName(), $this->getCollectionName(), [], $limit);
    }

    /** @dataProvider provideInvalidLimitValues */
    public function testConstructorLimitArgumentMustBeOneOrZero($limit): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$limit must be 0 or 1');
        new Delete($this->getDatabaseName(), $this->getCollectionName(), [], $limit);
    }

    public function provideInvalidLimitValues()
    {
        return $this->wrapValuesForDataProvider([-1, 2]);
    }

    /** @dataProvider provideInvalidConstructorOptions */
    public function testConstructorOptionTypeChecks(array $options): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Delete($this->getDatabaseName(), $this->getCollectionName(), [], 1, $options);
    }

    public function provideInvalidConstructorOptions()
    {
        $options = [];

        foreach ($this->getInvalidDocumentValues() as $value) {
            $options[][] = ['collation' => $value];
        }

        foreach ($this->getInvalidSessionValues() as $value) {
            $options[][] = ['session' => $value];
        }

        foreach ($this->getInvalidWriteConcernValues() as $value) {
            $options[][] = ['writeConcern' => $value];
        }

        return $options;
    }

    public function testExplainableCommandDocument(): void
    {
        $options = [
            'collation' => ['locale' => 'fr'],
            'hint' => '_id_',
            'let' => ['a' => 1],
            'comment' => 'explain me',
            // Intentionally omitted options
            'writeConcern' => new WriteConcern(0),
        ];
        $operation = new Delete($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1], 0, $options);

        $expected = [
            'delete' => $this->getCollectionName(),
            'deletes' => [
                [
                    'q' => ['x' => 1],
                    'limit' => 0,
                    'collation' => (object) ['locale' => 'fr'],
                    'hint' => '_id_',
                ],
            ],
            'comment' => 'explain me',
            'let' => (object) ['a' => 1],
        ];
        $this->assertEquals($expected, $operation->getCommandDocument());
    }
}
