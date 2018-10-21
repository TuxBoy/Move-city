<?php
namespace App\Table;

use Core\Table;
use App\Entity\User;

/**
 * Class UserTable
 * @package App\Table
 */
class UserTable extends Table
{

  protected static $table_name = 'users';

  protected static $entity = User::class;

  /**
   * @param string $username
   * @return User|null
   * @throws \Exception
   */
  public function findBy(string $username): ?User
  {
    $record = $this->connection->createQueryBuilder()
      ->select('*')
      ->from(static::$table_name, 't')
      ->where('username = ?')
      ->setParameter(0, $username)
      ->execute()
      ->fetch();
    /** @var $user User */
    $user = $this->hydrate($record);
    return $user;
  }

}
