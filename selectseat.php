<?php
	$action = $id = '';
	include('database/config.php');
	$fullname = $mobile = $idno = $email = $seat = $errormsg = $bid = '';  
	$bid = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
	$sqlEdit = $conn->query("SELECT * FROM bus WHERE id = '".$bid."'");
	
	// fetch price
	$sqlPrice = "SELECT route.price FROM bus INNER JOIN route ON bus.route=route.id WHERE bus.id = '".$bid."'";
	$a = $conn->query($sqlPrice);
	$result = $a->fetch_assoc();

	// fetch booked seats
	$sqlSeats = $conn->query("SELECT GROUP_CONCAT(CONCAT('''', seat_xy, '''')) AS seatxy FROM reserves WHERE bid = '".$bid."' AND status = 'Booked'");
	$results = $sqlSeats->fetch_array(MYSQLI_ASSOC);
	$res = $results['seatxy'];

	// function to create random ticketID
	function createTicketID(){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWZYZ0123456789';
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	$ticketId = createTicketID();	
?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
		<head>
			<!-- Favicon-->
			<link rel="shortcut icon" href="assets/img/favicon.ico">
			<title>ENA Travels | Bus List</title>
			<?php include("sections/header.php");?>
			<link rel="stylesheet" href="assets/css/seats.css">
		</head>
		<body>	
			<!-- navbar -->
			<?php include("sections/navbar.php");?>
			<!-- start banner Area -->
			<section class="about-banner relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Ena Travel Company				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="selectseat.php">Seat Selection</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- End banner Area -->
			<!-- <start seat map area -->
			<section class="destinations-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-5 col-lg-8">
		                    <div class="title text-center">
								<h1 class="mb-10">Select your Seat(s)</h1> <?php //echo $result['price']; ?>
		                    </div>
		                </div>
		            </div>						
					<div class="row">
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-destinations">
								<!-- seat map -->
								<div class="details">
									<h6 class="text-center">Front</h6>
									<div id="seat-map" class="text-center">
										<div class="front-indicator"></div>
									</div>
									<br><br><br><br><br>
									<h6 class="text-center">Back</h6>
								</div><br>
								<div class="details text-center">
									<h6>Booked - <img src="../assets/img/red.jpg" style="width:25px;height:25px;border-radius:4px"></h6><br>
									<h6>Available - <img src="../assets/img/blue.png" style="width:25px;height:25px;border-radius:4px"></h6><br>
									<h6>Selected - <img src="../assets/img/green.png" style="width:25px;height:25px;border-radius:4px"></h6>
								</div>									
							</div>
						</div>
						<div class="col-lg-7 col-md-6 col-sm-6">
							<div class="single-destinations">
								<div class="details details-overflow">
									<h4>Customer Details</h4>
									<?php echo $errormsg; ?>
									<div class="booking-details">
										<form action="getTicket.php" class="needs-validation" role="form" method="POST" novalidate>
											<input type="hidden" name="bid" value="<?php echo $bid;?>">
											<h3> Selected Seats (<span id="counter">0</span>):</h3>
											<ul id="selected-seats">
											</ul>
											<h3>Total Cost: <b>Ksh. <span id="total" style="color: red;">0</span></b></h3>
											<input type="hidden" name="id" value="<?php echo $id;?>" />
											<input type="hidden" name="action" value="<?php echo $action;?>" />
											<input type="hidden" name="fare" value="<?php echo $result['price']; ?>" />
											<button type="submit" name="save" class="checkout-button btn btn-danger">Book Now</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
            <!-- start footer Area -->			
			<?php include ("sections/footer1.php"); ?>
			<!-- End footer Area -->	
			<!-- scripts -->
			<?php include("sections/footer2.php");?>
			<!-- jquery seat chart -->
			<script>
				var firstSeatLabel = 1;
	
				$(document).ready(function() {
					var $cart = $('#selected-seats'),
						$counter = $('#counter'),
						$total = $('#total'),
						sc = $('#seat-map').seatCharts({
						map: [
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'eeeee',
						],
						seats: {
							e: {
								price : <?php echo $result['price']; ?>,
								classes : 'economy-class', 
								category: 'Economy Class'
							}									
						},
						naming : {
							top : false,
							left: false,
							getLabel : function (character, row, column) {
								return firstSeatLabel++;
							},
						},
						legend : {
							node : $('#legend'),
								items : [
								[ 'f', 'available',   'First Class' ],
								[ 'e', 'available',   'Economy Class'],
								[ 'f', 'unavailable', 'Already Booked']
								]					
						},
						click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							$('<li style="list-style-type:none; font-size:12px; color: black;"><b style="color:black; font-size:15px;">'+this.data().category+' Seat Number: <strong>'+this.settings.label+'</strong>: Ksh. '+this.data().price+'</b>\
									<div class="row">\
										<div class="col-md-12">\
												<div class="form-group row">\
													<label class="col-form-label col-sm-2">Full Names:</label>\
													<div class="col-sm-10">\
														<input type="text" name="fullname[]" class="form-control" id="fullname" required/>\
														<div class="valid-feedback"></div>\
														<div class="invalid-feedback">Please Provide a valid Name</div>\
													</div>\
												</div>\
												<div class="form-group row">\
													<label class="col-form-label col-sm-2">Mobile No.:</label>\
														<div class="col-sm-10">\
															<input type="number" name="mobile[]" class="form-control" id="mobile" required/>\
															<div class="valid-feedback"></div>\
															<div class="invalid-feedback">Please Provide a valid Mobile Number</div>\
														</div>\
												</div>\
												<div class="form-group row">\
													<label class="col-form-label col-sm-2">ID Number:</label>\
														<div class="col-sm-10">\
															<input type="number" name="idno[]" class="form-control" id="idno" required/>\
															<div class="valid-feedback"></div>\
															<div class="invalid-feedback">Please Provide a valid ID Number</div>\
														</div>\
												</div>\
												<div class="form-group row">\
													<label class="col-form-label col-sm-2">Email:</label>\
														<div class="col-sm-10">\
															<input type="email" name="email[]" class="form-control" id="email" />\
															<div class="valid-feedback"></div>\
															<div class="invalid-feedback">Please Provide a valid Email Address</div>\
														</div>\
												</div>\
												<div class="form-group row">\
													<div class="col-sm-8 offset-2">\
														<input type="hidden" class="form-control" name="seatnum[]" value="'+this.settings.label+'" readonly>\
														<input type="hidden" class="form-control" name="seat_xy[]" value="'+this.settings.id+'" readonly>\
														<a href="#" class="cancel-cart-item btn btn-success btn-sm">Cancel</a>\
													</div>\
												</div>\
										</div>\
									</div>\
								</li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
							
							/*
							* Lets update the counter and total
							*
							* .find function will not find the current seat, because it will change its stauts only after return
							* 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							*/
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);
							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
							//seat has been vacated
							return 'available';
						} else if (this.status() == 'unavailable') {
							//seat has been already booked
							return 'unavailable';
						} else {
							return this.style();
						}
						}
					});

					//this will handle "[cancel]" link clicks
					$('#selected-seats').on('click', '.cancel-cart-item', function () {
						//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
						sc.get($(this).parents('li:first').data('seatId')).click();
					});
					// create array to output selected seats
					sc.get([<?php echo $res ?>]).status('unavailable');	
				});

				function recalculateTotal(sc) {
					var total = 0;
				
					//basically find every selected seat and sum its price
					sc.find('selected').each(function () {
						total += this.data().price;
					});
					
					return total;
				}	
			</script>
        </body>
    </html>