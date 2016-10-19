<?php 
session_start();
class Gateway {
    public $dbh;
    private static $instance;
    
    private function __construct() {
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/models/db.ini');
        $connString = 'mysql:'.'host='.$config['host'].';'.'dbname='.$config['db_name'];
        $user = $config['user'];
        $password = $config['pass'];
        
        try {
            $this->dbh = new PDO($connString, $user, $password);    
        } catch (PDOException $e) {
            //throw new Exception("There was an error connecting to the database. Please check back later.");
            echo 'Errror connecting to database';
            echo $e->getMessage();
        }
    }
    
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $obj = __CLASS__;
            // Instantiate an instance of this class, if not already set
            self::$instance = new $obj;
        }
        // return instance of self if instance already set
        return self::$instance;
    }
}
?>