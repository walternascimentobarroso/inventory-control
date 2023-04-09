<?php

namespace Tests;

use App\Model\DAO\Sale;
use PHPUnit\Framework\TestCase;
use App\Controller\Http\Db\TestConnection;

class SaleTest extends TestCase
{
    private $sale;
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = (new TestConnection())->connect();
        $this->sale = new Sale($this->pdo);
        $this->sale->createTables();
    }

    public function testInsert()
    {
        $data = [
            'items' => 'Item 1, Item 2, Item 3',
            'total' => 100
        ];
        $id = $this->sale->insert($data);
        $this->assertIsString($id);
    }

    public function testGet()
    {
        $data = [
            'items' => 'Item 1, Item 2, Item 3',
            'total' => 100
        ];
        $id = $this->sale->insert($data);
        $sale = $this->sale->get($id);
        $this->assertIsArray($sale);
        $this->assertArrayHasKey('items', $sale);
        $this->assertArrayHasKey('total', $sale);
    }

    public function testUpdate()
    {
        $data = [
            'items' => 'Item 1, Item 2, Item 3',
            'total' => 100
        ];
        $id = $this->sale->insert($data);
        $newData = [
            'items' => 'Item 1, Item 2',
            'total' => 50
        ];
        $this->assertTrue($this->sale->update($id, $newData));
    }

    public function testDelete()
    {
        $data = [
            'items' => 'Item 1, Item 2, Item 3',
            'total' => 100
        ];
        $id = $this->sale->insert($data);
        $this->assertEquals(1, $this->sale->delete($id));
    }
}
