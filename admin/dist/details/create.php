<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

///////////////////////////////////////////////////////////////////////////////////////////

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $callus_title     = clean($_POST['callus_title']);
    $callus_details   = clean($_POST['callus_details']);
    $location_title   = clean($_POST['location_title']);
    $location_details = clean($_POST['location_details']); 
    $open             = clean($_POST['open']);
    $time             = clean($_POST['time']);
   

    // array to store the errors
    $err = [];

  
    if (!validate($callus_title, 1)) {
        $err['callus_title'] = " callus_title required!";
    }

    if (!validate($callus_details, 1)) {
        $err['callus_details'] = " callus_details required!";
    }elseif(!validate($callus_details, 7)){
        $err['callus_details'] = " callus_details must be valid phone number!";
    }

    if (!validate($location_title, 1)) {
        $err['location_title'] = " location_title required!";
    }

    if (!validate($location_details, 1)) {
        $err['location_details'] = " location_details required!";
    }

    if (!validate($open, 1)) {
        $err['open'] = " open required!";
    }

    if (!validate($time, 1)) {
        $err['time'] = " time required!";
    }


    if (count($err) > 0) {

        //store error array in session to print it in html!
        $_SESSION['Message'] = $err;

    } else {


        $sql = "insert into details (callUs_title,callUs_details,location_title,location_details,open,time)
         values ('$callus_title',$callus_details, '$location_title','$location_details',' $open','$time')";
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
        <h1 class="mt-4"> Details Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Add Details'); ?>

        </ol>
        <div class="container">

            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <div class="form-group">
                    <label for="exampleInputName">Call Us Title</label>
                    <input type="text" class="form-control" id="exampleInputName" name="callus_title" placeholder="Enter call Us Title">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Call Us Details</label>
                    <input type="text" class="form-control" id="exampleInputName" name="callus_details" placeholder="Enter call Us Details">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Location Title</label>
                    <input type="text" class="form-control" id="exampleInputName" name="location_title" placeholder="Enter location Title">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Location Details</label>
                    <input type="text" class="form-control" id="exampleInputName" name="location_details" placeholder="Enter location Details">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Open Date</label>
                    <input type="text" class="form-control" id="exampleInputName" name="open" placeholder="Enter Open Date">
                </div>

                <div class="form-group">
                    <label for="exampleInputName">Time</label>
                    <input type="text" class="form-control" id="exampleInputName" name="time" placeholder="Enter Time">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</main>
<?php
require '../layouts/footer.php';
?>