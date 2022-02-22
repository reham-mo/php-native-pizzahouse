<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
///////////////////////////////////////////////////////////////////////////////////////////

$id = $_GET['id'];

$sql = "select * from crust where id = $id";
$op = mysqli_query($con, $sql);
$crustData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $type = clean($_POST['type']);
    $size = clean($_POST['size']);
    $price = $_POST['price'];

    // array to store the errors
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

        $sql = "update crust set type = '$type', size = '$size', price = $price where id = $id";
        $op = mysqli_query($con, $sql);

        if($op){
            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;
    
            header("Location: index.php");
            exit();
    
        }else{
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
        <h1 class="mt-4">Crust Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Edit Crust'); ?>

        </ol>
        <div class="container">

            <form action="edit.php?id=<?php echo  $crustData['id']; ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Type</label>
                    <input type="text" class="form-control" id="exampleInputName" name="type" value="<?php echo $crustData['type']?>" placeholder="Enter Crust Size">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Size</label>
                    <input type="text" class="form-control" id="exampleInputName" name="size" value="<?php echo $crustData['size']?>" placeholder="Enter Crust Size">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" value="<?php echo $crustData['price']?>" placeholder="Enter price">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>