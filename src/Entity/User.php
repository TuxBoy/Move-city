<?php
namespace App\Entity;

use Core\Entity;

class User extends Entity
{

  /**
   * @var integer
   */
  public $id;
    
  /**
   * @length 60
   * @var string
   */
  public $username;

  /**
   * @var string
   */
  public $email;

  /**
   * @var string
   */
  public $password;

  /**
   * @var string
   */
  public $firstname;

  /**
   * @var string
   */
  public $lastname;

  /**
   * @param $password string
   * @return User
   */
  public function setPassword(string $password): self
  {
    $this->password = sha1($password);

    return $this;
  }

  /**
   * @param string $password
   * @return bool
   */
    public function checkPassword(string $password): bool
    {
      return $this->password === sha1($password);
    }

}