<?php

namespace app;

use app\core\Database;
use app\core\Helper;
use app\models\Message;
use app\models\User;
use \DateTime;

class Seed
{

    public static Database $db;

    private const TABLES = ['users', 'messages'];

    public const MESSAGE_ATTR = ['user_from', 'user_to', 'content', 'created_at'];

    public const USER_ATTR = ['firstname', 'lastname', 'email', 'password', 'status', 'profile'];


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
                created_at DATETIME NOT NULL )",
        ];
    }


    /**
     * static
     * Account users 
     */
    private static function users()
    {
        return [
            ['firstname' => 'luna', 'lastname' => 'sisi', 'email' => 'luna@yahoo.fr', 'password' => 'secret', 'status' => 0, 'profile' => 'user_1'],
            ['firstname' => 'murielle', 'lastname' => 'barnabe', 'email' => 'murielle@gmail.com', 'password' => 'secret', 'status' =>  0, 'profile' => 'user_2'],
            ['firstname' => 'hussein', 'lastname' => 'mustapha', 'email' => 'hussein@gmail.com', 'password' => 'secret', 'status' => 0, 'profile' => 'user_3'],
            ['firstname' => 'Hanane', 'lastname' => 'Tazi', 'email' => 'hanane@gmail.fr', 'password' => 'secret', 'status' => 0, 'profile' => 'user_6'],
        ];
    }


    /**
     * script Sql 
     * creating 2 tables
     * users and messages
     * @return void
     */
    private static function creatingTables()
    {
        // Helper::dump(!self::checkTableExist('users'));
        $i = 1;
        foreach (self::tableSQL() as $tableName => $statement) {
            if (!self::checkTableExist($tableName) === false) {
                self::$db->exec($statement);
                echo "{$i}- Table '{$tableName}' created successfully <br>";
                $i++;
            }
        }
    }

    /**
     * Script Sql 
     * populate users account 
     * into users's table
     * @return void
     */
    private static function fakerUsers()
    {

        $tableName = self::TABLES[0];
        $attributes = self::USER_ATTR;

        $params = array_map(fn ($attr) => ":$attr", $attributes);  //Ex : [ ':firstname', ':email']

        $sql = "INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")";

        $req = self::$db->prepare($sql);

        //if tables users exist and there are not users into this table
        if (!self::checkTableExist('users') && count(self::getAllUsers()) === 0) {
            $i = 1;

            echo "---------------USER ACCOUNT--------------- <br>";

            foreach (self::users() as $data) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                foreach ($attributes as $attribute) {
                    $req->bindValue(":$attribute", $data[$attribute]);
                }
                //Helper::dump($req);die;

                $req->execute();

                //self::$db->exec($statement);
                echo "- User{$i} is created successfully <br>";
                $i++;
            }
        }
    }



    private static function fakeMessages($nb_msg)
    {
        $tableName = self::TABLES[1];
        //Helper::dump($tableName);die;
        $attributes = self::MESSAGE_ATTR;
        $users = self::getAllUsers();
        $textBrut = "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains";


        /*  $users_id = array_map(function($users){
                return $users->id;
        }, $users); */


        $params = array_map(fn ($attr) => ":$attr", $attributes);  //Ex : [ ':firstname', ':email']
        $sql = "INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")";
        $req = self::$db->prepare($sql);

        $data = [];

        if (!self::checkTableExist($tableName) && count(self::getAllUsers()) > 0 && count(self::getAllMessages()) === 0 ) {

            $users_id = array_map(fn ($users) => $users->id, $users);

            for ($i = 0; $i <= $nb_msg; $i++) {

                $data['user_from'] = $users[rand(0, count($users_id) - 1)]->id; //$users['indice']->property 
                $data['user_to'] = $users[rand(0, count($users_id) - 1)]->id;
                $data['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
                $data['content'] = substr($textBrut, rand(0, strlen($textBrut)), rand(0, strlen($textBrut))); // content variable

                if ($data['user_from'] !== $data['user_to']) {

                    foreach ($attributes as $attribute) {

                        $req->bindValue(":$attribute", $data[$attribute]);
                    }
                    $req->execute();

                }
            }
            echo "---------------MESSAGE--------------- <br>";

            echo "- Messages table is populated successfully <br>";

        }
    }





    /**
     * Check if table exist 
     * already or not
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








    public static function getAllUsers()
    {
        $tableName = self::TABLES[0];
        $sql = "SELECT * FROM {$tableName}";

        $users = self::$db->query($sql, User::class);

        return $users;
    }

    public static function getAllMessages()
    {
        $tableName = self::TABLES[1];
        $sql = "SELECT * FROM {$tableName}";

        $messages = self::$db->query($sql, Message::class);

        return $messages;
    }





    

    private static function creatingDatabase()
    {
        try {
            $dbName = self::$db->getDbName();
            $sql = "CREATE DATABASE IF NOT EXISTS {$dbName} DEFAULT CHARACTER SET utf8";
            $data = self::$db->exec($sql);
            echo 'Database created successfully<br>';

            return;
        } catch (\PDOException $exception) {
            echo $sql . "<br>" . $exception->getMessage();
        }
    }








    public function loadSeed()
    {

        //1- Create database
        //self::creatingDatabase() ; //we need create database manually
        //2- create tables
        self::creatingTables();
        //3- insert faker data
        self::fakerUsers();
        //4- Insert faker conversation message
        self::fakeMessages(50);
    }
}
