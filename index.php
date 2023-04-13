<?php

require __DIR__ . '/vendor/autoload.php';

use App\Model\DAO\Product;
use App\Controller\Http\Db\Connection;

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/.env');

function createDATABASE()
{
    $connection = (new Connection())->connect();
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE DATABASE postgresss";
    $connection->exec($query);
}

function createTables()
{
    $commands = <<<TABLE
        CREATE TABLE public.categories (
            id serial PRIMARY KEY,
            description varchar NULL
        );

        CREATE TABLE public.products (
            id serial PRIMARY KEY,
            description varchar NULL,
            category int4 NULL,
            barcode varchar NULL,
            value varchar NULL,
            tax varchar NULL
        );

        CREATE TABLE public.sales (
            id serial PRIMARY KEY,
            items varchar(255) NULL,
            total int4 NULL
        );

        CREATE TABLE public.users (
            id serial PRIMARY KEY,
            name varchar(255) NULL,
            email varchar(255) NULL
        );
TABLE;

    try {
        $connection = (new Connection())->connect();
        $connection->exec($commands);
        return "Success!\n";
    } catch (\PDOException $e) {
        exit($e->getMessage());
    }
}

createDATABASE();
createTables();
