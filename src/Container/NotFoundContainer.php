<?php
namespace App\Container;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class NotFoundContainer
 * @package App\Container
 */
class NotFoundContainer extends Exception implements ContainerExceptionInterface
{

}
