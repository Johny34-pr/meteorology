<?php
class db_config
{
    protected $serverName, $userName, $password, $dbName;

    public function __construct()
    {
        $this->serverName = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->dbName = "astrology";
    }
}
