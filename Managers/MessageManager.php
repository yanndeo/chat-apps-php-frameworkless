<?php
namespace app\managers;

use app\core\Manager;
use app\Helper;
use app\models\Message;

class MessageManager extends Manager
{

    public static string $table = "messages";



    public function create(array $data)
    {
        $message = new Message();

        $message->content = $data['contentMsgElt'];
        $message->user_from = $data['user_auth_id'];
        $message->user_to = $data['user_with_id'];
        $message->created_at = (new \DateTime())->format('Y-m-d H:i:s');
        
       // Helper::dump($message);
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