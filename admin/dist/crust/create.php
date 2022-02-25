<?php


///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

///////////////////////////////////////////////////////////////////////////////////////////

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $type = clean($_POST['type']);
    $size = clean($_POST['size']);
    $price = $_POST['price'];

    $err = [];

  
    if (!validate($type, 1)) {
        $err['type'] = " type required!";
    }


    if (!validate($size, 1)) {
        $err['size'] = " size required!";
    }


    if (!validate($price, 1)) {
        $err['price'] = " price required!";
    } elseif(!validate($price, 2)){
        $err['price'] = " price must be integer!";
    }


    if (count($err) > 0) {

        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;

    } else {


        $sql = "insert into crust (type,size, price) values ('$type','$size', $price)";
        $op = mysqli_query($con, $sql);

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
        <h1 class="mt-4"> Crust Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Add Crust'); ?>

        </ol>
        <div class="container">

            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Type</label>
                    <input type="text" class="form-control" id="exampleInputName" name="type" placeholder="Enter Crust Type">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Size</label>
                    <input type="text" class="form-control" id="exampleInputName" name="size" placeholder="Enter Crust Size">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" placeholder="Enter Price">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>