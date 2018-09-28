<?php
namespace Core\Command;

use Symfony\Component\Console\Command\Command;

/**
 * Class BaseCommand
 */
abstract class BaseCommand extends Command
{

	/**
	 * @return string
	 */
	public function getAppRoot(): string
	{
		return dirname(dirname(__DIR__));
	}

}
