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

}