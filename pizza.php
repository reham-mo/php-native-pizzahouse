<?php

require './admin/dist/helpers/dbConnection.php';
require './admin/dist/helpers/functions.php';
require './layouts/header.php';
require './layouts/thenavbar.php';

$id = $_GET['id'];

/// fetch pizza table
$sql = "select * from pizza where id = $id";
$op = mysqli_query($con, $sql);

$pizzaData = mysqli_fetch_assoc($op);
///////////////////////////////////////////////////////////

$sql = "select * from crust";
$crustOp =  mysqli_query($con, $sql);
/////////////////////////////////////////////////////////
$sql = "select * from extras";
$extrasOp = mysqli_query($con, $sql);


?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

	$(document).ready(function () {
		var crustID = document.getElementById('crustID').value;
		var extraID = document.getElementById('extraID').value;
		document.getElementById('crustIDvalue').value = crustID;
		document.getElementById('extraIDvalue').value = extraID;
	});

	function getcrustPrice() {
		var insidecrustID = document.getElementById('crustID').value;
		document.getElementById('crustIDvalue').value = insidecrustID;

	}
	function getextraPrice() {
		var insidextratID = document.getElementById('extraID').value;
		document.getElementById('extraIDvalue').value = insidextratID;

	}
	
</script>


<form action="order.php" method="POST">

	<input type="hidden" name="pizzaID" value="<?= $pizzaData['id']; ?>">
	

	<section class="ftco-about d-md-flex">

		<div class="one-half img" style="padding-right: 50px; padding-left:220px"> <img src="./admin/dist/pizza/images/<?php echo $pizzaData['image'] ?>" style="height: 500px; width:500px;" alt=""></div>
		<div class="one-half ftco-animate" style="padding-top: 90px; padding-left:20px">
			<div class="heading-section ftco-animate ">
				<h1 class="mb-4"><span class="flaticon-pizza"> </span><?php echo $pizzaData['name']; ?> </h1>
			</div>
			<div class="pb-2">
				<p> </span><?php echo $pizzaData['description']; ?> </p>
				<h2 class="mb-4"> <span> Price : $ <?php echo $pizzaData['price']; ?></h2>
			</div>


			<select id="crustID" onchange="getcrustPrice()" class="form-control mb-4" aria-label="Default select example">
				<?php while ($crustaData = mysqli_fetch_assoc($crustOp)) { ?>

					<option style="background-color: black;" value="<?php echo $crustaData['id']; ?>"> <?php echo $crustaData['type']; ?> - <?php echo $crustaData['size']; ?> : <?php echo '$' . $crustaData['price']; ?> </option>

				<?php } ?>
			</select>

			<select id="extraID" onchange="getextraPrice()" class="form-control mb-4" aria-label="Default select example">
				<?php while ($extraData = mysqli_fetch_assoc($extrasOp)) { ?>

					<option style="background-color: black;" value="<?php echo $extraData['id']; ?>"> <?php echo $extraData['name']; ?> : <?php echo '$' . $extraData['price']; ?> </option>

				<?php } ?>
			</select>



			<input type="hidden" name="crustID" id="crustIDvalue">
			<input type="hidden" name="extraID" id="extraIDvalue">

		
			<div class="pt-2">
			<button type="submit" class="mt-5 pt-5 btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Order</button> 
			</div>
		</div>
	</section>

</form>



<?php require './layouts/footer.php'; ?>