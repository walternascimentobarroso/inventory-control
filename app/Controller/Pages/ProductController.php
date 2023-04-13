<?php

namespace App\Controller\Pages;

use App\Model\DAO\Product;
use App\Controller\Http\Response;

class ProductController
{

    public function createTable()
    {
        $result = (new Product())->createTables();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function getAll()
    {
        $result = (new Product())->getAll();
        // $result = (new Product())->createTables();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function get($id)
    {
        $result = (new Product())->get($id['id']);
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function getBarcode($barcode)
    {
        $result = (new Product())->getBarcode($barcode['barcode']);
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(201, (new Product())->insert($data)))->sendResponse();
    }

    public function update($id)
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(204, (new Product())->update($id['id'], $data)))->sendResponse();
    }

    public function delete($id)
    {
        return (new Response(204, (new Product())->delete($id['id'])))->sendResponse();
    }
}
