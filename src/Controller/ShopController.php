<?php
namespace App\Controller;

use App\Entity\Shop;
use App\Service\GeocoderService;
use App\Table\ShopTable;
use Core\PhpRenderer;
use Http\Discovery\Exception\NotFoundException;
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
	 * @return JsonResponse
	 */
	public function api(): JsonResponse
	{
		return new JsonResponse($this->shopTable->getAll());
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function index()
	{
		return $this->renderer->render('shop.index', ['shops' => $this->shopTable->getAll()]);
	}

  /**
   * @param Request $request
   * @param GeocoderService $geocoderService
   * @return string
   * @throws \Exception
   */
	public function create(Request $request, GeocoderService $geocoderService)
	{
    if ($request->getMethod() === 'POST') {
      $shop = new Shop($request->request->all());
		  if ($addresses_found = $geocoderService->addressToCoordinate((string) $shop)->first()) {
        $shop
          ->setLongitude($addresses_found->getCoordinates()->getLongitude())
          ->setLatitude($addresses_found->getCoordinates()->getLatitude());
      }
			$this->shopTable->save($shop);
			return new RedirectResponse('/');
		}
		return $this->renderer->render('shop.create', ['shop' => new Shop()]);
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
      $shop->set($request->request->all());
      $this->shopTable->save($shop);
      return new RedirectResponse('/shop/edit?id=' . $id);
    }
    return $this->renderer->render('shop.edit', compact('shop'));
  }

	/**
	 * @param int     $id
	 * @param Request $request
	 * @return RedirectResponse
	 * @throws \Exception
	 */
  public function delete(int $id, Request $request)
	{
		if ($request->getMethod() !== 'POST') {
			throw new \Exception("Not allow resource method");
		}
		if (!$this->shopTable->get($id)) {
			throw new NotFoundException("Aucun commerce n'a été trouvé pour cet identifiant");
		}
		$this->shopTable->delete($id);
		return new RedirectResponse('/shop');
	}

}
