<?php


require '../helpers/dbConnection.php';
require '../helpers/functions.php';

//get id
$id = $_GET['id'];

//select image so i can delete in my folder
$sql  = "select image from extras where id = '$id'";
$op   = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op); // only one data returned


//create delete query
$sql = "delete from extras where id = '$id'";
$op = mysqli_query($con, $sql);



if($op){

    unlink('images/'.$data['image']);
     $Message =  ['one task deleted!'];

  }else{

     $Message = ['Error Try Again'];
  }
 
 
   $_SESSION['Message'] = $Message;
 
 
    header("location: index.php");
