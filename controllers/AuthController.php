<?php 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;
use app\managers\UserManager;

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
                $this->manager->save($user);
                $this->addFlashMessage('SUCCESS', "Your account has been registered.");
                $this->redirectTo('/');
            }

            return $this->render('register',['model' => $user ]);
        }

        return $this->render('register',[ 'model' => $user ]);

    }





    public function login(Request $request)
    {
        $loginForm = new LoginForm();

        if($request->isPost()){

            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $this->manager->login($loginForm)){
               return $this->redirectTo('/chat');

            }
        }
      //  $this->setLayout('auth');
        return $this->render('login', ['model'=> $loginForm]);
    }


    public function logout()
    {
        Application::$app->logout();
        $this->addFlashMessage('SUCCESS', "You have has been disconnected.");
        return $this->redirectTo('/login');

    }

    public function resetPasswd(){}



}