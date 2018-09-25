<?php

// Utilities constants
define('APP_ROOT', dirname(__DIR__));
define('SL',       DIRECTORY_SEPARATOR);
define('DOT',      '.');

require APP_ROOT . '/vendor/autoload.php';

use Symfony\Component\Debug\Debug;

Debug::enable();

$container = new \Core\Container\DIC;
$kernel    = new \Core\Kernel($container);
$response  = $kernel->handler(\Symfony\Component\HttpFoundation\Request::createFromGlobals());

$response->send();
