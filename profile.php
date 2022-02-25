<?php

require './admin/dist/helpers/dbConnection.php';
require './checkLogin.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';


$id = $_SESSION['User']['id'];

//read all user data
$sql = "select users.*, customerdetails.address, customerdetails.phone, customerdetails.user_id 
from users join customerdetails on users.id = customerdetails.user_id where users.id = $id";

$userData = mysqli_query($con, $sql);  //data returns as mysqli_result

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//read all order data
$sql = "select orders.id, orders.price as totalprice, orders.date, orders.is_confirmed, users.id as userId, users.name as username, 
        pizza.name as pizzaname, crust.type as crusttype, crust.size as crustsize, extras.name as extraname from
        orders join users on orders.user_id = users.id join pizza on orders.pizza_id = pizza.id join crust on 
        orders.crust_id = crust.id join extras on orders.extra_id = extras.id where users.id = $id";
$orderOp = mysqli_query($con, $sql);


function statusCon($stat)
{
    $status = "pending";
    if ($stat == 1) {
        $status = "order confirmed!";
    }
    return $status;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>House</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>

                <?php if (isset($_SESSION['User']['id'])) { ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                <?php    } ?>
            </ul>
        </div>
    </div>
</nav>




<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-4 text-center">
            <h2>Profile</h2>
            <?php displayMessage(); ?>
        </div>

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



        <h3 class="mb-4 mt-4"> My Orders: </h3>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>pizza</th>
                    <th>crust type</th>
                    <th>crust size</th>
                    <th>extra</th>
                    <th>date</th>
                    <th>status</th>
                    <th>total price</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($orderData = mysqli_fetch_assoc($orderOp)) { ?>
                    <tr>
                        <td><?php echo $orderData['pizzaname']; ?></td>
                        <td><?php echo $orderData['crusttype']; ?></td>
                        <td><?php echo $orderData['crustsize']; ?></td>
                        <td><?php echo $orderData['extraname']; ?></td>
                        <td><?php echo date('d/m/Y', $orderData['date']); ?></td>
                        <td><?php echo statusCon($orderData['is_confirmed']); ?></td>
                        <td><?php echo '$' . $orderData['totalprice']; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>