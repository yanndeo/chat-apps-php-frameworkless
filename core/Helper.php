<?php
namespace app\core;

use app\models\User;

class Helper {


    public static function dump($variable)
    {
        echo '<pre> ';
         var_dump($variable);
        echo '</pre>';
    }


    /**
     * Heredoc string
     * use key to
     */
    public static function flashMessage()
    {
        $data = Application::$app->session->gellAllFlashMessage();

        if(count($data) > 0){
            foreach ($data as $key => $s){
                $message =$s['value'];
                echo <<<EOT
            <div class="alert alert-$key">$message</div>
            EOT;
            }
        }
    }




    public static function auth()
    {
       return Application::$app->user;
    }

    public static function logout()
    {
        Application::$app->logout();
    }





}