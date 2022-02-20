<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////

$id = $_GET['id'];

$sql = "select * from crust_type where id = $id";
$op = mysqli_query($con, $sql);
$typeData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $type = clean($_POST['type']);
    $price = $_POST['price'];

    // array to store the errors
    $err = [];

    if (!validate($type, 1)) {
        $err['type'] = " type required!";
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

        $sql = "update crust_type set type = '$type', price = $price where id = $id";
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
        <h1 class="mt-4">Crust Type Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php

            if (isset($_SESSION['Message'])) {
                foreach ($_SESSION['Message'] as $val) {
                    echo ' <li> ' . $val . '</li>';
                }
                unset($_SESSION['Message']);
            } else {
                echo ' <li class="breadcrumb-item active">Dashboard</li>';
            }


            ?>

        </ol>
        <div class="container">

            <form action="edit.php?id=<?php echo  $typeData['id']; ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Type</label>
                    <input type="text" class="form-control" id="exampleInputName" name="type" value="<?php echo $typeData['type']?>" placeholder="Enter Crust Type">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" value="<?php echo $typeData['price']?>" placeholder="Enter price">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>