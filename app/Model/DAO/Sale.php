<?php

namespace App\Model\DAO;

use App\Controller\Http\Db\Connection;

class Sale
{

    private $pdo;
    private $table = 'sale';

    public function __construct($connection = null)
    {
        if (!$connection) {
            $connection = (new Connection())->connect();
        }
        $this->pdo = $connection;
    }

    public function createTables()
    {
        $commands = <<<TABLE
    CREATE TABLE IF NOT EXISTS $this->table (
        id   INTEGER PRIMARY KEY,
        items   VARCHAR (255),
        total    INTEGER
    )
TABLE;

        try {
            $this->pdo->exec($commands);
            return "Success!\n";
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM $this->table");
        $data = [];
        $i = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[$i]["id"] = $row["id"];
            $data[$i]["items"] = $row["items"];
            $data[$i]["total"] = $row["total"];
            $i++;
        }

        return $data;
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data["items"] = $row["items"];
            $data["total"] = $row["total"];
        }

        return $data;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (items, total) VALUES (:items, :total)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":items", $data["items"]);
        $stmt->bindValue(":total", $data["total"]);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE $this->table SET items = :items, total = :total WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":items", $data["items"]);
        $stmt->bindValue(":total", $data["total"]);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->rowCount();
    }
}
