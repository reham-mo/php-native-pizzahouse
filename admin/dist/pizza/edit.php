<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
///////////////////////////////////////////////////////////////////////////////////////////


$id = $_GET['id'];

$sql = "select * from pizza where id = $id";
$op = mysqli_query($con, $sql);
$pizzaData = mysqli_fetch_assoc($op);


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
    } elseif (!validate($price, 2)) {
        $err['price'] = " price must be number!";
    }


   //validate Image ... 
    if (validate($_FILES['image']['name'], 1)) {
      if (!validate($_FILES['image']['name'], 3)) {
        $errors['image']  = " image: invalid extention";
    }
}



    if (count($err) > 0) {
        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;
    } else {

        
           // option 1 - new image is uploaded!
           if (validate($_FILES['image']['name'], 1)) {

            $image = uploadFile($_FILES);

            if (!empty($image)) {
                
                # delete old image .... 
                unlink('images/' . $pizzaData['image']);
            }
        } else {
           // option 2 - if no new image use old one thats alr in db
            $image = $pizzaData['image'];
        }

        $sql = "update pizza set name = '$name' , image = '$image', description = '$description', price = $price where id = $id";

        $op  =  mysqli_query($con, $sql);

        if ($op) {

            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;
    
            header("Location: index.php");
            exit();

        } else {
            $message = ["Error Try Again"];
            $_SESSION['Message'] = $message;
        }

        mysqli_close($con);
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
            <?php displayMessage('Dashboard/Edit Pizza'); ?>

        </ol>
        <div class="container">

            <form action="edit.php?id=<?php echo  $pizzaData['id']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $pizzaData['name'] ?>" placeholder="Enter Pizza Name">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputName">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10" value=""> <?php echo $pizzaData['description'] ?> </textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" value="<?php echo $pizzaData['price'] ?>" placeholder="Enter Price">
                </div>

                <div class="form-group py-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input type="file" id="formFile" name="image">
                </div>
                <div class="col-12 py-3">
                    <img src="./images/<?php echo $pizzaData['image']; ?>" height="200">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>