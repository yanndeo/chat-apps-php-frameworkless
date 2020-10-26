<?php
namespace app\core;

use PDO;
use app\core\Application;

abstract class Manager{


    public Database $db;

    protected static string $table ;


    //define constructor in abstract class 
    //to be using by the subs-classes
    public function __construct()
    {
        $this->db =  Application::$app->database;
    }


    /**
     * we need all attributes using into table database
     * @return array
     */
    abstract public function attributes(): array;


    /**
     * @param Model $model
     * @return bool
     */
    protected function save(Model $model)
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

    
    /**
     * Undocumented function
     * @param Model $className
     * @param string|null $order
     */
    public function findAll(Model $className, ?string $order)
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        
        if(!is_null($order)){
            $sql .= "ORDER BY". $order;
        }

        return $this->db->query($sql, $className); 
    }


    public function find(int $id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        $attr = [$id];
        $className = get_class($this);
        Helper::dump($className);
        
        $query = $this->db->prepare($sql ,$attr, $className );
        $data = $query->fetchAll(PDO::FETCH_CLASS, $className);

        return $data;

    }


    public function findOne($where, $className)
    {
        $tableName = $this->getTableName();

        $attributes = array_keys($where);

        $params = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $sql = "SELECT * FROM $tableName WHERE $params";

        $req = $this->db->prepare($sql);

        foreach ($where as $key => $item){
            $req->bindValue(":$key", $item);
        }
        $req->execute();
        return $req->fetchObject($className);

    }


    /**
     * @param int $id
     */
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $attr = [$id];
        $className = get_class($this);
        $query = $this->db->prepare($sql, $attr, $className );

       // $query->execute(['id' => $id]);
    }


    protected function getTableName(): string
    {
        return static::$table;
    }




}