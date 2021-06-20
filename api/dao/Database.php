<?php

require_once dirname(__FILE__)."/../config.php";

class Database
{
    private $host = Config::DB_HOST;
    private $db = Config::DB_SCHEME;
    private $user = Config::DB_USERNAME;
    private $pass = Config::DB_PASSWORD;
    private $charset = NULL;
    private $opt = NULL;
    private $dsn = NULL;
    private $connection = NULL;
    private static $database = NULL;

    /* Private construct that can only be accessed from within this class */
    private function __construct(){
        $this->createConnection();
    }

    /* A private method handling setting up params and creating a connection */
    private function createConnection():void {
        $this->charset = "utf8mb4";
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->connection = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    /* A static method that will create an object instance once and after that it will reuse the same instance for all other requests */
    static function getInstance():Database {
        if (NULL == self::$database) {
            self::$database = new Database();
        }
        return self::$database;
    }

    /* A little getter function to access the connection object */
    public function getConnection(): PDO {
        return $this->connection;
    }
}
