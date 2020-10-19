<?php


namespace app\models;


use app\core\Application;
use app\core\Helper;
use app\core\Model;
use app\managers\UserManager;

class LoginForm extends Model
{

    public string $email = '';
    public string $password = '';





    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }










}