<?php


require_once 'Initialization.php';


class DBConnection
{

    private PDO $pdoConn;


    public function __construct()
    {
        
        Initialization::TryLoadEnv();
        
        
        $host = getenv("DB_HOST");
        $dbName = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $password = getenv("DB_PASSWORD");
        
        
        $string = "mysql:host=$host;dbname=$dbName";
        
        
        $this->pdoConn = new PDO($string, $user, $password);

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
    
    
    public function Check(): array
    {

        $host = getenv("DB_HOST");
        $db = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $pass = getenv("DB_PASSWORD");
        
        return array($host, $db, $user, $pass);
    }
}