<?php
namespace app\core;

class Helper {


    public static function dump($variable)
    {
        echo '<pre> ';
        var_dump($variable);
        echo '</pre>';
    }



}