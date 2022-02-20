<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////


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

        $sql = "insert into role (title) values ('$title')";
        $op = mysqli_query($con, $sql);

        if ($op) {

            $message = ["Raw Inserted"];
            header('location: index.php');
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
        <h1 class="mt-4">Roles Dashboard</h1>
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

            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control" id="exampleInputName" name="title" placeholder="Enter role title">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>