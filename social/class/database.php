<?php
class Database
{

    public $DB_HOST = "localhost";
    public $DB_USER = "root";
    public $DB_PASS = "";
    public $DB_DATABASE = "winks";

    public function connect()
    {

        $db = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_DATABASE);

        return $db;
    }



}


?>