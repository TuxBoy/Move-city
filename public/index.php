<?php

// Utilities constants
define('APP_ROOT', dirname(__DIR__));
define('SL',       DIRECTORY_SEPARATOR);
define('DOT',      '.');

require APP_ROOT . '/vendor/autoload.php';

use Symfony\Component\Debug\Debug;

Debug::enable();

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = new \Symfony\Component\HttpFoundation\Response();

$container = new \Core\Container\DIC($request, $response);
$kernel    = new \Core\Kernel($container);

$dispatcher = new \Core\Dispatcher;
$dispatcher->addMiddleware([$kernel, 'handler']);
$response = $dispatcher->process($request, $response);

$response->send();
