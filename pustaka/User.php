<?php
require_once('Koneksi.php');
  
class User extends Koneksi{
  
    public function __construct(){
  
        parent::__construct();
    }
  
    public function check_login($username, $password){
  
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = $this->conn->query($sql);
  
        if($query->num_rows > 0){
            $row = $query->fetch_array();
            if(password_verify($password, $row['password'])){
                return $row['id'];
            }else {
                return false;
            }       
        }
        else{
            return false;
        }
    }
  
    public function details($sql){
  
        $query = $this->conn->query($sql);
  
        $row = $query->fetch_array();
  
        return $row;       
    }
  
    public function escape_string($value){
  
        return $this->conn->real_escape_string($value);
    }
}