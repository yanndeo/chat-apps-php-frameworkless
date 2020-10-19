<?php


namespace app\models;


use app\managers\MessageManager;

class Message extends \app\core\Model
{

    public string $id = '';
    public string $content = '';
    public string $user_from ='';
    public string $user_to ='';
    public string $created_at = '';



    public function __construct()
    {
    }

    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED],
        ];
    }
}