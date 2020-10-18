<?php

namespace app\core;

class Autoloader {

    /**
     * @return void
     */
    public static function register(){

        spl_autoload_register([__CLASS__, 'autoload']);
    }


    /**
     *
     * @param string $class
     * @return void
     */
    public static function autoload(string $class){

        $mainDir = explode("\\", __NAMESPACE__); //return array de chaine de caratères.

        $mainDir = array_shift($mainDir); //App //Dépile l'élément au début d'un tableau

        $class = str_replace($mainDir, '', $class); //Remplace toutes les occurrences($mainDir) dans une chaîne ($class)

        $class = str_replace('\\', '/', $class);
        //require 'App' . $class . '.php';

       //var_dump(__DIR__ .'/../' . $class);

        require  __DIR__ . '/../' . $class. '.php';


    }

}