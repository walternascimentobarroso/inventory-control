<?php

namespace App\Controller\Pages;

use App\Controller\Http\Response;

class HomeController
{
    public function index()
    {
        $result = "Welcome";
        return (new Response(200, json_encode($result)))->sendResponse();
    }
}
