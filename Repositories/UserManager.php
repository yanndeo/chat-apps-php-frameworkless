<?php
namespace app\repositories;

use app\core\Helper;
use app\core\Manager;
use app\core\Model;
use app\models\User;

class UserManager extends Manager{

    public static string $table = "users";


    public function save($user)
    {
        if($user instanceof User){
            $user->status = User::STATE['INACTIVE'];
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
        return parent::save($user);

    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }


}