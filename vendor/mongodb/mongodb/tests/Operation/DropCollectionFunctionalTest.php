<?php

namespace MongoDB\Tests\Operation;

use MongoDB\Operation\DropCollection;
use MongoDB\Operation\InsertOne;
use MongoDB\Tests\CommandObserver;

class DropCollectionFunctionalTest extends FunctionalTestCase
{
    public function testDefaultWriteConcernIsOmitted(): void
    {
        (new CommandObserver())->observe(
            function (): void {
                $operation = new DropCollection(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    ['writeConcern' => $this->createDefaultWriteConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectNotHasAttribute('writeConcern', $event['started']->getCommand());
            }
        );
    }

    public function testDropExistingCollection(): void
    {
        $server = $this->getPrimaryServer();

        $insertOne = new InsertOne($this->getDatabaseName(), $this->getCollectionName(), ['x' => 1]);
        $writeResult = $insertOne->execute($server);
        $this->assertEquals(1, $writeResult->getInsertedCount());

        $operation = new DropCollection($this->getDatabaseName(), $this->getCollectionName());
        $commandResult = $operation->execute($server);

        $this->assertCommandSucceeded($commandResult);
        $this->assertCollectionDoesNotExist($this->getCollectionName());
    }

    /** @depends testDropExistingCollection */
    public function testDropNonexistentCollection(): void
    {
        $this->assertCollectionDoesNotExist($this->getCollectionName());

        $operation = new DropCollection($this->getDatabaseName(), $this->getCollectionName());
        $commandResult = $operation->execute($this->getPrimaryServer());

        /* Avoid inspecting the result document as mongos returns {ok:1.0},
         * which is inconsistent from the expected mongod response of {ok:0}. */
        $this->assertIsObject($commandResult);
    }

    public function testSessionOption(): void
    {
        (new CommandObserver())->observe(
            function (): void {
                $operation = new DropCollection(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    ['session' => $this->createSession()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function (array $event): void {
                $this->assertObjectHasAttribute('lsid', $event['started']->getCommand());
            }
        );
    }
}
