<?php

namespace App\Model\DAO;

use App\Controller\Http\Db\Connection;

class Product
{

    private $pdo;
    private $table = 'products';

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
        description   VARCHAR (255),
        category    INTEGER,
        barcode   VARCHAR (255),
        value   VARCHAR (255),
        tax   VARCHAR (255)
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
            $data[$i]["description"] = $row["description"];
            $data[$i]["category"] = $row["category"];
            $data[$i]["barcode"] = $row["barcode"];
            $data[$i]["value"] = $row["value"];
            $data[$i]["tax"] = $row["tax"];
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
            $data["description"] = $row["description"];
            $data["category"] = $row["category"];
            $data["barcode"] = $row["barcode"];
            $data["value"] = $row["value"];
            $data["tax"] = $row["tax"];
        }

        return $data;
    }

    public function getBarcode($barcode)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE barcode = :barcode");
        $stmt->bindParam(":barcode", $barcode);
        $stmt->execute();
        $data = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data["description"] = $row["description"];
            $data["category"] = $row["category"];
            $data["barcode"] = $row["barcode"];
            $data["value"] = $row["value"];
            $data["tax"] = $row["tax"];
        }

        return $data;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (description, category, barcode, value, tax) VALUES (:description, :category, :barcode, :value, :tax)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":description", $data["description"]);
        $stmt->bindValue(":category", $data["category"]);
        $stmt->bindValue(":barcode", $data["barcode"]);
        $stmt->bindValue(":value", $data["value"]);
        $stmt->bindValue(":tax", $data["tax"]);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE $this->table SET description = :description, category = :category, barcode = :barcode, value = :value, tax = :tax WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":description", $data["description"]);
        $stmt->bindValue(":category", $data["category"]);
        $stmt->bindValue(":barcode", $data["barcode"]);
        $stmt->bindValue(":value", $data["value"]);
        $stmt->bindValue(":tax", $data["tax"]);
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
