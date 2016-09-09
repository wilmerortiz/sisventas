<?php

/**
* 
*/
class Conexion extends PDO
{
    private $dbname ="sisventas";
    private $host   ="localhost";
    private $user   ="postgres";
    private $pass   ="123";
    private $port   ="5432";
    private $dbh ;
    public function __construct()
    {
        try{
            echo $this->dbh = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function close_con(){
        $this->dbh = null;
    }
}
