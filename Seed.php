<?php

namespace app;
use app\core\Database;
use app\core\Helper;

class Seed
{

    public static Database $db;


    public function __construct(Database $db)
    {
        self::$db = $db;
    }


    private static function tableSQL()
    {
        return [
            'users' => "CREATE TABLE users (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                email VARCHAR(255),
                password VARCHAR(255) NOT NULL,
                status TINYINT NOT NULL)",

            'messages' => "CREATE TABLE messages ( 
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_from INT NOT NULL,
                user_to INT NOT NULL,
                content LONGTEXT NOT NULL,
                created_at DATE )",
        ];

    }


    private static function users()
    {
        return [
            'user1' => [
                'firstname' => 'lune',
                'lastname'=> 'samba',
                'email' => 'lune@yahoo.fr',
                'password' => 'secret',
                'status' => 0,
             ],
            'user2' => [
                'firstname' => 'murielle',
                'lastname'=> 'barnabe',
                'email' => 'murielle@gmail.com',
                'password' => 'secret',
                'status' => 0,
            ],
            'user3' => [
                'firstname' => 'hussein',
                'lastname'=> 'mustapha',
                'email' => 'hussein@gmail.com',
                'password' => 'secret',
                'status' => 0,
            ],
            'user4' => [
                'firstname' => 'Hanane',
                'lastname'=> 'Tazi',
                'email' => 'hanane@gmail.fr',
                'password' => 'secret',
                'status' => 0,
            ],

        ];

    }



    private static function creatingTables()
    {
      // Helper::dump(!self::checkTableExist('users'));
        $i = 1;
        foreach (self::tableSQL() as $tableName => $statement ){
            if(!self::checkTableExist($tableName) === false){
                self::$db->exec($statement);
                echo "{$i}- Table '{$tableName}' created successfully <br>";
                $i++ ;
            }
        }

    }

    private static function fakerUsers()
    {
        // Helper::dump(!self::checkTableExist('users'));
        $i = 1;
        if(!self::checkTableExist('users') !== false){

            foreach (self::users() as $user => $data ){
                foreach ($data as $key => $value){

                }
                //self::$db->exec($statement);
                echo "{$i}- Table '{$user}' created successfully <br>";
                $i++ ;
            }
        }

    }





    /**
     * Check if table exist already or not
     * @param string $tableName
     * @return bool
     */
    private static function checkTableExist(string $tableName): bool
    {
        $dbName = self::$db->getDbName(); //get database name

        $sql = "SELECT table_name FROM information_schema.tables
                WHERE table_schema = :dbName
                AND table_name = :tableName ";

        $data = self::$db->prepareWithoutClass($sql, compact('dbName', 'tableName'));

        return empty($data);
    }


    private static function creatingDatabase()
    {
        try {
            $dbName = self::$db->getDbName();
            $sql = "CREATE DATABASE IF NOT EXISTS {$dbName} DEFAULT CHARACTER SET utf8";
            $data = self::$db->exec($sql);
            echo 'Database created successfully<br>';
        }catch (\PDOException $exception){
            echo $sql . "<br>" . $exception->getMessage();

        }
    }


    private function save()
    {
        $tableName = $this->getTableName();
        $attributes = $this->attributes();      //Ex : ['firstname', 'email']
        $params = array_map(fn($attr) => ":$attr", $attributes);  //Ex : [ ':firstname', ':email']

        $sql = "INSERT INTO $tableName (".implode(',', $attributes).") VALUES(".implode(',', $params).")";
        // Helper::dump($sql);
        $req = $this->db->prepare($sql);

        foreach ($attributes as $attribute){
            $req->bindValue(":$attribute", $model->{$attribute});
        }

        $req->execute();

        return true;

    }





    public function loadSeed()
    {
        //1- Create database
          //self::creatingDatabase() ; we need create database manually
        //2- create tables
          self::creatingTables();
        //3- insert faker data
    }
}