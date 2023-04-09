<?php

use App\Model\DAO\Product;
use PHPUnit\Framework\TestCase;
use App\Controller\Http\Db\TestConnection;

class ProductTest extends TestCase
{
    private $product;
    private $pdo;

    public function setUp(): void
    {
        $this->pdo = (new TestConnection())->connect();
        $this->product = new Product($this->pdo);
        $this->product->createTables();
    }

    public function testInsertAndGetProduct()
    {
        // insert a new product
        $productId = $this->product->insert([
            'description' => 'Test Product',
            'category' => 1,
            'barcode' => '123456',
            'value' => '10.99',
            'tax' => '5.5'
        ]);

        // get the inserted product
        $result = $this->product->get($productId);

        // assert that the returned product matches the inserted data
        $this->assertEquals([
            'description' => 'Test Product',
            'category' => 1,
            'barcode' => '123456',
            'value' => '10.99',
            'tax' => '5.5'
        ], $result);
    }

    public function testUpdateProduct()
    {
        // insert a new product
        $productId = $this->product->insert([
            'description' => 'Test Product',
            'category' => 1,
            'barcode' => '123456',
            'value' => '10.99',
            'tax' => '5.5'
        ]);

        // update the product
        $this->product->update($productId, [
            'description' => 'Updated Product',
            'category' => 2,
            'barcode' => '654321',
            'value' => '20.99',
            'tax' => '10.5'
        ]);

        // get the updated product
        $result = $this->product->get($productId);

        // assert that the returned product matches the updated data
        $this->assertEquals([
            'description' => 'Updated Product',
            'category' => 2,
            'barcode' => '654321',
            'value' => '20.99',
            'tax' => '10.5'
        ], $result);
    }

    public function testDeleteProduct()
    {
        // insert a new product
        $productId = $this->product->insert([
            'description' => 'Test Product',
            'category' => 1,
            'barcode' => '123456',
            'value' => '10.99',
            'tax' => '5.5'
        ]);

        // delete the product
        $result = $this->product->delete($productId);

        // assert that one row was affected
        $this->assertEquals(1, $result);

        // assert that the product is no longer in the database
        $this->assertEmpty($this->product->get($productId));
    }
}
