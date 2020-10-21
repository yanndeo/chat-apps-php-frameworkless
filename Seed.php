<?php

namespace app;
use app\core\Database;
use app\core\Helper;
use app\models\User;

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
                profile VARCHAR(255), 
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
            [ 'firstname'=> 'luna', 'lastname' => 'sisi', 'email' => 'luna@yahoo.fr', 'password' => 'secret', 'status' => 0, 'profile' => 'user_1'],
            [ 'firstname'=> 'murielle', 'lastname' => 'barnabe','email' => 'murielle@gmail.com','password' => 'secret','status' =>  0, 'profile' => 'user_2' ],
            [ 'firstname'=> 'hussein', 'lastname' => 'mustapha','email' => 'hussein@gmail.com', 'password' => 'secret', 'status' => 0, 'profile' => 'user_3' ],
            ['firstname'=> 'Hanane', 'lastname' => 'Tazi','email' => 'hanane@gmail.fr', 'password' => 'secret', 'status' => 0, 'profile' => 'user_4'],

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
        
        $tableName = 'users';
        $attributes = ['firstname', 'lastname', 'email', 'password', 'status', 'profile'];

        $params = array_map(fn($attr) => ":$attr", $attributes);  //Ex : [ ':firstname', ':email']

        $sql = "INSERT INTO $tableName (".implode(',', $attributes).") VALUES(".implode(',', $params).")";

        $req = self::$db->prepare($sql);
        

        //if tables users exist and there are not users into this table
        if(!self::checkTableExist('users') && self::countUsers() === 0  ){
            $i = 1;
            foreach (self::users() as $data  ){
                
                foreach ($attributes as $attribute) {
                  
                    $req->bindValue(":$attribute", $data[$attribute]);
                }
                //Helper::dump($req);die;

                $req->execute();


                //self::$db->exec($statement);
                echo "- User{$i} is created successfully <br>";
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

    public static function countUsers()
    {
        $dbName = self::$db->getDbName(); 
        $sql = "SELECT * FROM users";

        $req = self::$db->query($sql, User::class);

        //Helper::dump($req);die;

        return count($req);


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








    public function loadSeed()
    {
        
        //1- Create database
          //self::creatingDatabase() ; we need create database manually
        //2- create tables
          self::creatingTables();
        //3- insert faker data
          self::fakerUsers();
    }
}