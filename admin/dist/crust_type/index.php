<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
///////////////////////////////////////////////////////////////////////////////////////////


$sql = "select * from crust_type";
$op = mysqli_query($con, $sql);


////////////////////////////////////////////////////////////////////////////////////////////
require '../layouts/header.php';
require '../layouts/navbar.php';
require '../layouts/sidenav.php';
///////////////////////////////////////////////////////////////////////////////////////////


?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4"> Crust Type Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Display Crust Type'); ?>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Crust Type :
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>
                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <th><?php echo $data['id'] ?></th>
                                    <th><?php echo $data['type'] ?></th>
                                    <th><?php echo $data['price'] ?></th>

                                    <td>
                                        <a href='delete.php?id=<?php echo $data['id']  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                        <a href='edit.php?id=<?php echo $data['id']  ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                    </td>

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