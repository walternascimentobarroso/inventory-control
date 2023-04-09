<?php

namespace App\Controller\Http\Db;

class TestConnection
{

    public function connect()
    {
        $pdo = new \PDO('sqlite::memory:');
        return $pdo;
    }
}
