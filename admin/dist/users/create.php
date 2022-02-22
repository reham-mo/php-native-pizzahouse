<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

# Logic ....... 
#############################################################################################
$sql = "select * from role";
$rolesOp  = mysqli_query($con, $sql);

#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $username = Clean($_POST['username']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $role_id  = Clean($_POST['role_id']);

    # Validate Input ... 

    $errors = [];
    # Validate Name ... 
    if (!validate($name, 1)) {
        $errors['name'] = " name Required";
    }

      # Validate Username ... 
      if (!validate($username, 1)) {
        $errors['username'] = " username Required";
    }


    # Validate Email .... 
    if (!validate($email, 1)) {
        $errors['email'] = " email Required";
    } elseif (!validate($email, 4)) {
        $errors['email'] = " email Invalid";
    }

    # Validate Password 
    if (!validate($password, 1)) {
        $errors['password'] = " password Required";
    } elseif (!validate($password, 5)) {
        $errors['password'] = " password Length Must be >= 6 Chars";
    }


    # Validate Role_id  ... 
    if (!validate($role_id, 1)) {
        $errors['role'] = " role Required";
    } elseif (!validate($role_id, 2)) {
        $errors['role'] = " role Invalid";
    }

 

    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

            $password = md5($password);
            $sql = "insert into users (name,username,email,password,role_id) values ('$name' ,'$username','$email' ,'$password',$role_id)";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
            }

            $_SESSION['Message'] = $message;
        
    }
}



///////////////////////////////////////////////////////////////////////////////////////////
require '../layouts/header.php';
require '../layouts/navbar.php';
require '../layouts/sidenav.php';
///////////////////////////////////////////////////////////////////////////////////////////
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Users Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php  displayMessage('Dashboard/Add User');   ?>
        </ol>

        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Username</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="username" placeholder="Enter Username">
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter Email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword">Role Type</label>
                    <select class="form-control" name="role_id">

                        <?php
                        while ($Role_data = mysqli_fetch_assoc($rolesOp)) {
                        ?>

                            <option value="<?php echo $Role_data['id']; ?>"><?php echo $Role_data['title']; ?></option>

                        <?php }  ?>

                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>