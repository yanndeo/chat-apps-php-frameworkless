<?php

namespace app\core;


class Response
{

    public function setStatusCode(int $code)
    {
        http_response_code($code); //Récupère ou définit le code de réponse HTTP
    }

    /**
     * @param string $string
     */
    public function redirect(string $url)
    {
        header('Location:'.$url);
        exit();
    }



    public function json($data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }

}
