<?php

require './layouts/header.php';
require './layouts/thenavbar.php';
require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name          = clean($_POST['name']);
    $username      = clean($_POST['username']);
    $password      = Clean($_POST['password'], 1);
    $email         = Clean($_POST['email']);
    $address       = clean($_POST['address']);
    $phone         = $_POST['phone'];


    $errors = [];

    # validate name 
    if (!validate($name, 1)) {
        $errors['name'] = " name required";
    }

    if (!validate($username,1)) {
        $errors['username'] = " username required";
    } 

    # Validate Email .... 
    if (!validate($email, 1)) {
        $errors['email'] = " email required";
    } elseif (!validate($email, 4)) {
        $errors['email'] = " email invalid";
    }

    # Validate Password 
    if (!validate($password, 1)) {
        $errors['password'] = " password required";
    } elseif (!validate($password, 5)) {
        $errors['password'] = " Password Length Must be >= 6 Chars";
    }


    # validate Address 
    if (!validate($address, 1)) {
        $errors['address'] = " address required";
    }

    # validate url 
    if (!validate($phone, 1)) {
        $errors['phone'] = " phone required";
    } elseif(!validate($phone, 7)) {
        $errors['phone'] = " phone invalid";
    }


    # Check 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        

        # Hash Password .... 
        $password = md5($password);


        $sql = "insert into users (name,username,email,password,role_id) values ('$name' , '$username', '$email' ,'$password',3)";
        $op  =  mysqli_query($con, $sql);

        if ($op) {

            $sql = "select * from users where name = '$name' and username = '$username' and email = '$email' and password = '$password' and role_id = 3";
            $result  = mysqli_query($con,$sql); 

            $data = mysqli_fetch_assoc($result);

            $_SESSION['User'] = $data;

            $user_id = $_SESSION['User']['id'];

            
            $sql = "insert into customerdetails (address, phone, user_id) values ('$address' , '$phone', $user_id)"; 
            $op  = mysqli_query($con, $sql);

            if($op){
                $message = ["Raw Inserted"];
                $_SESSION['Message'] = $message;
                header('location: index.php');

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


<!-- ////////////////////////////////////////////////////////////////////////////// -->

<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2>Register</h2>
        </div>

        <?php displayMessage(); ?>

        <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


            <div class="form-group  pb-2">
            <label for="exampleInputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10 ">
                    <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name">
                </div>
            </div>

            <div class="form-group  pb-2">
                <label for="exampleInputName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="exampleInputName" name="username" placeholder="Enter Username">
                </div>
            </div>

            <div class="form-group  pb-2">
                <label for="exampleInputEmail" class="col-sm-2 col-form-label">Email address</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-group pb-2">
                <label for="exampleInputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Password">
                </div>
            </div>

            <div class="form-group pb-2">
               <label for="exampleInputAddress" class="col-sm-2 col-form-label"> Address </label>
               <div class="col-sm-10">
               <input type="text" class="form-control" id="exampleInputAddress"  name="address" placeholder="Enter Address">
               </div>
           </div>

           <div class="form-group  pb-2">
               <label for="exampleInputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
               <div class="col-sm-10">
               <input type="text" class="form-control" id="exampleInputPhoneNumber" name="phone" placeholder="Enter Phone Number">
               </div>
           </div>

            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>



</div>