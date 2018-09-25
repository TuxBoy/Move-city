<?php
namespace App;

use Exception;

/**
 * Class PhpRenderer
 *
 * @package App
 */
class PhpRenderer
{

	/**
	 * @var string[]
	 */
	private $config;

	/**
	 * PhpRenderer constructor
	 *
	 * @param array $config
	 */
	public function __construct(array $config = [])
	{
		$this->config = array_merge(['path' => APP_ROOT . '/views/'], $config);
	}

	/**
	 * @param string $view
	 * @param array  $data
	 * @return string
	 * @throws Exception
	 */
	public function render(string $view, array $data = []): string
	{
		$view = str_replace('.', SL, $view) . '.php';
		if (!file_exists($this->config['path'] . $view)) {
			throw new Exception('The view ' . $this->config['path'] . $view . ' does not exist');
		}
		ob_start();
		/** @noinspection PhpUnusedLocalVariableInspection */
		$renderer = $this;
		extract($data);
		include $this->config['path'] . $view;
		return ob_get_clean();
		// TODO : Global layout
		//include $this->config['path'] . 'layout.php';
	}

}
