<?php
include "dbFunctions.php";
include "classes.php";


$db = new MySql();

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
