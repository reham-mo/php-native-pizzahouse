<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';


# Fetch Data ... 
$id = $_GET['id'];
$sql = "select orders.*, users.id as userId, pizza_crust.id as pcId, extras.id as extrasId 
          from orders join users on orders.user_id = users.id 
                      join pizza_crust on orders.pizza_crust_id = pizza_crust.id 
                      join extras on orders.extra_id = extras.id where orders.id =$id";

$op  = mysqli_query($con, $sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 

    $confirm     = Clean($_POST['confirm']);


    # Validate Input ... 
    $errors = [];


    # Validate Role_id  ... 
    if (!validate($confirm, 1)) {
        $errors['confirm'] = " confirm Required";
    } elseif (!validate($confirme, 2)) {
        $errors['confirm'] = " confirm Invalid";
    }

 

    # Check Errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        # logic .... 

            $sql = "update orders set is_confirmed = '$confirm'  where id = $id";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Updated"];
                $_SESSION['Message'] = $message;
    
                header("Location: index.php");
                exit();
            } else {
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
        <h1 class="mt-4">Orders Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php displayMessage('Dashboard/Display Orders'); ?>
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
                                <th>Action</th>
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
                                <th>Action</th>
                            </tr>
                        </tfoot>

                        <tbody>


                        <option value="<?php echo $Role_data['id']; ?>" 
                        <?php if ($data['id'] == $Role_data['id']){ echo 'selected';
                                                                            } ?>><?php echo $Role_data['title']; ?></option>




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
                                        <td>
                                        <form action="edit.php?id=<?php echo $data['id'] ?>" method="post">
                                            <select class="form-control"  name="confirm">

                                                    <option value="1"> confirmed </option>
                                                    <option value="0"> rejected </option>
                                            </select>        
                                        </td>
                                            <td><button type="submit" class="btn btn-primary">Save</button> </td>    
                                        </form>
                                    </tr>
                                <?php }  ?>
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