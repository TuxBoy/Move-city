<?php
namespace App\Entity;

use Core\Entity;

class Shop extends Entity
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

  /**
   * @return string
   */
	public function __toString(): string
  {
    return $this->street. ' ' . $this->postal_code . ' ' . $this->city . ' ' . $this->country;
  }

  /**
   * @param float $latitude
   * @return Shop
   */
  public function setLatitude(float $latitude): Shop
  {
    $this->latitude = $latitude;

    return $this;
  }

  /**
   * @param float $longitude
   * @return Shop
   */
  public function setLongitude(float $longitude): Shop
  {
    $this->longitude = $longitude;

    return $this;
  }


}
