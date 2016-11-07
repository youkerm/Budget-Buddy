<?php
class Database {

    private static $host = 'localhost';
    private static $database = 'budgetdash';
    private static $user = 'test';
    private static $pass = 'test';
    private static $db;

    public function __construct() {
        try {
            self::$db = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$database, self::$user, self::$pass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public function getConn() {
        return self::$db;
    }
    
}
?>