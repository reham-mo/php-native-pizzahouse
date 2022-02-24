<?php

require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';
require './layouts/thenavbar.php';
  
// $id = $_SESSION['User']['id'];
$orderId =$_SESSION['orderData']['id'];

?>
<!-- 
<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2> <?php
            displayMessage();
            
            ?></h2>
             <a href="index.php" class="ml-2 btn btn-white btn-outline-white">Home</a>
        </div>
       

    </div>
</div> -->
<!-- users.id = $id and -->
<!-- //////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
$sql = "select orders.id, orders.price as totalprice, orders.date, users.id as userId, users.name as username, 
        pizza.name as pizzaname, crust.type as crusttype, crust.size as crustsize, extras.name as extraname from
        orders join users on orders.user_id = users.id join pizza on orders.pizza_id = pizza.id join crust on 
        orders.crust_id = crust.id join extras on orders.extra_id = extras.id where orders.id = $orderId";
 $op = mysqli_query($con,$sql);
 
//  $orderData = mysqli_fetch_assoc($op);

?>

<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2>Thank you for ordering from PizzaHouse</h2>
            <h3>your order details: </h3>
        </div>

        <div class="table-responsive">

    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>pizza</th>
                                <th>crust type</th>
                                <th>crust size</th>
                                <th>extra</th>
                                <th>date</th>
                                <th>total price</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php while($orderData = mysqli_fetch_assoc($op)){ ?>
                                <tr>
                                    <td><?php echo $orderData['pizzaname']; ?></td>
                                    <td><?php echo $orderData['crusttype']; ?></td>
                                    <td><?php echo $orderData['crustsize']; ?></td>
                                    <td><?php echo $orderData['extraname']; ?></td>
                                    <td><?php echo date('d/m/Y',$orderData['date']); ?></td>
                                    <td><?php echo '$'.$orderData['totalprice']; ?></td>

                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
           
                    <div class="mb-2 text-center">
                    <a href="index.php" class="ml-2 btn btn-white btn-outline-white">go back</a>
                    </div>
                </div>
       

    </div>
</div>


