<?php
namespace App\Entity;

use Core\Entity;
use DateTime;

class Time extends Entity
{

	const DAYS = [
		'Lundi',
		'Mardi',
		'Mercredi',
		'Jeudi',
		'Vendredi',
		'Samedi',
		'Dimanche',
	];

	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var string
	 */
	public $day;

	/**
	 * @var DateTime
	 */
	public $start_hours;

	/**
	 * @var DateTime
	 */
	public $end_hours;

	public function __construct(array $request = [])
	{
		if (array_key_exists('day', $request)) {
			$this->day = self::DAYS[$request['day']];
			unset($request['day']);
		}
		parent::__construct($request);
	}

}
