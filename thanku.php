<?php

require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';
require './layouts/thenavbar.php';
  


?>

<div class="container mt-5 pt-5">

    <div class="d-flex-inline p-2 justify-content-center">
        <div class="mb-2 text-center">
            <h2> <?php
            displayMessage();
            
            ?></h2>
             <a href="index.php" class="ml-2 btn btn-white btn-outline-white">Home</a>
        </div>
       

    </div>
</div>