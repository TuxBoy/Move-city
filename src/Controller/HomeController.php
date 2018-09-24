<?php
namespace App\Controller;

use GuzzleHttp\Psr7\Response;

class HomeController
{

    public function view()
    {
        return new Response(200, [], 'Hello');
    }

}
