<?php
namespace App\Controller;

use App\Service\GeocoderService;
use App\Table\ShopTable;
use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ShopController
 */
class ShopController
{

  /**
   * @var ShopTable
   */
  private $shopTable;

  public function __construct(ShopTable $shopTable)
  {
    $this->shopTable = $shopTable;
  }

  /**
	 * @param ShopTable $shopTable
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		return new JsonResponse($this->shopTable->getAll());
	}

  /**
   * @param PhpRenderer $renderer
   * @param Request $request
   * @param GeocoderService $geocoderService
   * @return string
   * @throws \Exception
   */
	public function create(PhpRenderer $renderer, Request $request, GeocoderService $geocoderService)
	{
		if ($request->getMethod() === 'POST') {
		  $address = $request->request->get('street') . ' ' . $request->request->get('postal_code')
        . ' ' . $request->request->get('city')
        . ' ' . $request->request->get('country');
		  $addresses_found = $geocoderService->addressToCoordinate($address)->first();
		  if ($addresses_found) {
        $request->request->set('description', 'aeaz');
        $request->request->set('longitude', $addresses_found->getCoordinates()->getLongitude());
        $request->request->set('latitude', $addresses_found->getCoordinates()->getLatitude());
        $request->request->set('enable', '0');
      }
			$this->shopTable->save($request->request->all());
			return new RedirectResponse('/');
		}
		return $renderer->render('shop.create');
	}

}
