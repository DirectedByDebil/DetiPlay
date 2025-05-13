<?php

class DBConnection
{
    private string $servername = "localhost", $username = "root",
        $password = "windowsActivation0110";

    private PDO $pdoConn;


    public function __construct($dbname)
    {
        $string = "mysql:host=$this->servername;dbname=$dbname";
        
        $this->pdoConn = new PDO($string, $this->username, $this->password);

        if($this->pdoConn->errorCode() != null)
        {
            echo "We have some errors(";
            exit();
        }
    }
    
    public function ExecuteSQL($sql) : PDOStatement
    {
        return $this->pdoConn->query($sql);
    }
    
    public function Prepare($query) : PDOStatement|false
    {
        
        return $this->pdoConn->prepare($query);
    }
    
}