<?php


namespace app\models;


use app\managers\MessageManager;

class Message extends \app\core\Model
{

    public string $id = '';
    public string $content = '';



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