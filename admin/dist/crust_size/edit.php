<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////


$id = $_GET['id'];

$sql = "select * from crust_size where id = $id";
$op = mysqli_query($con, $sql);
$sizeData = mysqli_fetch_assoc($op);


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

        $sql = "update crust_size set size = '$size', price = $price where id = $id";
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
        <h1 class="mt-4">Crust Size Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Edit Crust Size'); ?>

        </ol>
        <div class="container">

            <form action="edit.php?id=<?php echo  $sizeData['id']; ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Size</label>
                    <input type="text" class="form-control" id="exampleInputName" name="size" value="<?php echo $sizeData['size']?>" placeholder="Enter Crust Size">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" value="<?php echo $sizeData['price']?>" placeholder="Enter price">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>