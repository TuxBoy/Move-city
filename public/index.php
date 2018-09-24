<?php

// Utilities constants
define('APP_ROOT', dirname(__DIR__));
define('SL',       DIRECTORY_SEPARATOR);
define('DOT',      '.');

require APP_ROOT . '/vendor/autoload.php';

use Symfony\Component\Debug\Debug;
use function Http\Response\send;

Debug::enable();

$request = trim($_SERVER['REQUEST_URI'], '/') ?? '/';

$parts_request   = explode('/', $request);
$controller_name = $parts_request[0];
if (count($parts_request) === 1) {
    $controller_name = App\Str::lParse($controller_name, '?');
}

$controller = 'App\\Controller\\' . ucfirst($controller_name) . 'Controller';
if (!class_exists($controller)) {
    throw new \Exception("The controller {get_class($controller)} does not exist");
}
$controller_instanciable = new $controller();

if (is_callable($controller_instanciable)) {
    $response = call_user_func_array($controller_instanciable, []);
}
else {
    $action = count($parts_request) > 1 ? App\Str::lParse($parts_request[1], '?') : 'index';
    $response = call_user_func_array([$controller, $action], []);
}

if (is_string($response)) {
	$response = new \GuzzleHttp\Psr7\Response(200, [], $response);
}

send($response);
