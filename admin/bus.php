<?php
    include('../database/config.php');
    $errormsg = '';
    $action = "add";
    $id = '';
    $bustype = $busregno = $capacity = $available = $route =  $traveldate = $departure = $arrival = '';

    if(isset($_POST['save'])){
        $busregno = mysqli_real_escape_string($conn, $_POST['busregno']);
        $bustype = mysqli_real_escape_string($conn, $_POST['bustype']);
        $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
        $available = mysqli_real_escape_string($conn, $_POST['available']);
        $route = mysqli_real_escape_string($conn, $_POST['route']);
        $traveldate = mysqli_real_escape_string($conn, $_POST['traveldate']);
        $departure = mysqli_real_escape_string($conn, $_POST['departure']);
        $arrival = mysqli_real_escape_string($conn, $_POST['arrival']);
        // feed to database
        if($_POST['action'] == "add"){
            $sql = $conn->query("INSERT into bus (busregno, bustype, capacity, available, route, traveldate, departure, arrival) VALUES('$busregno', '$bustype', '$capacity', '$available', '$route', '$traveldate', '$departure', '$arrival')");
            echo '<script type="text/javascript">window.location="bus.php?act=add";</script>';
        }elseif ($_POST['action'] == "update") {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $sql = $conn->query("UPDATE  bus SET busregno = '$busregno', bustype = '$bustype', capacity = '$capacity', available = '$available', traveldate = '$traveldate', arrival = '$arrival', departure = '$departure', route = '$route' WHERE id = '$id'");
            echo '<script type="text/javascript">window.location="bus.php?act=update";</script>';
        }
    }
    if(isset($_GET['action']) && $_GET['action']=="delete"){
		$conn->query("UPDATE  bus set delete_status = '1'  WHERE id='".$_GET['id']."'");
		header("location: bus.php?act=delete");
    }
    $action = 'add';
    if(isset($_GET['action']) && ($_GET['action']) == "edit"){
        $id = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
        $sqlEdit = $conn->query("SELECT * FROM bus WHERE id = '".$id."'");
        if($sqlEdit->num_rows){
            $rowsEdit = $sqlEdit->fetch_assoc();
            extract($rowsEdit);
            $action = "update";
        }else{
            $_GET['action'] = "";
        }
    }
    if(isset($_REQUEST['act']) && @$_REQUEST['act']=="add")
	{
		$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Bus Added successfully</div>";
	}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="update")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> Bus Updated successfully</div>";
	}
	else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="delete")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Bus deleted successfully</div>";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Buses | ENA Travels</title>
        <?php include('admin-sections/header.php'); ?>
    </head>
    <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                <div class="sidenav-header-inner text-center"><img src="../assets/img/avatar-12.jpg" alt="person" class="img-fluid rounded-circle">
                    <h2 class="h5">Mabeya Humphrey</h2><span>Web Developer</span>
                </div>
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong>E</strong><strong class="text-primary">T</strong><strong class="text-primary">C</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <h5 class="sidenav-heading">Main</h5>
                <ul id="side-main-menu" class="side-menu list-unstyled">                  
                    <li><a href="index.php"> <i class="icon-home"></i>Home</a></li>
                    <!-- <li><a href="forms.html"> <i class="icon-form"></i>Forms</a></li> -->
                    <li class="active"><a href="bus.php"><i class="fa fa-bus"></i>Bus Management</a></li>
                    <li><a href="route.php"> <i class="fa fa-road"></i>Route Details</a></li>
                    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-group"></i>Staff </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="#"><i class="fa fa-user"></i> Drivers</a></li>
                        <li><a href="#"><i class="fa fa-users"></i> Assistants</a></li>
                        <li><a href="#"><i class="fa fa-user"></i> Office Staff</a></li>
                    </ul>
                    </li>
                    <!-- <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page                             </a></li> -->
                    <!-- <li> <a href="#"> <i class="icon-mail"></i>Demo -->
                        <!-- <div class="badge badge-warning">6 New</div></a></li> -->
                </ul>
            </div>
            <div class="admin-menu">
                <h5 class="sidenav-heading">Secondary menu</h5>
                <ul id="side-admin-menu" class="side-menu list-unstyled"> 
                    <li><a href="#settings" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"></i>Settings </a>
                        <ul id="settings" class="collapse list-unstyled ">
                            <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li><a href="#"><i class="fa fa-file-word-o"></i> Logs</a></li>
                            <li><a href="#"><i class="fa fa-globe"></i> Change Theme</a></li>
                        </ul>
                    </li>
                    <li> <a href=""> <i class="fa fa-file-excel-o"> </i>Manifests</a></li>
                    <li> <a href=""> <i class="fa fa-file-image-o"> </i>Gallery</a></li>
                    <li> <a href=""> <i class="fa fa-times-circle-o"> </i>Cancellations</a></li>
                    <li> <a href=""> <i class="fa fa-list-alt"> </i>Booking Details</a></li>
                    <li> <a href=""> <i class="fa fa-ticket"> </i>Seat Layouts</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <?php include('admin-sections/navbar2.php'); ?>
         <!-- Breadcrumb -->
        <div class="breadcrumb-holder">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Buses</li>
                </ul>
            </div>
        </div>
        <!-- form area -->
        <section class="forms">
            <div class="container-fluid">
                <header>
                    <!-- <h1 class="h3 display">Buses Information</h1> -->
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-head-line">Buses Information 
                                <?php
                                    echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
                                    ' <a href="bus.php" class="btn btn-primary btn-sm pull-right">Back <i class="fa fa-arrow-right"></i></a>':'<a href="bus.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add </a>';
                                ?>
                            </h1>
                        
                            <?php
                                echo $errormsg;
                            ?>
                        </div>
                    </div>
                </header>
                <?php 
                    if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
                    {
				?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4><?php echo ($action=="add")? "Add Bus": "Edit Bus"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal needs-validation" role="form" action="bus.php" id="signupForm1" method="POST" novalidate>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Registration No:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="busregno" class="form-control" id="busregno" value="<?php echo $busregno; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                            Please Provide a valid Registration Number
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Bus Type</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="bustype" placeholder="Input 'Business' or 'Executive'" class="form-control" id="bustype" value="<?php echo $bustype; ?>" required/>
                                        <div class="valid-feedback">
                                                
                                        </div>
                                        <div class="invalid-feedback">
                                            Please Add the required Bus type
                                        </div>
                                            <!-- <select name="bustype" id="bustype" class="form-control" value="">
                                                <option value=''>--Select Type--</option>
                                                <option value='Business'>Business</option>
                                                <option value='Executive'>Executive</option>	
                                            </select> -->
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Capacity:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="capacity" class="form-control" id="capacity" value="<?php echo $capacity; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Add Bus Capacity
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Available:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="available" class="form-control" id="available" value="<?php echo $available; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                               Please Add Available Seats
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
										<label class="col-form-label col-sm-2" >Route: </label>
										<div class="col-sm-10">
										
                                            <select  class="form-control" id="route" name="route">
												<option value="" >--Select route--</option>
												<?php
													$sql = "select * from route where delete_status='0'";
													$q = $conn->query($sql);
															
													while($res = $q->fetch_assoc())
														{
														echo '<option value="'.$res['id'].'"  '.(($route==$res['id'])?'selected="selected"':'').'>'.$res['routename'].'</option>';
													}
												?>									
										
											</select>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Date:</label>
                                        <div class="col-sm-10 input-group">
                                            <input data-date-format="dd-mm-yyyy" class="form-control" id="traveldate" name="traveldate" value="<?php echo  ($traveldate!='')?date("Y-m-d", strtotime($traveldate)):'';?>" readonly />
                                            <div class="input-group-append">
                                                <span class="fa fa-calendar input-group-text traveldate" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Departure:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="departure" class="form-control" id="departure" value="<?php echo $departure; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Departure Time
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Arrival:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="arrival" class="form-control" id="arrival" value="<?php echo $arrival; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Arrival Time
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 offset-sm-2">
                                            <a href="bus.php" class="btn btn-secondary">Cancel</a>
                                            <input type="hidden" name="id" value="<?php echo $id;?>">
											<input type="hidden" name="action" value="<?php echo $action;?>">
                                            <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
				    } else {
                ?>
                
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Manage Buses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-sorting">
                            <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bus Reg No</th>
                                        <th>Route</th>
                                        <th>Bus Type</th>
                                        <th>Capacity</th>
                                        <th>Available</th>
                                        <th>Date</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- php code -->
                                    <?php
                                        $sql = "SELECT bus.id, bus.busregno, route.routename, bus.bustype, bus.capacity, bus.available, bus.traveldate, bus.departure, bus.arrival FROM bus INNER JOIN route ON bus.route=route.id WHERE bus.delete_status = '0'";
                                        $a = $conn->query($sql);
                                        while($result = $a->fetch_assoc()){
                                            echo '<tr>
                                                <td>'.$result['id'].'</td>
                                                <td>'.$result['busregno'].'</td>
                                                <td>'.$result['routename'].'</td>
                                                <td>'.$result['bustype'].'</td>
                                                <td>'.$result['capacity'].'</td>
                                                <td>'.$result['available'].'</td>
                                                <td>'.$result['traveldate'].'</td>
                                                <td>'.$result['departure'].'</td>
                                                <td>'.$result['arrival'].'</td>
                                                <td>
                                                <a href="bus.php?action=edit&id='.$result['id'].'" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>Edit</a>
                                                <a onclick="return confirm(\'Are you sure you want to delete this record\');" href="bus.php?action=delete&id='.$result['id'].'" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span>Delete</a> </td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#tSortable22').dataTable({
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": true 
                            });				
                        });
                    </script>                    
                </div>
            </div>
            <?php
                }
            ?>
        </section>
        <?php include('admin-sections/footer.php'); ?>
        <script type="text/javascript">
            $('#traveldate').datepicker({
                weekStart: 0,
                daysOfWeekHighlighted: "6,0",
                autoclose: true,
                todayHighlight: true,
            });
            $('#traveldate').datepicker("setDate", new Date());
            // form validation
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>