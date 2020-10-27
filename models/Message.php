<?php


namespace app\models;


use app\core\Helper;
use app\models\User;
use app\managers\UserManager;
use app\managers\MessageManager;

class Message extends \app\core\Model
{

    public string $id = '';
    public string $content = '';
    public string $user_from ='';
    public string $user_to ='';
    public string $created_at = '';


    /**
     * @param int $id
     * @return \app\models\User
     */
    public function getUser(int $id):User
    {
        $userManager = new UserManager();
        return $userManager->findOne(['id'=> $id], User::class);
    }

    public function getReceiver():User
    {
        $userManager = new UserManager();
        $user = $userManager->findOne(['id'=> $this->user_to], User::class);
        return $user;
    }

    public function getSender(): User
    {
        $userManager = new UserManager();
        $user = $userManager->findOne(['id' => $this->user_from], User::class);
        return $user;
    }


    public function formattedDate()
    {
        //init date now
        //compare
        //if created_at > date
            //-> show d-m-y
        //if created < date
            //-> show
        $createdAt = $this->created_at;
        $date = (new \DateTime())->format('Y-m-d h:i:s');
        return $date;
    }


    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED],
        ];
    }
}