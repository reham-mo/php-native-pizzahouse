<?php

///////////////////////////////////////////////////////////////////////////////////////////
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
///////////////////////////////////////////////////////////////////////////////////////////

$sql = "select * from pizza";
$op = mysqli_query($con, $sql);


////////////////////////////////////////////////////////////////////////////////////////////
require '../layouts/header.php';
require '../layouts/navbar.php';
require '../layouts/sidenav.php';
///////////////////////////////////////////////////////////////////////////////////////////


?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4"> Pizza Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <!-- print session that carries error array in html -->
            <?php displayMessage('Dashboard/Display Pizzas'); ?>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Pizzas :
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>image</th>
                                <th>name</th>
                                <th>description</th>
                                <th>price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>image</th>
                                <th>name</th>
                                <th>description</th>
                                <th>price</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <th><?php echo $data['id'] ?></th>
                                    <th> <img src="images/<?php echo $data['image'];  ?>" class="img-fluid"  alt="img" height='50' width='50' > </th>
                                    <th><?php echo $data['name'] ?></th>
                                    <th><?php echo $data['description'] ?></th>
                                    <th><?php echo  $data['price']?></th>

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