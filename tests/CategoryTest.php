<?php

namespace Tests\App\Model\DAO;

use App\Model\DAO\Category;
use PHPUnit\Framework\TestCase;
use App\Controller\Http\Db\TestConnection;

class CategoryTest extends TestCase
{
    private $category;
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = (new TestConnection())->connect();
        $this->category = new Category($this->pdo);
        $this->category->createTables();
    }

    public function testCreateAndGetAll()
    {
        $category1 = [
            "description" => "Category 1"
        ];
        $this->assertEquals(1, $this->category->insert($category1));

        $category2 = [
            "description" => "Category 2"
        ];
        $this->assertEquals(2, $this->category->insert($category2));

        $expectedData = [
            [
                "id" => 1,
                "description" => "Category 1"
            ],
            [
                "id" => 2,
                "description" => "Category 2"
            ]
        ];

        $this->assertEquals($expectedData, $this->category->getAll());
    }

    public function testGet()
    {
        $category = [
            "description" => "Category 1"
        ];
        $categoryId = $this->category->insert($category);

        $expectedData = [
            "description" => "Category 1"
        ];

        $this->assertEquals($expectedData, $this->category->get($categoryId));
    }

    public function testUpdate()
    {
        $category = [
            "description" => "Category 1"
        ];
        $categoryId = $this->category->insert($category);

        $updatedCategory = [
            "description" => "Category 2"
        ];
        $this->assertTrue($this->category->update($categoryId, $updatedCategory));

        $expectedData = [
            "description" => "Category 2"
        ];
        $this->assertEquals($expectedData, $this->category->get($categoryId));
    }

    public function testDelete()
    {
        $category = [
            "description" => "Category 1"
        ];
        $categoryId = $this->category->insert($category);

        $this->assertEquals(1, $this->category->delete($categoryId));
        $this->assertEquals([], $this->category->getAll());
    }
}
