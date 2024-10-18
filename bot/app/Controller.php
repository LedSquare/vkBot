<?php

namespace App;

use App\Response;

class Controller
{
    public function index(): Response
    {
        $response = new Response(['name' => 'artyom']);
        return $response;
    }
}
