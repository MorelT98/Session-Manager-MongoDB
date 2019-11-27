<?php
    require_once '../../../../../opt/composer/vendor/autoload.php';
    class DBConnection{
        const HOST = 'localhost';
        const PORT = 27017;
        const DBNAME = 'myblogsite';
        private static $instance;
        public $connection;
        public $database;

        private function __construct(){
            $connectionString = sprintf('mongodb://%s:%d',
            DBConnection::HOST,
            DBConnection::PORT);
            $this->conn = new MongoDB\Client($connectionString);
            $this->database = $this->conn->selectDatabase(DBConnection::DBNAME);
        }

        public static function instantiate(){
            if(!isset(self::$instance)){
                $class = __CLASS__;
                self::$instance = new $class;
            }
            return self::$instance;
        }

        public function getCollection($name){
            return $this->database->selectCollection($name);
        }
    }

$conn = DBConnection::instantiate();