<?php
namespace App\Middleware;

use App\Service\AuthService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
  /**
   * @var AuthService
   */
  private $authService;

  /**
   * AdminMiddleware constructor.
   * @param AuthService $authService
   */
  public function __construct(AuthService $authService)
  {
    $this->authService = $authService;
  }

  /**
   * @param Request $request
   * @param Response $response
   * @param callable $next
   * @return RedirectResponse
   * @throws \Exception
   */
  public function __invoke(Request $request, Response $response, callable $next)
  {
    if ($request->getPathInfo() === '/dashboard') {
      $user = $this->authService->getUser();
      if ($user && !$user->isAdmin()) {
        return new RedirectResponse('/user/login');
      }
    }
    return $next($request, $response);
  }

}