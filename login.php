<?php

require './layouts/header.php';
require './layouts/thenavbar.php';
require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $password = Clean($_POST['password'], 1);
    $username = Clean($_POST['username']);

    $errors = [];


    if (!validate($username, 1)) {
        $errors['username'] = " username required";
    }

    if (!validate($password, 1)) {
        $errors['password'] = " password required";
    } elseif (!validate($password, 5)) {
        $errors['password'] = " Password Length Must be >= 6 Chars";
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {


        $password = md5($password);

        $sql = "select * from users where username = '$username' and password = '$password'";

        $result  = mysqli_query($con, $sql);



        if (mysqli_num_rows($result) == 1) {

            $data = mysqli_fetch_assoc($result);

            $_SESSION['User'] = $data;

            header("location: index.php");
        } else {
            $_SESSION['Message'] = ['Error In Email || Password Try Again  '];
        }
    }
}



?>

<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2>Login</h2>
        </div>
        <div >
                <?php
                displayMessage();
                ?>
            </div>
        <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="exampleInputName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="exampleInputName" name="username" placeholder="Username">
                </div>
            </div>


            <div class="form-group">
                <label for="exampleInputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-primary" href="register.php" role="button">Register</a>
            </div>
        </form>
    </div>



</div>