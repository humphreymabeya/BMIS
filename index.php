<?php
    include('database/config.php');
    $traveldate = $route = $action = $id = '';
?>
<!DOCTYPE html>
	<html lang="en" class="no-js">
		<head>
			 <!-- Favicon-->
			<link rel="shortcut icon" href="assets/img/favicon.ico">
			<title>ENA Travels | Welcome</title>
    		<?php include("sections/header.php");?>
			
		</head>
		<body>	
			<!-- navbar -->
			<?php include("sections/navbar.php");?>
			<!-- start banner Area -->
			<section class="banner-area relative">
				<div class="overlay overlay-bg"></div>				
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-between">
						<div class="col-lg-6 col-md-6 banner-left">
							<h4 class="text-white">ENA TRAVEL COMPANY</h4>
							<h1 class="text-white">Travel in Style</h1>
							<p class="text-white">
								If you are looking for class, comfort and pleasure, Book your Ticket Now for as low as Ksh. 800
							</p>
							<a href="#top-sect" class="btn btn-success text-uppercase">Get Started</a>
						</div>
						<div class="col-lg-4 col-md-6 banner-right" id="booking">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book" aria-selected="true">Book Now</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="print-tab" data-toggle="tab" href="#print" role="tab" aria-controls="print" aria-selected="false">Print</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancel</a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent">
							  	<div class="tab-pane fade show active" id="book" role="tabpanel" aria-labelledby="book-tab">
									<form class="form-wrap" method="POST" action="selectbus.php">
										<div class="form-row">
                                    		<div class="form-group col-12">
                                            	<select class="form-control" id="routename" name="routename">
                                                	<option value="">--Select Route--</option>
													<?php
														$sql = "SELECT * from route where delete_status='0' order by route.id asc";
														$q = $conn->query($sql);
														while($r = $q->fetch_assoc()){
															echo '<option value="'.$r['id'].'"  '.(($route==$r['id'])?'selected="selected"':'').'>'.$r['routename'].'</option>';
														}
													?>
                                            	</select>
                                        	</div>
                                    
                                    		<div class="form-group col-12">
                                        		<input data-date-format="yyyy-mm-dd" class="form-control" placeholder="Travel Date" id="traveldate" name="traveldate" value="<?php echo  ($traveldate!='')?date("Y-m-d", strtotime($traveldate)):'';?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Travel Date '" readonly/>
                                    		</div>
                                    		<div class="form-group col-12">
                                        		<input type="hidden" name="id" value="<?php echo $id;?>">
												<input type="hidden" name="action" value="<?php echo $action;?>">
                                        		<button type="submit" name="save" class="btn btn-block btn-primary text-uppercase">Search Buses</button>
                                    		</div>
                                		</div>								
									</form>
								</div>
								<div class="tab-pane fade" id="print" role="tabpanel" aria-labelledby="print-tab">
									<form class="form-wrap needs-validation" role="form" action="printTicket.php" method="POST" novalidate>
										<div class="form-row">
											<div class="form-group col-12">
												<input type="text" class="form-control" name="ticketId" placeholder="Ticket ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'TicketID '" >									
												<div class="valid-feedback"></div>
												<div class="invalid-feedback">Please Provide a valid Ticket ID</div>
											</div>
											<div class="form-group col-12">	
												<input type="text" class="form-control" name="mobileNo" placeholder="Mobile Number " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number'">
												<div class="valid-feedback"></div>
												<div class="invalid-feedback">Please Provide a valid Mobile Number</div>
											</div>	
											<div class="form-group col-12">
												<button type="submit" name="print" class="btn btn-block btn-primary text-uppercase">Print Ticket</button>	
											</div>
										</div>								
									</form>							  	
								</div>
								<div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
									<form class="form-wrap" role="form" method="POST" action="cancelTicket.php">
										<div class="form-row">
											<div class="form-group col-12">
												<input type="text" class="form-control" name="ticketId" placeholder="Ticket ID " onfocus="this.placeholder = ''" onblur="this.placeholder = 'TicketID '">									
											</div>
											<div class="form-group col-12">	
												<input type="text" class="form-control" name="mobileNo" placeholder="Mobile Number " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number'">
											</div>	
											<div class="form-group col-12">
												<button type="submit" name="cancel" class="btn btn-block btn-primary text-uppercase">Cancel Ticket</button>	
											</div>
										</div>											
									</form>							  	
								</div>
							</div>
						</div>
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start popular-destination Area -->
			<section class="popular-destination-area section-gap" id="destinations">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-8">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Popular Destinations</h1>
		                        <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, day.</p>
		                    </div>
		                </div>
		            </div>						
					<div class="row">
						<div class="col-lg-4 wow fadeInDown">
							<div class="single-destination relative">
								<div class="thumb relative">
									<div class="overlay overlay-bg"></div>
									<img class="img-fluid" src="../assets/img/d1.jpg" style="height:200px;" alt="">
								</div>
								<div class="desc">	
									
									<h4>Nairobi</h4>
									<p>Kenya</p>			
								</div>
							</div>
						</div>
						<div class="col-lg-4 wow fadeInUp">
							<div class="single-destination relative">
								<div class="thumb relative">
									<div class="overlay overlay-bg"></div>
									<img class="img-fluid" src="../assets/img/d2.jpg" style="height:200px;"  alt="">
								</div>
								<div class="desc">	
									
									<h4>Mombasa</h4>
									<p>Kenya</p>			
								</div>
							</div>
						</div>
						<div class="col-lg-4 wow fadeInDown">
							<div class="single-destination relative">
								<div class="thumb relative">
									<div class="overlay overlay-bg"></div>
									<img class="img-fluid" src="../assets/img/d3.jpg" style="height:200px;"  alt="">
								</div>
								<div class="desc">	
									
									<h4>Kisumu</h4>
									<p>Kenya</p>			
								</div>
							</div>
						</div>												
					</div>
				</div>	
			</section>
			<!-- End popular-destination Area -->
			

			<!-- Start price Area -->
			<section class="price-area section-gap" id="fare-sect">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-8">
		                    <div class="title text-center">
		                        <h1 class="mb-10">We Provide Affordable Prices to all our Routes</h1>
		                        <p>Providing exemplary, comfortable and satisying travel services.</p>
		                    </div>
		                </div>
		            </div>						
					<div class="row">
						<div class="col-lg-4">
							<div class="single-price">
								<h4>Business Class</h4>
								<ul class="price-list">
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Mombasa</span>
										<a href="#" class="price-btn">Ksh. 1000</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Kisumu</span>
										<a href="#" class="price-btn">Ksh. 1200</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Migori</span>
										<a href="#" class="price-btn">Ksh. 800</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Kisii</span>
										<a href="#" class="price-btn">Ksh. 800</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Sirare</span>
										<a href="#" class="price-btn">Ksh. 800</a>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - HomaBay</span>
										<a href="#" class="price-btn">Ksh. 1000</a>
									</li>														
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-price">
								<h4>Business Class</h4>
								<ul class="price-list">
									<li class="d-flex justify-content-between align-items-center">
										<span>Mombasa- Sirare</span>
										<a href="#" class="price-btn">Ksh. 1600</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Mombasa - Migori</span>
										<a href="#" class="price-btn">Ksh. 1600</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Mombasa - Kisumu</span>
										<a href="#" class="price-btn">Ksh. 1800</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Mombasa - Siaya</span>
										<a href="#" class="price-btn">Ksh. 1800</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Siaya</span>
										<a href="#" class="price-btn">Ksh. 1500</a>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Bondo</span>
										<a href="#" class="price-btn">Ksh. 1200</a>
									</li>														
								</ul>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-price">
								<h4>Business Class</h4>
								<ul class="price-list">
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Kakamega</span>
										<a href="#" class="price-btn">Ksh. 1200</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Eldoret</span>
										<a href="#" class="price-btn">Ksh. 800</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Kitale</span>
										<a href="#" class="price-btn">Ksh. 1000</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Bungoma</span>
										<a href="#" class="price-btn">Ksh. 1200</a>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<span>Nairobi - Busia</span>
										<a href="#" class="price-btn">Ksh. 1500</a>
									</li>	
									<li class="d-flex justify-content-between align-items-center">
										<span>Mombasa - Kitale</span>
										<a href="#" class="price-btn">Ksh. 2000</a>
									</li>														
								</ul>
							</div>
						</div>												
					</div>
				</div>	
			</section>
			<!-- End price Area -->
			

			<!-- Start other-issue Area -->
			<section class="other-issue-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-9">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Services we offer</h1>
		                        <p>We all live in an age that belongs to the young at heart. Life that is.</p>
		                    </div>
		                </div>
		            </div>					
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="single-other-issue">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania2.jpg" style="height:155px;" alt="">					
								</div>
								<a href="#">
									<h4>Hire a Bus</h4>
								</a>
								<p>
									We can assist you to get to your preffered destinations at comfort in large numbers by chattering our fleet at affordable prices.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-other-issue">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania12.jpeg" style="height:155px;" alt="">					
								</div>
								<a href="#">
									<h4>Bus Booking</h4>
								</a>
								<p>
									Make a booking anytime, anywhere at the best of your comfort with your device and travel with us.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-other-issue">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/fleet2.jpeg" style="height:155px;" alt="">					
								</div>
								<a href="#">
									<h4>Shuttle Services</h4>
								</a>
								<p>
									In a hurry to get to your destination? Missed a ticket in our buses, shuttle services are available at any moment.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-other-issue">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/mail.jpg"  style="height:155px;" alt="">					
								</div>
								<a href="#">
									<h4>Mail Services</h4>
								</a>
								<p>
									With our diverse routes, feel free to send your parcels with us and be ensured of safe and timely deliveries.
								</p>
							</div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End other-issue Area -->
			

			<!-- Start testimonial Area -->
		    <section class="testimonial-area section-gap">
		        <div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-8">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Testimonial from our Clients</h1>
		                        <p>Making your travel enjoyable and with comfort is our priority </p>
		                    </div>
		                </div>
		            </div>
		            <div class="row">
		                <div class="active-testimonial">
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user1.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
		                                I enjoyed my travel with your Bus from Nairobi to Mombasa, all the services were above board.		     
		                            </p>
		                            <h4>Harriet Mwikali</h4>
	                            	<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>				
									</div>	
		                        </div>
		                    </div>
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user2.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
									I enjoyed my travel with your Bus from Nairobi to Mombasa, all the services were above board.
		                            </p>
		                            <h4>Carolyn Macharia</h4>
	                           		<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>			
									</div>	
		                        </div>
		                    </div>
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user1.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
									I enjoyed my travel with your Bus from Nairobi to Mombasa, all the services were above board.     
		                            </p>
		                            <h4>Maxwell</h4>
	                            	<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>				
									</div>	
		                        </div>
		                    </div>
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user2.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
									I enjoyed my travel with your Bus from Nairobi to Kisumu, all the services were above board.
		                            </p>
		                            <h4>Craig Otieno</h4>
	                           		<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>			
									</div>	
		                        </div>
		                    </div>
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user1.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
										I enjoyed my travel with your Bus from Nairobi to Mombasa, all the services were above board.
		                            </p>
		                            <h4>Bernard Kamau</h4>
	                            	<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>				
									</div>	
		                        </div>
		                    </div>
		                    <div class="single-testimonial item d-flex flex-row">
		                        <div class="thumb">
		                            <img class="img-fluid" src="assets/img/elements/user2.png" alt="">
		                        </div>
		                        <div class="desc">
		                            <p>
										I enjoyed my travel with your Bus from Nairobi to Mombasa, all the services were above board.
		                            </p>
		                            <h4>Miriam Kerubo</h4>
	                           		<div class="star">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>			
									</div>	
		                        </div>
		                    </div>		                    		                    
		                </div>
		            </div>
		        </div>
		    </section>
		    <!-- End testimonial Area -->

			<!-- Start home-about Area -->
			<section class="home-about-area">
				<div class="container-fluid">
					<div class="row align-items-center justify-content-end">
						<div class="col-lg-6 col-md-12 home-about-left">
							<h1>
								Did you enjoy your travel? <br>
								Feel free to talk to us. <br>
								We‘ll strive to make it more enjoyable for you
							</h1>
							<p>
								with our aim being exemplary travelling at the best of comfort, feel free to make suggestions or complains about the services we offer.
							</p>
							<a href="#" class="primary-btn text-uppercase">raise complains</a>
						</div>
						<div class="col-lg-6 col-md-12 home-about-right no-padding">
							<img class="img-fluid" src="assets/img/scania6.JPG" alt="">
						</div>
					</div>
				</div>	
			</section>
			<!-- End home-about Area -->
			
	
			<!-- Start gallery Area -->
			<section class="recent-blog-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-9" id="gallery">
							<div class="title text-center">
								<h1 class="mb-10">Our fleet gallery</h1>
								<p>With the exceptional fleet at our disposal, have a look at the classy buses we got for our esteemed customers.</p>
							</div>
						</div>
					</div>							
					<div class="row">
						<div class="active-recent-blog-carusel">
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania7.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Nairobi - Migori</h4></a>
									<p>
										To our esteemed customers for this route, we got you covered.
									</p>
									<h6 class="date">Daily trips</h6>
								</div>	
							</div>
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania9.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Nairobi - Mombasa</h4></a>
									<p>
										To our esteemed customers for this route, we got you covered
									</p>
									<h6 class="date">06st May,2019</h6>
								</div>	
							</div>
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania3.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Nairobi - Kisumu</h4></a>
									<p>
										To our esteemed customers for this route, we got you covered
									</p>
									<h6 class="date">3rd May,2019</h6>
								</div>	
							</div>	
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania10.jpeg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Mombasa - Nairobi</h4></a>
									<p>
										To our esteemed customers for this route, we got you covered
									</p>
									<h6 class="date">4th May,2019</h6>
								</div>	
							</div>
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania5.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Nairobi - Kakamega</h4></a>
									<p>
									To our esteemed customers for this route, we got you covered
									</p>
									<h6 class="date">30th April,2019</h6>
								</div>	
							</div>
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/layout1.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">How our interior looks</h4></a>
									<p>
										With our interactive seat selection map, choose your favorite seat to enjoy a superb ride
									</p>
									<h6 class="date">Comfort is our priority</h6>
								</div>	
							</div>	
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/layout3.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">How our interior looks</h4></a>
									<p>
										With our interactive seat selection map, choose your favorite seat to enjoy a superb ride
									</p>
									<h6 class="date">Comfort is our priority</h6>
								</div>	
							</div>
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/scania6.JPG" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Main Offices</h4></a>
									<p>
										With our interactive seat selection map, choose your favorite seat to enjoy a superb ride
									</p>
									<h6 class="date">Comfort is our priority</h6>
								</div>	
							</div>		
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/layout2.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">How our interior looks</h4></a>
									<p>
										With our interactive seat selection map, choose your favorite seat to enjoy a superb ride
									</p>
									<h6 class="date">Comfort is our priority</h6>
								</div>	
							</div>														
							<div class="single-recent-blog-post item">
								<div class="thumb">
									<img class="img-fluid" src="assets/img/fleet4.jpg" style="height:260px;" alt="">
								</div>
								<div class="details">
									<div class="tags">
										<ul>
											<li>
												<a href="#">Travel</a>
											</li>
											<li>
												<a href="#">Comfort</a>
											</li>											
										</ul>
									</div>
									<a href="#"><h4 class="title">Nairobi - Kitale</h4></a>
									<p>
									To our esteemed customers for this route, we got you covered
									</p>
									<h6 class="date">10th May,2019</h6>
								</div>	
							</div>
						</div>
					</div>
				</div>	
			</section>
			<!-- End recent-blog Area -->			

			<!-- start footer Area -->		
			<?php include ("sections/footer1.php"); ?>
			<!-- End footer Area -->	
			<?php include ("sections/footer2.php"); ?>
			<script type="text/javascript">
				$('#traveldate').datepicker({
					weekStart: 0,
					daysOfWeekHighlighted: "6,0",
					autoclose: true,
					todayHighlight: true,
					orientation: "bottom",
					startDate: '-0d',
				});
				// $('#traveldate').datepicker("setDate", new Date());
			</script>
		</body>
	</html>