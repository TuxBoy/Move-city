<?php
namespace App\Controller;

use App\Entity\User;
use App\Service\AuthService;
use Core\PhpRenderer;
use App\Table\UserTable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController 
{


  /**
   * @param PhpRenderer $renderer
   * @param Request $request
   * @param AuthService $authService
   * @return string
   * @throws \Exception
   */
  public function login(PhpRenderer $renderer, Request $request, AuthService $authService): string
  {
    if ($request->getMethod() === 'POST') {
      $username = $request->request->get('username');
      $password = $request->request->get('password');
      if ($authService->login($username, $password)) {
        return new RedirectResponse('/');
      }
    }
    return $renderer->render('user.login');
  }

  /**
   * @param Request $request
   * @param PhpRenderer $renderer
   * @param UserTable $userTable
   * @return string
   * @throws \Doctrine\DBAL\DBALException
   * @throws \PhpDocReader\AnnotationException
   * @throws \ReflectionException|\Exception
   */
    public function register(Request $request, PhpRenderer $renderer, UserTable $userTable): string
    {
        if ($request->getMethod() === 'POST') {
            $user = new User($request->request->all());
            $userTable->save($user);
            $request->getSession()->set('user', $user);
            return new RedirectResponse('/');
        }
        return $renderer->render('user.register');
    }

    public function destroy(Request $request)
    {
      if ($request->getSession()->has('user')) {
        $request->getSession()->remove('user');
        return new RedirectResponse('/');
      }
    }

}