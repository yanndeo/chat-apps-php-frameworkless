<?php 

namespace app\controllers;

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
        $this->setLayout('chat');
        return $this->render('index');
    }



}