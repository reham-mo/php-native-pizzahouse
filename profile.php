<?php

require './admin/dist/helpers/dbConnection.php';
require './checkLogin.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';


$id = $_SESSION['User']['id'];

//read all data
$sql = "select users.*, customerdetails.address, customerdetails.phone, customerdetails.user_id 
from users join customerdetails on users.id = customerdetails.user_id where users.id = $id";

$userData = mysqli_query($con, $sql);  //data returns as mysqli_result

?>


<!-- require './layouts/thenavbar.php'; -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>House</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                <!-- <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li> -->

                <?php if (isset($_SESSION['User']['id'])) { ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                <?php    } ?>
            </ul>
        </div>
    </div>
</nav>




<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2>Profile</h2>
        </div>
        <div>
            <?php
            displayMessage();
            ?>
        </div>


        <div class="card mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($userData)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['phone']; ?></td>
                                    <td><?php echo $data['address']; ?></td>
                                    <td>
                                        <a href='edit.php?id=<?php echo $data['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>

                                    </td>

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>





    </div>
</div>