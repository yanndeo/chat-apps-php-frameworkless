<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\models\User;
use app\repositories\UserManager;

class AuthController extends Controller {

    public UserManager $manager;

    public function __construct()
    {
        $this->manager = new UserManager();
    }

    /**
     * @param Request $request
     * @return string|void
     */
    public function register(Request $request)
    {
        $user = new User();

        if($request->isPost()){

            //1-Assign data to the properties model : populate object.
            $user->loadData($request->getBody());

            //2-Check Validation  and user data
            if($user->validate() && empty($user->errors)){
              // $this->manager->save($user);
               Application::$app->session->setFlashMessage('success', "Your account has been registered");
               Application::$app->response->redirect('/');
            }


            return $this->render('register',['user' => $user ]);
        }

        $this->setLayout('auth');
        return $this->render('register',[ 'user' => $user ]);

    }





    public function login(){

        $this->setLayout('auth');
        return $this->render('login');
    }



    public function resetPasswd(){}



}