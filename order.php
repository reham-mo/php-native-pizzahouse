<?php

require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';
require './layouts/thenavbar.php';


$date = time();


$sql = "select * from pizza where id =".$_POST['pizzaID'];
$op = mysqli_query($con, $sql);
$pizaa_price = 0;
foreach($op as $o){
    $pizaa_price = $o["price"];
}

$sql = "select * from crust where id =".$_POST['crustID'];
$op2 = mysqli_query($con, $sql);
$crust_price = 0;
foreach($op2 as $o2){
    $crust_price = $o2["price"];
}

$sql = "select * from extras where id =".$_POST['extraID'];
$op3 = mysqli_query($con, $sql);
$extra_price = 0;
foreach($op3 as $o3){
    $extra_price = $o3["price"];
}
$total = $crust_price + $pizaa_price + $extra_price;



$sql = "insert into orders (`user_id`, `pizza_id`, `crust_id`, `extra_id`, `price`, `date`) values ({$_SESSION['User']['id']},'{$_POST["pizzaID"]}', '{$_POST["crustID"]}', '{$_POST["extraID"]}', $total, $date)";
        $op = mysqli_query($con, $sql);

        if ($op) {

        
            header("location: thanku.php");
            $message = ["Thank you for ordering from PizzaHouse"];
            $_SESSION['Message'] =  $message;
  
        } else {

            $message = ["Error Try Again"];
            $_SESSION['Message'] =  $message;
        }
