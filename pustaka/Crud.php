<?php
require_once('Koneksi.php');

class Crud extends Koneksi
{

    function __construct(){
        parent:: __construct();
    }

    function read($table, $where=null){

        $sql = ("SELECT * FROM $table ");
        if ($where != null) 
        {
            $sql .= "WHERE ";
            $row = null;
            if (count($where) == 1) {
                foreach ($where as $key => $value)
                {
                    $sql .= $key."='".$value."'";
                }
            }
            else
            {
                foreach ($where as $key => $value)
                {
                    $row .= $key."='".$value."' AND ";
                }
                $sql .= substr($row, 0, -4);
            }
        } 
        $hasil = $this->conn->query($sql);
        if(!$hasil){
            return "Terjadi kesalahan pada query!";
        }
        
        $rows = array();

        while($row = $hasil->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function create($table, $data){
        $sql = "INSERT INTO $table";
        $row = null;
        $value = null;

        foreach ($data as $key => $nilai) {
            $row .= ",".$key;
            $value .= ",'".$nilai."'";
        }
        $sql .= "(". substr($row, 1) .")";
        $sql .= " VALUES (". substr($value, 1) .")";

        $hasil = $this->conn->query($sql);

        if($hasil){
            return 'sukses';
        }else{
            return 'gagal';
        }
                
    }
    function update($table, $field, $where){

        $sql = "UPDATE $table SET ";
        $set = null;
        $setWhere = null;

        foreach ($field as $key => $value) {
            $set .= ", ". $key . " = '". $value ."'";
        }

        foreach ($where as $key => $value) {
            $setWhere = $key."='".$value."'";
        }

        $sql .= substr($set, 1). " WHERE $setWhere";

        $hasil = $this->conn->query($sql); 

        return $hasil ? true:false;
        
    }
    function delete($table, $where){
        $setWhere = null;
        foreach ($where as $key => $value)
        {
            $setWhere = $key."='".$value."'";
        }
        $sql = "DELETE FROM $table WHERE $setWhere";

        $hasil = $this->conn->query($sql); 
        return $hasil ? true:false;
    }

}
?>