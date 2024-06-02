<?php
require_once('Koneksi.php');

class Crud extends Koneksi {

    function __construct(){
        parent::__construct();
    }

    function read($table, $where = null) {
        $sql = "SELECT * FROM $table";
        if ($where != null) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = '$value'";
            }
            $sql .= implode(' AND ', $conditions);
        }
        $result = $this->conn->query($sql);
        if (!$result) {
            return "Terjadi kesalahan pada query!";
        }
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    function update($table, $data, $where) {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "$key = '$value'";
        }
        $conditions = [];
        foreach ($where as $key => $value) {
            $conditions[] = "$key = '$value'";
        }
        $sql = "UPDATE $table SET " . implode(", ", $sets) . " WHERE " . implode(' AND ', $conditions);
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    function delete($table, $where) {
        $conditions = [];
        foreach ($where as $key => $value) {
            $conditions[] = "$key = '$value'";
        }
        $sql = "DELETE FROM $table WHERE " . implode(' AND ', $conditions);
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }
}
?>