<?php
namespace Core\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RunCommand
 */
class RunCommand extends BaseCommand
{

	public function configure()
	{
		$this
			->setName('app:run')
			->setDescription('Run internal php server on the 8080 port');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		chdir($this->getAppRoot());
		$output->writeln('[Le serveur PHP est démarré : http://localhost:8080]');
		exec('php -S localhost:8080 -t public/ -ddisplay_errors=1');
	}

}
