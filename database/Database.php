<div></div>
<?php
include_once __DIR__ . "/../config/config.php";

class Database {
    public $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            try {
                $conn = new PDO("mysql:host=" . HOST, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec("CREATE DATABASE IF NOT EXISTS " . DBNAME);
                $conn->exec("USE " . DBNAME);
                $conn->exec(SQL_DATABASE);
                
                
                $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
}

class connect extends Database {
    protected $connect;
    public function __construct() {
        $this->connect=(new Database)->db;
        return $this->connect;
    }
}
new connect();
?>