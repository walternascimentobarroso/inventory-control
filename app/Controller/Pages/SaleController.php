<?php

namespace App\Controller\Pages;

use App\Model\DAO\Sale;
use App\Controller\Http\Response;

class SaleController
{
    public function createTable()
    {
        $result = (new Sale())->createTables();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function getAll()
    {
        $result = (new Sale())->getAll();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function get($id)
    {
        $result = (new Sale())->get($id['id']);
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(201, (new Sale())->insert($data)))->sendResponse();
    }

    public function update($id)
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(204, (new Sale())->update($id['id'], $data)))->sendResponse();
    }

    public function delete($id)
    {
        return (new Response(204, (new Sale())->delete($id['id'])))->sendResponse();
    }
}
