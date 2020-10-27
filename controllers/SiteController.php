<?php 

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\managers\UserManager;
use app\models\Message;
use app\models\User;

class SiteController extends Controller {


    public UserManager $userManager ;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function home()
    {
        $params =[
            'name' => 'The Chat ',
        ];

        return $this->render('home', $params);
    }



    public function chat(Request $request)
    {
        //user is auth.
        if (!Application::isGuest() && Helper::auth()->status === User::STATE['ACTIVE']){
            //show form message
            $message = new Message();

            //manager get all user online
            $users = $this->userManager->findAllOnline();

           // $this->setLayout('chat');
            return $this->render('index', [ 'users' => $users], 'chat');
        }
        $this->addFlashMessage('warning', 'You are not authorized');
        return $this->redirectTo('/login');

    }



}