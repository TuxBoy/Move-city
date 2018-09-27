<?php
namespace App\Service;

use Geocoder\Collection;
use Geocoder\Exception\Exception;
use Geocoder\Model\AddressCollection;
use Geocoder\Provider\Addok\Addok;
use Geocoder\Query\GeocodeQuery;
use Geocoder\StatefulGeocoder;
use Http\Adapter\Guzzle6\Client;

/**
 * Class GeocoderService
 */
class GeocoderService
{

	/**
	 * @var StatefulGeocoder
	 */
	private $geoCoder;

	public function __construct()
	{
		$provider       = Addok::withBANServer(new Client());
		$this->geoCoder = new StatefulGeocoder($provider);
	}

	/**
	 * @param string $address
	 * @return Collection|AddressCollection
	 */
	public function addressToCoordinate(string $address): Collection
	{
		try {
			return $this->geoCoder->geocodeQuery(GeocodeQuery::create($address));
		} catch (Exception $exception) {
			// Nothing
		}
	}

}
