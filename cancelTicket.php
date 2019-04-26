<?php 
    include('database/config.php');
    // variable declaration
    $ticketId = $mobile = $errormsg = '';
    if(isset($_POST['cancel'])){
        $ticketId = mysqli_real_escape_string($conn, $_POST['ticketId']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobileNo']); 
        
        $sql = $conn->query("UPDATE reserves SET status = 'Cancelled' WHERE ticketID = '$ticketId' AND mobile = '$mobile'");
        echo '<script type="text/javascript">window.location="cancelTicket.php?act=cancel";</script>';
    }
    if(isset($_REQUEST['act']) && @$_REQUEST['act']=="cancel")
	{
		$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Ticket is successfully cancelled; please wait for your refund on your mobile Number.</div>";
	}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Favicon-->
	<link rel="shortcut icon" href="assets/img/favicon.ico">
    <title>ENA | Cancel Ticket</title>
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
						<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="cancelTicket.php">Cancel Ticket</a></p>
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
		                    <h1 class="mb-10">Ticket Cancellation</h1> 
		                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, day to.</p>
							<?php echo $errormsg; ?>
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
    </body>
</html>