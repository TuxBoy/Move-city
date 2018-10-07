<?php
namespace App\Controller;

use App\Entity\Category;
use App\Table\CategoryTable;
use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 */
class CategoryController
{

  /**
   * @param PhpRenderer $renderer
   * @param CategoryTable $categoryTable
   * @return string
   * @throws \Exception
   */
  public function index(PhpRenderer $renderer, CategoryTable $categoryTable)
  {
    return $renderer->render('category.index', ['categories' => $categoryTable->getAll()]);
  }

  /**
   * @param Request $request
   * @param PhpRenderer $renderer
   * @param CategoryTable $categoryTable
   * @return string|RedirectResponse
   * @throws \Doctrine\DBAL\DBALException
   * @throws \ReflectionException|\Exception
   */
  public function add(Request $request, PhpRenderer $renderer, CategoryTable $categoryTable)
  {
    if ($request->getMethod() === 'POST') {
      $category = new Category($request->request->all());
      $categoryTable->save($category);
      return new RedirectResponse('/category');
    }
    return $renderer->render('category.add', ['category' => new Category]);
  }

  /**
   * @param int $id
   * @param Request $request
   * @param PhpRenderer $renderer
   * @param CategoryTable $categoryTable
   * @return string|RedirectResponse
   * @throws \Doctrine\DBAL\DBALException
   * @throws \ReflectionException|\Exception
   */
  public function edit(int $id, Request $request, PhpRenderer $renderer, CategoryTable $categoryTable)
  {
    /** @var $category Category */
    $category = $categoryTable->get($id);
    if ($request->getMethod() === 'POST') {
      $category->set($request->request->all());
      $categoryTable->save($category);
      return new RedirectResponse('/category');
    }
    return $renderer->render('category.add', ['category' => $category]);
  }

  /**
   * @param int $id
   * @param Request $request
   * @param CategoryTable $categoryTable
   * @return RedirectResponse
   * @throws \Doctrine\DBAL\DBALException
   * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
   */
  public function delete(int $id, Request $request, CategoryTable $categoryTable)
  {
    if ($request->getMethod() !== 'POST') {
      throw new \Exception("Not allow resource method");
    }
    if (!$categoryTable->get($id)) {
      throw new \Exception("Aucune catégorie n'a été trouvé pour cet identifiant");
    }
    $categoryTable->delete($id);
    return new RedirectResponse('/category');
  }

}