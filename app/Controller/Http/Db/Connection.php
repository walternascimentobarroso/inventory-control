<?php

namespace App\Controller\Http\Db;

class Connection
{
    private $pdo;

    public function connect()
    {
        try {
            if ($this->pdo == null) {
                $this->pdo =  $this->setDSN();
            }
            return $this->pdo;
        } catch (\PDOException $e) {
            print "Connection failed: " . $e->getMessage();
        }
    }

    private function setDSN()
    {
        // https://www.php.net/manual/en/function.include.php#example-126
        $in = __DIR__ . '/Database.php';
        ['default' => $default, 'connections' => $connections] = include $in;
        [
            'driver' => $driver,
            'database' => $database,
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
        ] = $connections[$default];
        if ($driver == "sqlite") {
            return new \PDO($driver . ':' . __DIR__ . '/../../../../' . $database);
        }
        return new \PDO("$driver:host=$host;port=$port;dbname=$database;", $username, $password);
    }
}
