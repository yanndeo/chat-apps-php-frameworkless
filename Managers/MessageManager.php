<?php
namespace app\managers;


use app\core\Manager;

class MessageManager extends Manager
{

    public static string $table = "messages";





    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['id','content', 'user_from', 'user_to', 'created_at'];
    }
}