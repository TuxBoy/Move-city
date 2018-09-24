<?php
namespace App;

use Exception;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handler(ServerRequestInterface $request): ResponseInterface
    {
        $clear_request = trim($request->getUri()->getPath(), '/') ?? '/';
        $parts_request = explode('/', $clear_request);
        $controller_name = $parts_request[0];
        if (count($parts_request) === 1) {
            ///$controller_name = Str::lParse($controller_name, '?');
        }
        $controller = 'App\\Controller\\' . ucfirst($controller_name) . 'Controller';
        if (!class_exists($controller)) {
            throw new Exception("The controller $controller does not exist");
        }
        $controller_instantiable = new $controller();
        if (is_callable($controller_instantiable)) {
            $response = call_user_func_array($controller_instantiable, []);
        }
        else {
            $action   = count($parts_request) > 1 ? Str::lParse($parts_request[1], '?') : 'index';
            $response = call_user_func_array([$controller, $action], []);
        }

        if (is_string($response)) {
            $response = new Response(200, [], $response);
        }

        return $response;
    }

}