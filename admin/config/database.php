<?php
require "constant.php";

// connect to the database;
$dbconnect =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_error($dbconnect)){
    die(mysqli_error($dbconnect));
}
?>