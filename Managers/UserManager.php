<?php
namespace app\managers;

use app\core\Application;
use app\core\Helper;
use app\core\Manager;
use app\core\Model;
use app\models\User;

class UserManager extends Manager{

    public static string $table = "users";

    //why not use UserManager or Manager like singleton ???

    public function save($user)
    {
        if($user instanceof User){
            $user->status = User::STATE['INACTIVE'];
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
        return parent::save($user);

    }


    public function login($model)
    {
        $params = ['email'=> $model->email ];
        $user = $this->findOne($params, User::class) ;

        if(!$user){
            $model->addError('email', 'User does not exist with this email');
            return false;
        }

        if(!password_verify($model->password, $user->password)){
            $model->addError('password', 'Password is incorrect');
            return false;
        }
       // Helper::dump($user);die;

        return Application::$app->login($user);


    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['id','firstname', 'lastname', 'email', 'password', 'status'];
    }





}