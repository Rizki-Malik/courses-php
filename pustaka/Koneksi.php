<?php
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'my_web');


class Koneksi
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB = 'my_web';

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
        return $this->conn;
    }
}
//$koneksi = new Koneksi();
