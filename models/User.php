<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use app\managers\UserManager;

class User extends Model{


    public const STATE = [
        'INACTIVE' => 0,
        'ACTIVE' => 1,
        'DELETED' => 2,
    ];

    public UserManager $userManager;

    public string $id = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public int $status = self::STATE['INACTIVE'];
    public string $confirm_password = '';



    public function __construct()
    {
        $this->userManager = new UserManager();
    }


    /**
     *  Implement abstract meth. to 
     *  Define all rules we need for this model
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => (new UserManager()) ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '6'], [self::RULE_MAX, 'max' => '24']],
            'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'  =>'password']],
        ];
    }



    public function displayName(): string
    {
        return ucfirst($this->firstname .' '.$this->lastname);
    }







    /**
     * We need to access and find user from
     * App constructor to initialize session
     * or get user stored into session
     * @param $params
     */
    public static function getUser($params)
    {
        $userManager = new UserManager(); //  need refacto this
        return $userManager->findOne($params, self::class);
    }

    
}