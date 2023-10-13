<?php

class database{
    public $hostname;
    public $username;
    public $password;
    public $database;
    public $connection;
    public $query;
    public $result;

    public function __construct($hostname,$username,$password,$database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        mysqli_report(FALSE);
        $this->connection = mysqli_connect($this->hostname,$this->username,$this->password,$this->database);
        if(!$this->connection){
            die("Connection Failed");
        }
    }

    public function query_exec($query){
        $this->query  = $query;
        $this->result =  mysqli_query($this->connection,$this->query);
    
        return $this->result;
    }
}

?>