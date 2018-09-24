<?php
namespace App;

abstract class Str
{

    /**
     * Get left part of the string from the separator
     */
    public static function lParse(string $string, string $separator = '/'): string
    {
        return substr($string, 0, strrpos($string, $separator));
    }

}