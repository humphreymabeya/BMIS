<?php 
    include('database/config.php');
    // variable declaration
    $ticketId = $mobile = '';
    $ticketId = mysqli_real_escape_string($conn, $_POST['ticketId']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobileNo']); 
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Favicon-->
	<link rel="shortcut icon" href="assets/img/favicon.ico">
    <title>ENA | Print Ticket</title>
    <?php include('sections/header.php');?>
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
		                    <h1 class="mb-10">Tickets Section</h1> 
		                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, day to.</p>
							
		                </div>
		            </div>
		        </div>						
				<div class="row">
                <?php
                    // query database
                    if(isset($_POST['print'])){
                        $sql = "select reserves.ticketId, reserves.mobile, reserves.fullname, reserves.seatnum, bus.busregno, bus.traveldate, bus.departure, route.routename, route.price FROM  reserves INNER JOIN bus ON reserves.bid=bus.id INNER JOIN route ON bus.route=route.id WHERE reserves.ticketId = '".$ticketId."' AND reserves.mobile = '".$mobile."'";
                        // $sql = "select a.ticketId, a.mobile, a.fullname, a.seatnum, b.busregno, b.traveldate, b.departure, c.routename, c.price FROM reserves as a, bus as b, c as route WHERE a.bid = b.id AND a.ticketId = '".$ticketId."' AND a.mobile = '".$mobile."'";
                        // $sql = "SELECT * FROM reserves WHERE ticketID = '".$ticketId."' AND mobile = '".$mobile."'";
                        $a = $conn->query($sql);
                        $result = $a->fetch_assoc();
                    
                        echo '
					<div class="col-lg-4 col-md-4 col-sm-4 offset-4">
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
										<span><h5>Ticket No:</h5></span>
										<span><h6>'.$result['ticketId'].'</h6></h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Passenger Name</h5></span>
										<span><h6>'.$result['fullname'].'</h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Phone Number</h5></span>
										<span><h6>'.$result['mobile'].'</h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Seat Number</h5></span>
										<span><h6>'.$result['seatnum'].'</h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Fare</h5></span>
										<span><h6>Ksh. '.$result['price'].'</h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Bus Name</h5></span>
										<span><h6>'.$result['busregno'].'</h6></span>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Route</h5></span>
										<span><h6>'.$result['routename'].'</h6></span>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Travel Date</h5></span>
										<span><h6>'.$result['traveldate'].'</h6></span>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span><h5>Departure</h5></span>
										<span><h6>'.$result['departure'].'</h6></span>
									</li>										
									<li class="d-flex justify-content-between align-items-center">
										<a href="#" class="btn btn-primary btn-block">Print</a>
									</li>													
								</ul>
							</div>
						</div>					
                	</div> 
                    ';
                    }
                ?>
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