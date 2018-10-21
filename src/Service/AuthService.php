<?php
namespace App\Service;

use App\Entity\User;
use App\Table\UserTable;
use Symfony\Component\HttpFoundation\Request;

class AuthService
{

  /**
   * @var UserTable
   */
  private $userTable;
  /**
   * @var Request
   */
  private $request;

  public function __construct(Request $request, UserTable $userTable)
  {
    $this->userTable = $userTable;
    $this->request   = $request;
  }

  /**
   * @return User|null
   * @throws \Exception
   */
  public function getUser(): ?User
  {
    $session = $this->request->getSession();
    if ($session->has('user')) {
      /** @var $user User */
      $user = $this->userTable->get($session->get('user'));
      return $user;
    }
    return null;
  }

  /**
   * @param $username
   * @param $password
   * @return bool
   * @throws \Exception
   */
  public function login(string $username, string $password): bool
  {
    $user = $this->userTable->findBy($username);
    if ($user->checkPassword($password)) {
      $this->request->getSession()->set('user', ['user_id' => $user->id, 'username' => $user->username]);
      return true;
    }
    return false;
  }

}