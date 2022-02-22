<?php

require "./admin/dist/helpers/dbConnection.php";

$sql = "select * from pizza";
$op = mysqli_query($con, $sql);


require 'layouts/header.php';
require 'layouts/navbar.php';
require 'layouts/carousel.php';

?>
	<section class="ftco-intro">
		<div class="container-wrap">
			<div class="wrap d-md-flex">
				<div class="info">
					<div class="row no-gutters">
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-phone"></span></div>
							<div class="text">
								<h3>000 (123) 456 7890</h3>
								<p>A small river named Duden flows</p>
							</div>
						</div>
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-my_location"></span></div>
							<div class="text">
								<h3>198 West 21th Street</h3>
								<p>Suite 721 New York NY 10016</p>
							</div>
						</div>
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-clock-o"></span></div>
							<div class="text">
								<h3>Open Monday-Friday</h3>
								<p>8:00am - 9:00pm</p>
							</div>
						</div>
					</div>
				</div>
				<div class="social d-md-flex pl-md-5 p-4 align-items-center">
					<ul class="social-icon">
						<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->


	<section class="ftco-about d-md-flex mx-auto">
		<div class="one-half img" style="background-image: url('images/about.jpg');"></div>
		<div class=" one-half ftco-animate">
			<div class="heading-section ftco-animate ">
				<h2 class="mb-4">Welcome to <span class="flaticon-pizza">Pizza</span> A Restaurant</h2>
			</div>
			<div >
				<p>In 1984, PizzaHouse's opened its doors with one goal in mind: Better Pizza. We knew that with better 
				ingredients we would create better pizzas. That goal and the promise of "Better ingredients. Better pizza.
				" remain true to this day. Our fundamental belief is simple: take care of your people and give them the best 
				to work with and you will make superior quality pizza. This is what drives us and it's why we invest more than
				 many others in the industry in our effort to consistently deliver superior pizza and superior service.</p>
			</div>
		</div>
	</section>

	<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->


	<section class="ftco-section ftco-services">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<h2 class="mb-4">Our Services</h2>
					<p>At the centre of PizzaHouse is our uncompromising commitment to quality that begins with the
					 selection of only the finest quality ingredients from around the globe, sourced from suppliers who 
					 consistently meet our precise specifications..</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5">
							<span class="flaticon-diet"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Healthy Foods</h3>
							<p>our uncompromising commitment to quality that begins with the
					         selection of only the finest quality ingredients from around the globe.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5">
							<span class="flaticon-bicycle"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Fastest Delivery</h3>
							<p>Over the time, we built a team of experienced leaders and a strong operating business
							 model that benefits both our customers and stakeholders.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5"><span
								class="flaticon-pizza-1"></span></div>
						<div class="media-body">
							<h3 class="heading">Original Recipes</h3>
							<p>We provide a variety of freshly baked pizzas. With fine ingredients such as sweet onion, 
							Italian style hot peppers and rich black olives,who can resist taking a bite?</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->



	<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<h2 class="mb-4">Menu</h2>
				<!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
			</div>
		</div>
	</div>


	<div class="container-wrap">


		<div class="row no-gutters d-flex">
			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img" style="background-image: url(images/pizza-1.jpg);"></a>
					<div class="text p-4">
						<h3>Italian Pizza</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia </p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>



			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img" style="background-image: url(images/pizza-2.jpg);"></a>
					<div class="text p-4">
						<h3>Greek Pizza</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>



			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img" style="background-image: url(images/pizza-3.jpg);"></a>
					<div class="text p-4">
						<h3>Caucasian Pizza</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>


			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img order-lg-last" style="background-image: url(images/pizza-4.jpg);"></a>
					<div class="text p-4">
						<h3>American Pizza</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia </p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>



			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img order-lg-last" style="background-image: url(images/pizza-5.jpg);"></a>
					<div class="text p-4">
						<h3>Tomatoe Pie</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>



			<div class="col-lg-4 d-flex ftco-animate">
				<div class="services-wrap d-flex">
					<a href="#" class="img order-lg-last" style="background-image: url(images/pizza-6.jpg);"></a>
					<div class="text p-4">
						<h3>Margherita</h3>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
						<p class="price"><span>$2.90</span> <a href="#" class="ml-2 btn btn-white btn-outline-white">Order</a></p>
					</div>
				</div>
			</div>





		</div>
	</div>



	<div class="container">
		<div class="row justify-content-center mb-5 pb-3 mt-5 pt-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2 class="mb-4">Our Menu Pricing</h2>
				<p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
				<p class="mt-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-1.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Italian Pizza</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-2.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Hawaiian Pizza</span></h3>
							<span class="price">$29.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-3.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Greek Pizza</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-4.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Bacon Crispy Thins</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-5.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Hawaiian Special</span></h3>
							<span class="price">$49.91</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-6.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Ultimate Overload</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-7.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Bacon Pizza</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
				<div class="pricing-entry d-flex ftco-animate">
					<div class="img" style="background-image: url(images/pizza-8.jpg);"></div>
					<div class="desc pl-3">
						<div class="d-flex text align-items-center">
							<h3><span>Ham &amp; Pineapple</span></h3>
							<span class="price">$20.00</span>
						</div>
						<div class="d-block">
							<p>A small river named Duden flows by their place and supplies</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>

<?php require './layouts/footer.php';?>