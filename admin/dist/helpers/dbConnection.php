<?php

session_start();

$server = 'localhost';
$dbname = 'pizzahouse1';
$dbUser = 'root';
$dbPassword = '';

$con = mysqli_connect($server, $dbUser, $dbPassword, $dbname);

if(!$con){
    die("error : " . mysqli_connect_error());
}


?>