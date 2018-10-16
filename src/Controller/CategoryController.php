<?php
namespace App\Controller;

use App\Entity\Category;
use App\EventManager\ImageEvent;
use App\EventManager\OptimizeImageEvent;
use App\Table\CategoryTable;
use Core\EventManager\EventManager;
use Core\EventManager\EventManagerInterface;
use Core\PhpRenderer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
	 * @param Request       $request
	 * @param PhpRenderer   $renderer
	 * @param CategoryTable $categoryTable
	 * @param EventManager  $eventManager
	 * @return string|RedirectResponse
	 * @throws \Doctrine\DBAL\DBALException|\Exception
	 * @throws \PhpDocReader\AnnotationException
	 * @throws \ReflectionException
	 */
  public function add(
  	Request $request, PhpRenderer $renderer, CategoryTable $categoryTable, EventManager $eventManager
	) {
    if ($request->getMethod() === 'POST') {
      $category = new Category($request->request->all());
      $category->setSlug();
      if ($request->files->has('image')) {
        $category->image = $this->upload($request->files->get('image'), $category);
				$eventManager->trigger(new OptimizeImageEvent($category));
			}
      $categoryTable->save($category);
      return new RedirectResponse('/category');
    }
    return $renderer->render('category.add', ['category' => new Category]);
  }

  /**
   * @param UploadedFile $file
   * @param Category $category
   * @return string
   */
  private function upload(UploadedFile $file, Category $category): string
  {
    $image_name = $category->slug . DOT . $file->getClientOriginalExtension();
    $file->move(PUBLIC_PATH . 'uploads', $image_name);
    return $image_name;
  }

	/**
	 * @param int                   $id
	 * @param Request               $request
	 * @param PhpRenderer           $renderer
	 * @param CategoryTable         $categoryTable
	 * @param EventManagerInterface $eventManager
	 * @return string|RedirectResponse
	 * @throws \Doctrine\DBAL\DBALException
	 * @throws \PhpDocReader\AnnotationException
	 * @throws \ReflectionException|\Exception
	 */
  public function edit(
  	int $id, Request $request, PhpRenderer $renderer, CategoryTable $categoryTable,
		EventManagerInterface $eventManager
	) {
    /** @var $category Category */
    $category = $categoryTable->get($id);
    if ($request->getMethod() === 'POST') {
      $category->set($request->request->all());
      $category->setSlug();
      if ($request->files->has('image') && $request->files->get('image')) {
        $category->image = $this->upload($request->files->get('image'), $category);
				$eventManager->trigger(new OptimizeImageEvent($category));
      }
      $categoryTable->save($category);
      return new RedirectResponse('/category');
    }
    return $renderer->render('category.add', ['category' => $category]);
  }

	/**
	 * @param int                   $id
	 * @param Request               $request
	 * @param CategoryTable         $categoryTable
	 * @param EventManagerInterface $eventManager
	 * @return RedirectResponse
	 * @throws \Doctrine\DBAL\DBALException|\Exception
	 * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
	 */
  public function delete(int $id, Request $request, CategoryTable $categoryTable, EventManagerInterface $eventManager)
  {
    if ($request->getMethod() !== 'POST') {
      throw new \Exception("Not allow resource method");
    }
    /** @var $category Category */
    $category = $categoryTable->get($id);
    if (!$category) {
      throw new \Exception("Aucune catégorie n'a été trouvé pour cet identifiant");
    }
    $categoryTable->delete($id);
    $eventManager->trigger(new ImageEvent($category));
    return new RedirectResponse('/category');
  }

}
