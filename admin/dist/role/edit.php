<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////


$id = $_GET['id'];

$sql = "select * from role where id = $id";
$op = mysqli_query($con, $sql);
$roleData = mysqli_fetch_assoc($op);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = clean($_POST['title']);

    // array to store the errors
    $err = [];


    if (!validate($title, 1)) {
        $err['title'] = " title required!";
    }


    if (count($err) > 0) {

        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;
    } else {

        $sql = "update role set title = '$title' where id = $id";
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
        <h1 class="mt-4">Dashboard</h1>
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

            <form action="edit.php?id=<?php echo  $roleData['id']; ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control" id="exampleInputName" name="title" value="<?php echo $roleData['title']?>" placeholder="Enter role title">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>