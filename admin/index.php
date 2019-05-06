<?php include('../database/config.php'); ?>
<?php include('../database/authenticate.php'); ?>
<!DOCTYPE html>
<html>
  	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<title>Administrator | ENA Travels</title>
		<?php include('admin-sections/header.php'); ?>
  	</head>
  	<body>
		<!-- Side Navbar -->
		<?php include('admin-sections/navbar1.php'); ?>
		<div class="page">
			<!-- navbar-->
			<?php include('admin-sections/navbar2.php'); ?>
			<!-- Counts Section -->
			<section class="dashboard-counts section-padding">
				<div class="container-fluid">
					<div class="row">
						<!-- Count item widget-->
						<div class="col-xl-3 col-md-4 col-6">
							<div class="wrapper count-title d-flex">
								<div class="icon"><i class="fa fa-road"></i></div>
								<div class="name"><strong class="text-uppercase">Routes</strong><span>All Time</span>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from route where delete_status='0'");
                                        $num_rows = $result->num_rows;
									?>
									<div class="count-number"> <?php echo $num_rows; ?> </div>
								</div>
							</div>
						</div>
						<!-- Count item widget-->
						<div class="col-xl-3 col-md-4 col-6">
							<div class="wrapper count-title d-flex">
								<div class="icon"><i class="icon-user"></i></div>
								<div class="name"><strong class="text-uppercase">Travellers</strong><span>Last 6 Months</span>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from reserves where status='Booked'");
                                        $num_rows = $result->num_rows;
									?>
									<div class="count-number"><?php echo $num_rows; ?> </div>
								</div>
							</div>
						</div>
						<!-- Count item widget-->
						<div class="col-xl-3 col-md-4 col-6">
							<div class="wrapper count-title d-flex">
								<div class="icon"><i class="fa fa-bus"></i></div>
								<div class="name"><strong class="text-uppercase">Buses</strong><span>Last 12 Months</span>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from bus where delete_status='0'");
                                        $num_rows = $result->num_rows;
									?>
									<div class="count-number"> <?php echo $num_rows; ?> </div>
								</div>
							</div>
						</div>
						<!-- Count item widget-->
						<div class="col-xl-3 col-md-4 col-6">
							<div class="wrapper count-title d-flex">
								<div class="icon"><i class="icon-user"></i></div>
								<div class="name"><strong class="text-uppercase">Drivers</strong><span>All Time</span>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from driver where delete_status='0'");
                                        $num_rows = $result->num_rows;
									?>
									<div class="count-number"> <?php echo $num_rows; ?> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Header Section-->
			<!-- charts section -->
			<section class="dashboard-header section-padding">
        		<div class="container-fluid">
          			<div class="row d-flex align-items-md-stretch">
            			<!-- Bar Chart -->
						<div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
							<div class="card sales-report">
								<h2 class="display h4">Financial Analysis report</h2>
								<p> Graphical analysis of the monthly generated income.</p>
								<div class="bar-chart">
									<canvas id="barChart"></canvas>
								</div>
							</div>
						</div>
						<!-- Line Chart -->
						<div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
							<div class="card sales-report">
								<h2 class="display h4">Passenger Bookings report</h2>
								<p> Graphical analysis of bookings in the current year.</p>
								<div class="line-chart">
									<canvas id="lineChart"></canvas>
								</div>
							</div>
						</div>
						<!-- Pie Chart-->
						<!-- <div class="col-lg-3 col-md-6">
							<div class="card project-progress">
								<h2 class="display h4">Project Beta progress</h2>
								<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
								<div class="pie-chart">
									<canvas id="pieChart" width="300" height="300"> </canvas>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</section>
			<!-- end of charts section -->
			<!-- Statistics section -->
			<section class="statistics">
				<div class="container-fluid">
					<div class="row d-flex">
						<div class="col-lg-4">
							<!-- Income-->
							<div class="card income text-center">
								<div class="icon"><i class="icon-line-chart"></i></div>
								<?php
                                    $sql = "SELECT sum(paid) as totalpaid FROM reserves";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        $totalpaid = $row['totalpaid'];      
                                    }
                                ?>
								<div class="number">Kshs. <?php echo $totalpaid; ?></div><strong class="text-primary">All Transactions</strong>
									<p>Payments made through bookings by customers.</p>
								</div>
						</div>
						<div class="col-lg-4">
							<!-- Income-->
							<div class="card income text-center">
								<div class="icon"><i class="icon-user"></i></div>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from reserves where status='Booked'");
                                        $num_rows = $result->num_rows;
									?>
								<div class="number"> <?php echo $num_rows; ?> </div><strong class="text-primary">Passengers</strong>
									<p>All Customers that have travelled through our fleet.</p>
								</div>
						</div>
						<div class="col-lg-4">
							<!-- Income-->
							<div class="card income text-center">
								<div class="icon"><i class="icon-paper-airplane"></i></div>
									<?php
										$conn->select_db('BMIS');
										$result = $conn->query("Select * from bus where delete_status='0'");
                                        $num_rows = $result->num_rows;
									?>
								<div class="number"> <?php echo $num_rows; ?> </div><strong class="text-primary">Our Fleet</strong>
									<p>All fleet operating our preferred routes.</p>
								</div>
						</div>
					</div>
				</div>
			</section><br>
			<!-- Statistics Section-->
			<section class="statistics">
				<div class="container-fluid">
					<div class="row d-flex">
						<div class="col-lg-4">
							<!-- Income-->
							<div class="card income text-center">
								<div class="icon"><i class="icon-user"></i></div>
								<div class="number">54</div><strong class="text-primary">Our Staff</strong>
									<p>Our total staff operating the available fleet.</p>
								</div>
							</div>
							<div class="col-lg-4">
								<!-- Monthly Usage-->
								<div class="card data-usage">
									<h2 class="display h4">Server Usage</h2>
									<div class="row d-flex align-items-center">
										<div class="col-sm-6">
											<div id="progress-circle" class="d-flex align-items-center justify-content-center"></div>
										</div>
									<div class="col-sm-6"><strong class="text-primary">80.56 Gb</strong><small>Current Plan</small><span>100 Gb Monthly</span></div>
								</div>
								<p>Server status and storage transactions.</p>
							</div>
						</div>
						<div class="col-lg-4">
							<!-- User Actibity-->
							<div class="card user-activity">
								<h2 class="display h4">User Activity</h2>
								<div class="number">210</div>
								<h3 class="h4 display">Customer visits</h3>
								<div class="progress">
									<div role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
								</div>
								<div class="page-statistics d-flex justify-content-between">
									<div class="page-statistics-left"><span>Pages Visits</span><strong>230</strong></div>
									<div class="page-statistics-right"><span>New Visits</span><strong>73.4%</strong></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Updates Section -->
			<section class="mt-30px mb-30px">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4 col-md-12">
							<!-- Recent Updates Widget          -->
							<div id="new-updates" class="card updates recent-updated">
								<div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
									<h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">News Updates</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
								</div>
								<div id="updates-box" role="tabpanel" class="collapse show">
									<ul class="news list-unstyled">
										
									</ul>
								</div>
							</div>
						<!-- Recent Updates Widget End-->
						</div>
						<div class="col-lg-4 col-md-6">
							<!-- Daily Feed Widget-->
							<div id="daily-feeds" class="card updates daily-feeds">
								<div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
									<h2 class="h5 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Your daily Feeds </a></h2>
									<div class="right-column">
										<div class="badge badge-primary">10 new alerts</div><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box"><i class="fa fa-angle-down"></i></a>
									</div>
								</div>
								<div id="feeds-box" role="tabpanel" class="collapse show">
									<div class="feed-box">
										<ul class="feed-elements list-unstyled">
											<!-- List-->
											
										</ul>
									</div>
								</div>
							</div>
							<!-- Daily Feed Widget End-->
						</div>
						<div class="col-lg-4 col-md-6">
							<!-- Recent Activities Widget      -->
							<div id="recent-activities-wrapper" class="card updates activities">
								<div id="activites-header" class="card-header d-flex justify-content-between align-items-center">
									<h2 class="h5 display"><a data-toggle="collapse" data-parent="#recent-activities-wrapper" href="#activities-box" aria-expanded="true" aria-controls="activities-box">Recent Activities</a></h2><a data-toggle="collapse" data-parent="#recent-activities-wrapper" href="#activities-box" aria-expanded="true" aria-controls="activities-box"><i class="fa fa-angle-down"></i></a>
								</div>
								<div id="activities-box" role="tabpanel" class="collapse show">
									<ul class="activities list-unstyled">
										
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php include('admin-sections/footer.php'); ?>
  	</body>
</html>