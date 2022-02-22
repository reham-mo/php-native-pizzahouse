<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


# Fetch Data ... 
$sql = "select orders.*, users.id as userId, pizza_crust.id as pcId, extras.id as extrasId 
          from orders join users on orders.user_id = users.id 
                      join pizza_crust on orders.pizza_crust_id = pizza_crust.id 
                      join extras on orders.extra_id = extras.id;";
$op  = mysqli_query($con, $sql);


///////////////////////////////////////////////////////////////////////////////////////////
require '../layouts/header.php';
require '../layouts/navbar.php';
require '../layouts/sidenav.php';
///////////////////////////////////////////////////////////////////////////////////////////

?>
<!-- select orders.*, users.id as userId, pizza-crust.id as pcId, extras.id as extrasId 
from orders join users on orders.user_id = users.id
            join pizza-crust on orders.pizza_crust_id = pizza-crust.id
            join extras on orders.extra_id = extras.id; -->



<main>
    <div class="container-fluid">
    <h1 class="mt-4">Users Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php displayMessage('Dashboard/Display Users'); ?>
        </ol>





        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Orders :
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User_id</th>
                                <th>Pizza crust_id</th>
                                <th>Extras_id</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>is_confirmed</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User_id</th>
                                <th>Pizza crust_id</th>
                                <th>Extras_id</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>is_confirmed</th>
                            </tr>
                        </tfoot>

                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['userId']; ?></td>
                                    <td><?php echo $data['pcId']; ?></td>
                                    <td><?php echo $data['extrasId']; ?></td>
                                    <td><?php echo $data['price']; ?></td>
                                    <td><?php echo $data['date']; ?></td>
                                    <td><?php echo $data['is_confirmed']; ?></td>

                                    <!-- <td>
                                        <a href='delete.php?id=<?php echo $data['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                        <a href='edit.php?id=<?php echo $data['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>

                                    </td> -->

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php

require '../layouts/footer.php';

?>