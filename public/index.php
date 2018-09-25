<?php

// Utilities constants
define('APP_ROOT', dirname(__DIR__));
define('SL',       DIRECTORY_SEPARATOR);
define('DOT',      '.');

require APP_ROOT . '/vendor/autoload.php';

use Symfony\Component\Debug\Debug;
use function Http\Response\send;

Debug::enable();

$container = new \App\Container\DIC;
$kernel    = new \App\Kernel($container);
$response  = $kernel->handler(\Symfony\Component\HttpFoundation\Request::createFromGlobals());

$response->send();
