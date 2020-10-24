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



    public function getAll(int $from, int $to)
    {
        $className = Message::class;
        $sql = "SELECT * FROM {$this->getTableName()} WHERE user_from = {$from} AND  user_to = {$to} ORDER BY 'DESC' ";
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