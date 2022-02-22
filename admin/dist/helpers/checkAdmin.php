<?php 

   if($_SESSION['User']['role_id'] != 1){

    header("location: ".url('index.php'));
   
}



?>