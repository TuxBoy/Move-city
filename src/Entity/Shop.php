<?php
namespace App\Entity;

class Shop
{

  /**
   * @var int
   */
  public $id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $street;

	/**
	 * @var string
	 */
	public $postal_code;

	/**
	 * @var string
	 */
	public $city;

	/**
	 * @var string
	 */
	public $country;

	/**
	 * @text
	 * @var string
	 */
	public $description;

	/**
	 * @var float
	 */
	public $latitude;

	/**
	 * @var float
	 */
	public $longitude;

	/**
	 * @var boolean
	 */
	public $enable = 0;


}
