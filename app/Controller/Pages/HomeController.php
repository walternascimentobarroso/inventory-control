<?php

namespace App\Controller\Pages;

use App\Controller\Http\Response;

class HomeController
{
    public function index()
    {
        echo ("<pre>");
        print_r(__DIR__);
        echo ("</pre>");
        echo ("<pre>");
        print_r($_ENV);
        echo ("</pre>");
        $result = "Welcome";
        return (new Response(200, json_encode($result)))->sendResponse();
    }
}
