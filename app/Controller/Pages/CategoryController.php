<?php

namespace App\Controller\Pages;

use App\Model\DAO\Category;
use App\Controller\Http\Response;

class CategoryController
{

    public function createTable()
    {
        $result = (new Category())->createTables();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function getAll()
    {
        $result = (new Category())->getAll();
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function get($id)
    {
        $result = (new Category())->get($id['id']);
        return (new Response(200, json_encode($result)))->sendResponse();
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(201, (new Category())->insert($data)))->sendResponse();
    }

    public function update($id)
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return (new Response(204, (new Category())->update($id['id'], $data)))->sendResponse();
    }

    public function delete($id)
    {
        return (new Response(204, (new Category())->delete($id['id'])))->sendResponse();
    }
}
