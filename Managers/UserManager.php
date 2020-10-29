<?php
namespace app\managers;

use app\core\Application;
use app\core\Manager;
use app\core\Model;
use app\Helper;
use app\models\User;

class UserManager extends Manager {


    public static string $table = "users";

    //why not use UserManager or Manager like singleton ???

    public function save($user)
    {
        if($user instanceof User){
            $user->status = User::STATE['INACTIVE'];
            $user->profile = Helper::getProfile();
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
        return parent::save($user);

    }


    /**
     * Undocumented function
     *
     * @param User $user
     * @param string $attribute
     * @param string $where
     * @return void
     */
    public function update(User $user,string $attribute, $where = 'id' )
    {
        $value = $user->{$attribute};
        $whereValue = $user->{$where};

        $sql = "UPDATE {$this->getTableName()} SET $attribute= $value WHERE $where= $whereValue";

        // Prepare statement
        $req = $this->db->prepare($sql);

        // execute the query
        $req->execute();

        return $req->rowCount() ;
    }



    public function findAllOnline()
    {
        $className = User::class;
        $sql = "SELECT * FROM {$this->getTableName()} WHERE status = '1' ORDER BY 'DESC'";

        return $this->db->query($sql, $className);
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
       //Helper::dump($user);die;
         $user->status = User::STATE['ACTIVE'];
         $this->update($user, 'status');

        return Application::$app->login($user);

    }


    
    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['id','firstname', 'lastname', 'email', 'password', 'status', 'profile'];
    }



}