<?php
namespace app\managers;

use app\core\Helper;
use app\core\Manager;
use app\models\Message;

class MessageManager extends Manager
{

    public static string $table = "messages";



    public function save($message)
    {
        return parent::save($message);

    }



    public function getMessages(int $user_id)
    {
        $user_auth = Helper::auth()->id;
        $className = Message::class;
        $sql = "SELECT * FROM {$this->getTableName()} 
                WHERE user_to = {$user_id} AND user_from = {$user_auth}
                OR user_to = {$user_auth} AND user_from = {$user_id}
                ORDER BY 'ASC' ";
        //Helper::dump($sql);die;
                
        return $this->db->query($sql, $className);
    }


    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['id','content', 'user_from', 'user_to', 'created_at'];
    }
}