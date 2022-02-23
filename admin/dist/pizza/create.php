<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
///////////////////////////////////////////////////////////////////////////////////////////


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name        = clean($_POST['name']);
    $description = clean($_POST['description']);
    $price       = $_POST['price'];

    // array to store the errors
    $err = [];

     //validate name
    if (!validate($name, 1)) {
        $err['name'] = " name required!";
    }

    //validate description
    if (!validate($description, 1)) {
    $err['description'] = " description required!";
    }

     //validate price
    if (!validate($price, 1)) {
        $err['price'] = " price required!";
    }elseif (!validate($price, 2)) {
        $err['price'] = " price must be number!"; 
    }
    
    // elseif (!validate($price, 2)) {
    //     $err['price'] = " price must be number!";
    // }


      //validate image
    if (!validate($_FILES['image']['name'], 1)) {
        $errs['image']   = " image required";
    }elseif(!validate($_FILES['image']['name'], 3)) {
        $errs['image']   = " image: invalid extention";
    }



    if (count($err) > 0) {
        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;
    } else {

        $image = uploadFile($_FILES);

        if (empty($image)) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

            $sql = "insert into pizza (name,image,description,price) values ('$name','$image','$description',$price)";

            $op  =  mysqli_query($con, $sql);

            mysqli_close($con);

            if ($op) {
                $message = ["Raw Inserted"];
     
            } else {
                $message = ["Error Try Again"];
            }

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
        <h1 class="mt-4"> Pizza Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Add Pizza'); ?>

        </ol>
        <div class="container">

            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Pizza Name">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                </div>


                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" placeholder="Enter Price">
                </div>

                <div class="form-group py-3">
                <label for="formFile" class="form-label">Image</label>
                <input  type="file" id="formFile" name="image">
            </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>