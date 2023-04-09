<?php

use App\Model\DAO\User;
use PHPUnit\Framework\TestCase;
use App\Controller\Http\Db\TestConnection;

class UserTest extends TestCase
{
    private $user;
    private $pdo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdo = (new TestConnection())->connect();
        $this->user = new User($this->pdo);
        $this->user->createTables(); // cria a tabela antes dos testes
    }

    public function testInsertAndGet()
    {
        $data = [
            "name" => "John",
            "email" => "john@example.com"
        ];

        $id = $this->user->insert($data);
        $this->assertNotNull($id); // verifica se o ID retornado não é nulo

        $userData = $this->user->get($id);
        $this->assertEquals("John", $userData["name"]); // verifica se o nome é o esperado
        $this->assertEquals("john@example.com", $userData["email"]); // verifica se o email é o esperado
    }

    public function testUpdate()
    {
        $data = [
            "name" => "Jane",
            "email" => "jane@example.com"
        ];

        $id = $this->user->insert($data);
        $this->assertNotNull($id); // verifica se o ID retornado não é nulo

        $data["name"] = "Janet";
        $data["email"] = "janet@example.com";

        $result = $this->user->update($id, $data);
        $this->assertTrue($result); // verifica se o resultado da atualização é verdadeiro

        $userData = $this->user->get($id);
        $this->assertEquals("Janet", $userData["name"]); // verifica se o nome foi atualizado corretamente
        $this->assertEquals("janet@example.com", $userData["email"]); // verifica se o email foi atualizado corretamente
    }

    public function testDelete()
    {
        $data = [
            "name" => "Alice",
            "email" => "alice@example.com"
        ];

        $id = $this->user->insert($data);
        $this->assertNotNull($id); // verifica se o ID retornado não é nulo

        $result = $this->user->delete($id);
        $this->assertEquals(1, $result); // verifica se apenas 1 linha foi afetada pela exclusão

        $userData = $this->user->get($id);
        $this->assertEmpty($userData); // verifica se não há dados retornados para o ID excluído
    }
}
