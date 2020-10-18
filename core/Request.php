<?php

namespace app\core;

/**
 * - Request manipulate global variables
 * - Get the uri path and find type meth.
 */
class Request
{




    public function getPath(): string
    {
        //get the url path
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        //deduce position of '?'
        $position = strpos($path, '?');

        //if path has not '?' exit
        if ($position === false) {
            return $path;
        }
        //else cut path. remove other part after ?xxxx
        return substr($path, 0, $position);
    }



    /**
     * return request method
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }



    /**
     * Check request 
     * @return boolean
     */
    public function isGet(): bool
    {
       return $this->getMethod() === 'get'; 
    }

    /**
     * Check request 
     * @return boolean
     */
    public function isPost(): bool
    {
       return $this->getMethod() === 'post' ;
    }


    /**
     * Get $_GET , $_POST data
     * and filter this
     * sanitize user data input
     * @return array
     */
    public function getBody(): array
    {
        $body = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->getMethod() === 'post'){
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
