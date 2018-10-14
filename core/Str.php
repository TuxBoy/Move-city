<?php
namespace Core;

/**
 * Class Str
 *
 * @package Core
 */
abstract class Str
{

  /**
   * Get left part of the string from the separator
   *
   * @param string $string
   * @param string $separator
   * @return string
   */
  public static function lParse(string $string, string $separator = '/'): string
  {
      return substr($string, 0, strrpos($string, $separator));
  }

  /**
   * @param string $string
   * @return string
   */
  public static function slugify(string $string): string
  {
    return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
  }

}