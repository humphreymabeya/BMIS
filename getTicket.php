<?php
	$action = $id = $tid = '';
	include('database/config.php');
	$fullname = $mobile = $idno = $email = $seat = $errormsg = $bid = '';  
	$tid = $bid = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
	$sq = $conn->query("SELECT * FROM reserves WHERE id = '".$tid."'");
	$res = $sq->fetch_assoc();

	if(isset($_POST['save'])){	
		$bid = mysqli_real_escape_string($conn, $_POST['bid']);
		foreach($_POST['fullname'] as $index => $val){
			$fullname = $val;
			$mobile = $_POST['mobile'][$index];
			$idno = $_POST['idno'][$index];
			$email = $_POST['email'][$index];
			$seat = $_POST['seatnum'][$index];
			$seat_xy = $_POST['seat_xy'][$index];
			
			$sql = $conn->query("INSERT into reserves (bid, fullname, mobile, idno, email, seatnum, seat_xy) VALUES ('$bid','$fullname', '$mobile', '$idno','$email', '$seat', '$seat_xy')");
			echo '<script type="text/javascript">window.location="getTicket.php?act=book";</script>';
		}
	}
	
	if(isset($_REQUEST['act']) && @$_REQUEST['act']=="book")
	{
		$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Seat(s) selected successfully. Your Ticket Number Is: <></div>";
	}	
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<!-- Favicon-->
		<link rel="shortcut icon" href="assets/img/favicon.ico">
		<title>ENA Travels | Bus List</title>
		<?php include("sections/header.php");?>
		<link rel="stylesheet" href="assets/css/seats.css">
		<!-- <link rel="stylesheet" href="assets/css/jquery.seat-charts.css"> -->
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
						<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="selectseat.php">Print Ticket</a></p>
					</div>	
				</div>
			</div>
		</section>
        <!-- End banner Area -->
        <!-- ticket generation area -->
        <section class="destinations-area section-gap">
			<div class="container">
		        <div class="row d-flex justify-content-center">
		            <div class="menu-content pb-40 col-lg-8">
		                <div class="title text-center">
		                    <h1 class="mb-10">Tickets Section</h1> <?php echo $res['ticketID']; ?>
		                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, day to.</p>
							<?php echo $errormsg; ?>
		                </div>
		            </div>
		        </div>						
				<div class="row">
					<!-- <div class="col-lg-4">
						<div class="single-destinations">
							<div class="thumb">
								<img src="../assets/img/favicon.png" style="width:200px; height=200px; margin-left:70px;" alt="">
							</div>
							<div class="details">
								<h4 class="d-flex justify-content-between">
									<span>Ena Travel Company</span>                              	
									<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>				
									</div>	
								</h4>
													
								<ul class="package-list">
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Ticket No:</h6></span>
										<span>'.$res['busregno'].'</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Passenger Name</h6></span>
										<span>'.$res['fullname'].'</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Phone Number</h6></span>
										<span>070000000</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Seat Number</h6></span>
										<span>3</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Fare</h6></span>
										<span>Ksh. 800</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Bus Name</h6></span>
										<span>KCR 111K</span>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Route</h6></span>
										<span>Migori - Nairobi</span>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Travel Date</h6></span>
										<span>2019 - 02 - 30</span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h6>Departure</h6></span>
										<span>0900hrs</span>
									</li>										
									<li class="d-flex justify-content-between align-items-center">
										<a href="#" class="btn btn-primary btn-block">Print</a>
									</li>													
								</ul>
							</div>
						</div>					
                	</div>  -->
				</div>
            </div>
        </section>
        <!-- start footer Area -->			
		<?php include ("sections/footer1.php"); ?>
		<!-- End footer Area -->	
		<!-- scripts -->
		<?php include("sections/footer2.php");?>
    </body>
</html>