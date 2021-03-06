<?php

require_once dirname(__FILE__)."/Database.php";

class BaseDao
{
    protected $connection;
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
        /* Get an object instance of the database */
        $database_object = Database::getInstance();
        /* Get a connection from the database object */
        $this->connection = $database_object->getConnection();

    }

    protected function query($query, $parameter)
    {
      $stmt = $this->connection->prepare($query);
      $stmt->execute($parameter);
      return $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function queryUnique($query, $parameter) //one result or nothing
    {
        $results = $this->query($query, $parameter);
        return reset($results);
    }

    protected function executeUpdate($tableName, $id, $table)
    {
        $query = "UPDATE ".$tableName." SET ";
        foreach($table as $name => $value){
          $query .= $name. "=:".$name.", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $table['id'] = $id;
        $stmt->execute($table);
        $table['id'] = $this->connection->lastInsertId();
        return $table;
    }

    protected function insert($tableName, $table)
    {
        $query = "INSERT INTO ".$tableName." (";
        $values =" VALUES (";
        foreach ($table as $key => $value) {
            $query .= $key.", ";
            $values .= ":".$key.", ";
        }
        $query = substr($query, 0, -2);
        $values = substr($values, 0, -2);
        $query .=")".$values.")";

        $stmt = $this->connection->prepare($query);
        $stmt->execute($table);
    }

    protected function getAll($tableName)
    {
        $query = "SELECT * FROM ".$tableName;
        return $this->query($query, []);
    }

    protected function getAllPaginated($tableName, $offset = 0, $limit = 25){
        $query = "SELECT * FROM ".$tableName." LIMIT ".$limit." OFFSET ".$offset;
        return $this->query($query, []);
    }

    public function update($id, $entity){
      $this->executeUpdate($this->table, $id, $entity);
    }

    public function getById($id){
        return $this->queryUnique("SELECT * FROM ".$this->table." WHERE id = :id", ["id" => $id]);
    }

    public function add($entity){
        return $this->insert($this->table, $entity);
    }
}
