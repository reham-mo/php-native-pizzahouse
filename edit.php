<?php

require './admin/dist/helpers/dbConnection.php';
require './checkLogin.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';

$id = $_SESSION['User']['id'];

$sql = "select users.*, customerdetails.address, customerdetails.phone, customerdetails.user_id 
from users join customerdetails on users.id = customerdetails.user_id where users.id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name          = clean($_POST['name']);
    $username      = clean($_POST['username']);
    $email         = Clean($_POST['email']);
    $address       = clean($_POST['address']);
    $phone         = $_POST['phone'];

  
    $errors = [];

    if (!validate($name, 1)) {
        $errors['name'] = " name required";
    }

    if (!validate($username,1)) {
        $errors['username'] = " username required";
    } 

    if (!validate($email, 1)) {
        $errors['email'] = " email required";
    } elseif (!validate($email, 4)) {
        $errors['email'] = " email invalid";
    }

    if (!validate($address, 1)) {
        $errors['address'] = " address required";
    }

    if (!validate($phone, 1)) {
        $errors['phone'] = " phone required";
    } elseif(!validate($phone, 7)) {
        $errors['phone'] = " phone invalid";
    }


 if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
    
        $sql = "update users set name = '$name', username = '$username', email = '$email' where id = $id";
        $op  =  mysqli_query($con, $sql);

        if ($op) {

            $sql = "select * from users where name = '$name' and username = '$username' and email = '$email'";
            $result  = mysqli_query($con,$sql); 

            $data = mysqli_fetch_assoc($result);

            $_SESSION['User'] = $data;

            $user_id = $_SESSION['User']['id'];

            
            $sql = "update customerdetails set address = '$address', phone =$phone where user_id = $user_id"; 
            $op  = mysqli_query($con, $sql);

            if($op){
                $message = ["Raw Inserted"];
                $_SESSION['Message'] = $message;
                header('location: profile.php');

            } else {
                $message = ["Error Try Again"];
                $_SESSION['Message'] = $message;
            }

               
            } else {
                echo 'Error Try Again ' . mysqli_error($con);
        }

     }      mysqli_close($con);
}



?>


<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>House</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>

                <?php if (isset($_SESSION['User']['id'])) { ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                <?php    } ?>
            </ul>
        </div>
    </div>
</nav>



<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2>Edit Profile</h2>
        </div>

        <?php displayMessage(); ?>

        <form action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post">


            <div class="form-group  pb-2">
            <label for="exampleInputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10 ">
                    <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $UserData['name']; ?>" placeholder="Enter Name">
                </div>
            </div>

            <div class="form-group  pb-2">
                <label for="exampleInputName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="exampleInputName" name="username" value="<?php echo $UserData['username']; ?>" placeholder="Enter Username">
                </div>
            </div>

            <div class="form-group  pb-2">
                <label for="exampleInputEmail" class="col-sm-2 col-form-label">Email address</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $UserData['email']; ?>" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-group pb-2">
               <label for="exampleInputAddress" class="col-sm-2 col-form-label"> Address </label>
               <div class="col-sm-10">
               <input type="text" class="form-control" id="exampleInputAddress"  name="address" value="<?php echo $UserData['address']; ?>" placeholder="Enter Address">
               </div>
           </div>

           <div class="form-group  pb-2">
               <label for="exampleInputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
               <div class="col-sm-10">
               <input type="text" class="form-control" id="exampleInputPhoneNumber" name="phone" value="<?php echo $UserData['phone']; ?>"placeholder="Enter Phone Number">
               </div>
           </div>

            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>



</div>