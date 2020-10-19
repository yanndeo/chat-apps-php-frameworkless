<?php 

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller {


    public function home()
    {
        $params =[
            'name' => 'cha-cha-Tchat',
        ];

        return $this->render('home', $params);
    }



    public function chat()
    {
        //user is auth.
        if (!Application::isGuest()){
            $this->setLayout('chat');
            return $this->render('index');
        }
        $this->addFlashMessage('warning', 'You are not authorized');
        return $this->redirectTo('/login');

    }



}