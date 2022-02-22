<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

// Fetch User data .... 
$id = $_GET['id'];
$sql = "select * from users where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);

##############################################################################################
// Fetch Roles ..... 
$sql = "select * from role";
$role_op  = mysqli_query($con, $sql);


#############################################################################################


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $name     = Clean($_POST['name']);
    $username = Clean($_POST['username']);
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
            $sql = "update users set name =  '$name' , username =  '$username', email = '$email' , role_id = $role_id  where id = $id";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Updated"];
                $_SESSION['Message'] = $message;
    
                header("Location: index.php");
                exit();
            } else {
                $message = ["Error Try Again"];
                $_SESSION['Message'] = $message;
            }
        
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
            <?php  displayMessage('Dashboard/Edit User');   ?>
        </ol>

        <div class="container">


            <form action="edit.php?id=<?php echo $UserData['id']; ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" value="<?php echo $UserData['name'] ?>" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Username</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="username" value="<?php echo $UserData['username'] ?>" placeholder="Enter Username">
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $UserData['email'] ?>" placeholder="Enter Email">
                </div>



                <div class="form-group">
                    <label for="exampleInputPassword">Role Type</label>
                    <select class="form-control" name="role_id">

                    <?php
                        while ($Role_data = mysqli_fetch_assoc($role_op)) {
                        ?>
                            <option value="<?php echo $Role_data['id']; ?>" <?php if ($UserData['role_id'] == $Role_data['id'])
                             {echo 'selected';} ?>><?php echo $Role_data['title']; ?></option>

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