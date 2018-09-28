<?php
namespace Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateProjectCommand extends Command
{

	/**
	 * @return string
	 */
	public function getAppRoot(): string
	{
		return dirname(dirname(__DIR__));
	}

	protected function configure()
	{
		$this
			->setName('app:update-project')
			->setDescription('Update git project and composer dependencies');
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 * @return string
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		chdir($this->getAppRoot());
		$git_result = shell_exec('git pull');

		if ($git_result) {
			$output->write($git_result);
			$dependencies = $this->getDependenciesNotInstalled();
			if (!empty($dependencies)) {
				$output->write("Les dépendances vont être installé : \n" . implode("\n", $dependencies));
				exec('composer update');
			}
			return $output->writeln('Le projet à bien été mis à jour');
		}
		return $output->writeln("Le projet n'a pas pu se mettre à jour. Veuillez réessayée.");
	}

	/**
	 * @return string[]|null Array that contains the not installed dependencies
	 */
	private function getDependenciesNotInstalled(): ?array
	{
		$composer_show          = explode("\n", shell_exec('composer show -iND'));
		$installed_dependencies = array_map('trim', $composer_show);
		if (!file_exists($this->getAppRoot() . '/composer.json')) {
			return null;
		}
		$composer_json_file     = file_get_contents($this->getAppRoot() . '/composer.json');
		$composer_json_content  = json_decode($composer_json_file, true);

		// Merge in the same array require and require-dev without php dependency
		$dependencies = array_filter(
			array_merge($composer_json_content['require'], $composer_json_content['require-dev']),
			function ($dependency) { return $dependency !== 'php'; }, ARRAY_FILTER_USE_KEY
		);

		return array_diff(array_keys($dependencies), array_values($installed_dependencies));
	}

}
