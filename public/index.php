<?php

// Utilities constants
define('APP_ROOT', dirname(__DIR__));
define('SL',       DIRECTORY_SEPARATOR);
define('DOT',      '.');

require APP_ROOT . '/vendor/autoload.php';

use Symfony\Component\Debug\Debug;
use function Http\Response\send;

Debug::enable();

$kernel   = new \App\Kernel();
$response = $kernel->handler(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

send($response);
