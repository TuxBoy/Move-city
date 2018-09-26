<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SDAM\Config;
use SDAM\EntityAdapter\EntityAdapterInterface;
use SDAM\Maintainer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * MaintainerMiddleware
 *
 * Override maintainer middleware for the symfony http-foundation compatibility
 */
class MaintainerMiddleware
{

	/**
	 * @var string[]
	 */
	private $entities = [
		//...
	];

	/**
	 * MaintainerMiddleware constructor
	 *
	 * @param EntityAdapterInterface $entityAdapter
	 * @param array $config
	 */
	public function __construct(EntityAdapterInterface $entityAdapter, array $config = [])
	{
		$defaultConfig = array_merge([
			Config::DATABASE => [
				'dbname'   => 'autoMigrate',
				'user'     => 'root',
				'password' => 'root',
				'host'     => 'localhost',
				'driver'   => 'pdo_mysql',
			],
			Config::ENTITY_PATH => 'App\Entity'
		], $config);
		Config::current()->configure($defaultConfig);
		$this->entities = $entityAdapter->toArray();
	}

	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param callable $next
	 * @return Response
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \PhpDocReader\AnnotationException
	 * @throws \ReflectionException
	 * @throws \Throwable
	 */
	public function __invoke(Request $request, Response $response, callable $next): Response
	{
		$maintainer = new Maintainer($this->entities);
		$maintainer->run();
		return $next($request, $response);
	}

}
