<?php
   include('database/config.php');
   $traveldate = $route = $action = $id = $result = '';
   $traveldate = mysqli_escape_string($conn, $_POST['traveldate']);
   $sq = "SELECT * FROM bus where traveldate = '$traveldate'";
   $b = $conn->query($sq);
   $res = $b->fetch_assoc();
?>
<!DOCTYPE html>
	<html lang="zxx" class="no-js">
		<head>
			<!-- Favicon-->
			<link rel="shortcut icon" href="assets/img/favicon.ico">
			<title>ENA Travels | Bus List</title>
    		<?php include("sections/header.php");?>
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
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="selectbus.php">Available Fleet</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->
	
			<!-- Start destinations Area -->
			<section class="destinations-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-40 col-lg-8">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Available Fleet for Date: <?php echo $res['traveldate'] ; ?></h1>
		                        <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, day to.</p>
		                    </div>
		                </div>
		            </div>						
					<div class="row">
						<!-- start iteration -->
						<?php
							if(isset($_POST['save'])){
								$route = mysqli_escape_string($conn, $_POST['routename']);
								$traveldate = mysqli_escape_string($conn, $_POST['traveldate']);

								$sql = "SELECT bus.id, bus.busregno, route.routename, route.origin, route.destination, bus.traveldate, bus.departure, bus.available, route.price FROM bus INNER JOIN route ON bus.route=route.id WHERE bus.traveldate = '".$traveldate."' AND bus.route = '".$route."' ";
								$a = $conn->query($sql);
								while($result = $a->fetch_assoc()){
									echo '
										<div class="col-lg-4 wow fadeInUp">
											<div class="single-destinations">
												<div class="thumb">
													<img src="../assets/img/packages/scania1.jpg" alt="">
												</div>
												<div class="details">
													<h4>Bus Number: '.$result['busregno'].'</h4>
													<p><i>
														Travel in style
														</i>
													</p>
													<ul class="package-list">
														<li class="d-flex justify-content-between align-items-center">
															<span><h6>From</h6></span>
															<span class="text-uppercase"><h6>'.$result['origin'].'</h6></span>
														</li>
														<li class="d-flex justify-content-between align-items-center">
															<span><h6>To</h6></span>
															<span class="text-uppercase"><h6>'.$result['destination'].'</h6></span>
														</li>
														<li class="d-flex justify-content-between align-items-center">
															<span><h6>Date</h6></span>
															<span><h6>'.$result['traveldate'].' '.$result['departure'].'</h6></span>
														</li>
														<li class="d-flex justify-content-between align-items-center">
															<span><h6>Available</h6></span>
															<span class="badge badge-success"><h5>'.$result['available'].' Seats </h5></span>
														</li>
														<li class="d-flex justify-content-between align-items-center">
															<span><h6>Fare</h6></span>
															<a href="#" class="price-btn">Ksh. '.$result['price'].'</a>
														</li>
														<li class="d-flex justify-content-between align-items-center">
															<a href="selectseat.php" class="btn btn-block btn-primary">Book Now</a>
														</li>													
													</ul>
												</div>
											</div>
										</div>
									';
								}
							}else{
								echo '<div class="col-lg-4"><div class="single-destinations">No Buses For the Selected Date. Please Try again later</div></div>';
							}
						?>
						
						<!-- End iteration -->
																																				
					</div>
				</div>	
			</section>
			<!-- End destinations Area -->
		
			<!-- start footer Area -->			
			<?php include ("sections/footer1.php"); ?>
			<!-- End footer Area -->	
			<!-- scripts -->
			<?php include("sections/footer2.php");?>
		</body>
	</html>