<?php
require 'db_config.php';

class DB{
    public $conn;
    public $error;
    public function __construct() {
        $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
        if(!$this->conn)
            $this->error = mysqli_error ();
    }
    
    public function __destruct() {
        mysqli_close($this->conn);
    }
}