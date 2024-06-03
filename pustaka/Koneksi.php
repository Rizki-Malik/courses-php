<?php
class Koneksi
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB = 'courses';

    protected $conn;

    function __construct()
    {
        if(!isset($this->conn)){
            $this->conn = new mysqli(self::HOST, self::USER,  self::PASS, self::DB);            
        }
 
        if(!$this->conn){
            echo 'Koneksi Gagal <br />';
            //echo "Failed to connect to MySQL: ". $this->conn->connect_error;
        }
        //else{
        //     echo 'Koneksi Berhasil';
        // }
        // return $this->conn; // Remove this line
    }

    // Getter method to access the connection object
    public function getConnection() {
        return $this->conn;
    }
}
