<?php

session_start();

$server = 'localhost';
$dbname = 'x';
$dbUser = 'root';
$dbPassword = '';

$con = mysqli_connect($server, $dbUser, $dbPassword, $dbname);

if(!$con){
    die("error : " . mysqli_connect_error());
}


?>