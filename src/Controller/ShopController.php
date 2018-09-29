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

  /**
   * @var PhpRenderer
   */
  private $renderer;

  /**
   * ShopController constructor
   *
   * @param ShopTable $shopTable
   * @param PhpRenderer $renderer
   */
  public function __construct(ShopTable $shopTable, PhpRenderer $renderer)
  {
    $this->shopTable = $shopTable;
    $this->renderer  = $renderer;
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
	public function create(Request $request, GeocoderService $geocoderService)
	{
		if ($request->getMethod() === 'POST') {
		  $address = $request->request->get('street') . ' ' . $request->request->get('postal_code')
        . ' ' . $request->request->get('city')
        . ' ' . $request->request->get('country');
		  if ($addresses_found = $geocoderService->addressToCoordinate($address)->first()) {
        $request->request->set('longitude', $addresses_found->getCoordinates()->getLongitude());
        $request->request->set('latitude', $addresses_found->getCoordinates()->getLatitude());
      }
			$this->shopTable->save($request->request->all());
			return new RedirectResponse('/');
		}
		return $this->renderer->render('shop.create');
	}

  /**
   * @param int $id
   * @param Request $request
   * @return string
   * @throws \Exception
   */
	public function edit(int $id, Request $request)
  {
    $shop = $this->shopTable->get($id);
    if ($request->getMethod() === 'POST') {
      // Update the shop
    }
    return $this->renderer->render('shop.edit', compact('shop'));
  }

}
