<?php


///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $size = clean($_POST['size']);
    $price = $_POST['price'];

    // array to store the errors
    $err = [];

  
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

        $sql = "insert into crust_size (size, price) values ('$size', $price)";
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
        <h1 class="mt-4"> Crust Size Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Add Crust size'); ?>

        </ol>
        <div class="container">

            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

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