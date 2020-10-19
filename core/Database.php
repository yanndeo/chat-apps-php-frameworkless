<?php
namespace app\core;

use PDO;

class Database {

    private static $instance = null;

    private string $db_user = '';

    private string $db_password = '';

    private string $db_host = '';

    private string $db_name = '';





    public function __construct(array $config)
    {
        $this->db_host = $config['HOST'];
        $this->db_name = $config['DB_NAME'];
        $this->db_user = $config['DB_USER'];
        $this->db_password = $config['DB_PASSWORD'];

    }


    private function getPDO(): PDO
    {
        $pdo = '';

        if(self::$instance === null){

            $dsn = "mysql:dbname={$this->db_name};host={$this->db_host}";

            $pdo = new PDO($dsn, $this->db_user, $this->db_password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$instance = $pdo;
            //Helper::dump(self::$instance);
        }

        return self::$instance ;
    }


    /**
     * we need access
     * from seed class
     * @return mixed|string
     */
    public function getDbName()
    {
        return $this->db_name;
    }



    /**
     * Undocumented function
     * @param [type] $statement
     * @param [type] $className
     */
    public function query($statement, $className)
    {
        $req = $this->getPDO()->query($statement);
        $data = $req->fetchAll(PDO::FETCH_CLASS, $className);
        return $data;

    }




    /**
     * Undocumented function
     * @param [type] $statement

     */
    public function prepare($statement)
    {
        return $this->getPDO()->prepare($statement);

    }


    public function exec($statement)
    {
         return $this->getPDO()->exec($statement);
    }


    /**
     * prepare req without classname our object
     * @param $statement
     * @param $attributes
     * @return mixed
     */
    public function prepareWithoutClass($statement, $attributes)
    {
        //var_dump($statement);die;
        $req = $this->getPDO()->prepare($statement);
        foreach ($attributes as $key => $value ){
            $req->bindValue(":$key", $value, PDO::PARAM_STR);
        }
        $req->execute();
        $data = $req->fetch();
        $req->closeCursor();

        return $data;
    }






    
}