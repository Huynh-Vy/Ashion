<?php

class DB
{
    public $conn;

    public function __construct()
    {
        #Load thông tin config
        global $config;

        #Kết nối Data
        $this->conn = new mysqli(
            $config['servername'], 
            $config['username'], 
            $config['password'], 
            $config['database']
        );
        
        #Định dạng chữ UTF8
        $this->conn->set_charset('utf8');
    }

    public function query($sql = '')
    {
        return $this->conn->query($sql);
    }

    public function fetch($sql = '')
    {
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    public function fetchArray($sql = '')
    {
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            return $data;
        }
        
        return false;
    }

    public function numRowDB($sql = '')
    {
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            return intval($result->num_rows);
        }
        return 0;
    }

    public function getLastId()
    {
        return $this->conn->insert_id;
    }

    public function insertAllDB($data = [], $table = '')
    {
        $sqlKey = $sqlValue ='';

        foreach ($data as $key => $value) {
            $sqlKey .= $key . ', ';
            $sqlValue .= "'$value'" . ', ';
        }

        $sqlKey = substr(trim($sqlKey), 0, -1);
        $sqlValue = substr(trim($sqlValue), 0, -1);

        return $this->query("insert into " . $table . " (" . $sqlKey . ") values (" . $sqlValue . ") ");
    }

    public function updateAllDB($data = [], $table = '', $id = 0)
    {
        $sqlUpdate = '';
        foreach ($data as $key => $value) {
            $sqlUpdate .= " ".$key." = '" .$value. "', ";
        }
        $sqlUpdate = substr(trim($sqlUpdate), 0, -1);

        $sql = "UPDATE " . $table . " set " . $sqlUpdate . " where id = " .$id. " ";

        return $this->query($sql);
    }
}