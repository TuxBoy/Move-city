<?php
namespace App\Entity;

use Core\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use SDAM\Traits\HasTimestamp;

/**
 * Class Shop
 */
class Shop extends Entity
{
	use HasTimestamp;

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
	public $enable;

  /**
   * @link belongsToMany
   * @var Category[]
   */
	public $categories;

	public function __construct(array $request = [])
	{
		parent::__construct($request);
		$this->categories = new ArrayCollection();
	}

	/**
	 * A shop is represented by its address
	 *
   * @return string
   */
	public function __toString(): string
  {
    return $this->street . ' ' . $this->postal_code . ' ' . $this->city . ' ' . $this->country;
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

	/**
	 * @param Category|null ...$categories
	 */
  public function addCategory(?Category ...$categories): void
	{
		foreach ($categories as $category) {
			if (!$this->categories->contains($category)) {
				$this->categories->add($category);
			}
		}
	}

	/**
	 * @return Collection
	 */
	public function getCategories(): Collection
	{
		return $this->categories;
	}

	/**
	 * @return string List of names with ',' separator (category_name1, category_name2 etc.)
	 */
	public function getListCategoryName(): string
	{
		return join(
			', ', $this->getCategories()->map(function ($category) { return $category->name; })->getValues()
		);
	}

}
