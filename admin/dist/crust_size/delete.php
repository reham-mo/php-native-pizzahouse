<?php 

require '../helpers/dbConnection.php';

$id = $_GET['id'];

$sql = "delete from crust_size where id = $id"; 
$op = mysqli_query($con,$sql);

if($op){
    $message = ["Raw Removed"];
}else{
    $message = ["Error Try Again"];
}

   $_SESSION['Message'] = $message;

   header("location: index.php"); 


?>