<?php
namespace App\Controller;

use App\Entity\Shop;
use App\Service\GeocoderService;
use App\Table\CategoryTable;
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
		return new JsonResponse($this->shopTable->getEnableShops());
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
	 * @param Request         $request
	 * @param GeocoderService $geocoderService
	 * @param CategoryTable   $categoryTable
	 * @return string
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \ReflectionException|\Exception
	 * @throws \PhpDocReader\AnnotationException
	 */
	public function create(Request $request, GeocoderService $geocoderService, CategoryTable $categoryTable)
	{
    if ($request->getMethod() === 'POST') {
			$shop       = new Shop($request->request->all());
			// TODO Généraliser le code afin d'hydrater un collection d'objet  dans une entités
			$categories = array_map(function ($category_id) use ($categoryTable) {
				return $categoryTable->get($category_id);
			}, $request->request->get('categories'));
			foreach ($categories as $category) {
				$shop->addCategory($category);
			}
		  if ($addresses_found = $geocoderService->addressToCoordinate((string) $shop)->first()) {
        $shop
          ->setLongitude($addresses_found->getCoordinates()->getLongitude())
          ->setLatitude($addresses_found->getCoordinates()->getLatitude());
      }
			$this->shopTable->save($shop);
			return new RedirectResponse('/shop');
		}
		return $this->renderer->render('shop.create', [
		  'shop'       => new Shop(),
      'categories' => $categoryTable->getAll()
    ]);
	}

  /**
   * @param int $id
   * @param Request $request
   * @param CategoryTable $categoryTable
   * @return string
   * @throws \Doctrine\DBAL\DBALException
   * @throws \PhpDocReader\AnnotationException
   * @throws \ReflectionException|\Exception
   */
	public function edit(int $id, Request $request, CategoryTable $categoryTable)
  {
  	/** @var $shop Shop */
    $shop = $this->shopTable->getShopWithCategories($id);
		if ($request->getMethod() === 'POST') {
      $shop->categories->clear();
      $shop->set($request->request->all());
      $categories = array_map(function ($category_id) use ($categoryTable) {
        return $categoryTable->get($category_id);
      }, $request->request->get('categories'));
      foreach ($categories as $category) {
        $shop->addCategory($category);
      }
      $this->shopTable->save($shop);
      return new RedirectResponse('/shop');
    }
    $categories = $categoryTable->getAll();
    return $this->renderer->render('shop.edit', compact('shop', 'categories'));
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

	/**
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function show(int $id): string
	{
		$shop = $this->shopTable->getShopWithCategories($id);
		return $this->renderer->render('shop.show', compact('shop'));
	}

}
