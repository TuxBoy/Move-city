<?php
namespace App\Controller;

use GuzzleHttp\Psr7\Response;

class HomeController
{

    public function __construct()
    {
    }

    public function index($name = '')
    {
        return new Response(200, [], 'Hello');
    }

}
