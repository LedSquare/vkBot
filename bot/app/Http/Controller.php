<?php

namespace App\Http;

use App\Core\Controller\AbstractController;
use App\Http\Response;

class Controller extends AbstractController
{
    public function index()
    {
        $response = new Response(['name' => 'artyom']);
        $response->response();
    }

    public function testBot()
    {

    }
}
