<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////


$id = $_GET['id'];

$sql = "select * from extras where id = $id";
$op = mysqli_query($con, $sql);
$extraData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = clean($_POST['name']);
    $price = $_POST['price'];

    // array to store the errors
    $err = [];

    //validate image
    if (!validate($_FILES['image']['name'], 1)) {
        $errs['image']   = " is required";
    } else {

        $imgName  = $_FILES['image']['name'];
        $imgTmp  = $_FILES['image']['tmp_name'];

        //get the img extension
        $nameArray = explode('.', $imgName);
        $imgExt = strtolower(end($nameArray));
        $imgFinalName = time() . rand() . '.' . $imgExt;
        $allowedEx = ['jfif', 'jpg', 'jpeg', 'png'];

        if (!in_array($imgExt, $allowedEx)) {
            $errs['image']   = "Not Allowed Extension";
        }
    }


    if (!validate($name, 1)) {
        $err['name'] = " name required!";
    }

   
    if (!validate($price, 1)) {
        $err['price'] = " price required!";
    } elseif (!validate($price, 2)) {
        $err['price'] = " price must be integer!";
    }


    if (count($err) > 0) {

        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;
    } else {

        // option 1 - new image is uploaded!
        if (!empty($_FILES['image']['name'])) {

            $disPath = 'images/' . $imgFinalName;

            if (move_uploaded_file($imgTmp, $disPath)) {

                # delete old image .... 
                unlink('images/' . $extraData['image']);
            }
        } else {
            // option 2 - if no new image use old one thats alr in db
            $imgFinalName = $extraData['image'];
        }

        $sql = "update extras set name = '$name' , image = '$imgFinalName', price = $price where id = $id";

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
        <h1 class="mt-4"> Extras Dashboard</h1>
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

            <form action="edit.php?id=<?php echo  $extraData['id']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $extraData['name'] ?>" placeholder="Enter Extras">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" name="price" value="<?php echo $extraData['price'] ?>" placeholder="Enter Price">
                </div>

                <div class="form-group py-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input type="file" id="formFile" name="image">
                </div>
                <div class="col-12 py-3">
                    <img src="./images/<?php echo $extraData['image']; ?>" height="200">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>