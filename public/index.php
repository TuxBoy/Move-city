<?php

// Utilities constants
define('APP_ROOT',    dirname(__DIR__));
define('SL',          DIRECTORY_SEPARATOR);
define('DOT',         '.');
define('PUBLIC_PATH', APP_ROOT . '/public/');

require APP_ROOT . '/vendor/autoload.php';

use SDAM\Config;
use SDAM\EntityAdapter\EntityAdapter;
use App\Middleware\MaintainerMiddleware;
use Symfony\Component\Debug\Debug;

Debug::enable();

// Create of get local config file
$loc_file = APP_ROOT . '/loc.php';
if (!file_exists($loc_file)) {
	file_put_contents($loc_file, file_get_contents(APP_ROOT . '/loc.blank.php'));
}
$loc = require $loc_file;

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = new \Symfony\Component\HttpFoundation\Response();

$request->setSession(new \Symfony\Component\HttpFoundation\Session\Session());
if (!$request->getSession()->isStarted()) {
  $request->getSession()->start();
}

// DI
$container = new \Core\Container\DIC($request, $response);

$container->set('config.db', function () use ($loc) {
	return $loc[\Doctrine\DBAL\Connection::class];
});

$container->set(\Doctrine\DBAL\Connection::class, function (\Psr\Container\ContainerInterface $container) {
	return \Doctrine\DBAL\DriverManager::getConnection($container->get('config.db'));
});

$container->set(\Core\EventManager\EventManagerInterface::class, function (\Psr\Container\ContainerInterface $container) {
	$eventManager = new \Core\EventManager\EventManager($container);
	$eventManager
		->attach('entity.delete.image', \App\EventListener\DeleteImageEventListener::class)
		->attach('image.optimize'     , \App\EventListener\OptimizeImageListener::class);
	return $eventManager;
});

$container->set(Core\PhpRenderer::class, function () use ($request) {
	$renderer = new Core\PhpRenderer();
	$renderer->addGlobal('session', $request->getSession());

	return $renderer;
});

// Kernel and Middleware application
$kernel     = new \Core\Kernel($container);
$dispatcher = new \Core\Dispatcher($container);
$dispatcher
	->addMiddleware(
			new MaintainerMiddleware(
				new EntityAdapter(APP_ROOT . '/src/Entity'),
				[
					Config::DATABASE => $container->get('config.db')
				]
		))
  ->addMiddleware(\App\Middleware\AdminMiddleware::class)
	->addMiddleware([$kernel, 'handler']);
$response = $dispatcher->process($request, $response);

$response->send();
