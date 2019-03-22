<?php
    include('../database/config.php');
    $errormsg = '';
    $action = "add";
    $origin = $destination = $price = $routename = '';
    $id = '';
    if(isset($_POST['save'])){
        $origin = mysqli_real_escape_string($conn, $_POST['origin']);
        $destination = mysqli_real_escape_string($conn, $_POST['destination']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $routename = mysqli_real_escape_string($conn, $_POST['routename']);
        if($_POST['action'] == "add"){
            $sql = $conn->query("INSERT into route (origin, destination, price, routename) VALUES('$origin', '$destination', '$price', '$routename')");
            echo '<script type="text/javascript">window.location="route.php?act=add";</script>';
        }elseif ($_POST['action'] == "update") {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $sql = $conn->query("UPDATE  route SET origin = '$origin', destination = '$destination', price = '$price', routename = '$routename' WHERE id = '$id'");
            echo '<script type="text/javascript">window.location="route.php?act=update";</script>';
        }
    }
    if(isset($_GET['action']) && $_GET['action']=="delete"){
		$conn->query("UPDATE  route set delete_status = '1'  WHERE id='".$_GET['id']."'");
		header("location: route.php?act=delete");
    }
    $action = 'add';
    if(isset($_GET['action']) && ($_GET['action']) == "edit"){
        $id = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
        $sqlEdit = $conn->query("SELECT * FROM route WHERE id = '".$id."'");
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
		$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Route Added successfully</div>";
	}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="update")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> Route Updated successfully</div>";
	}
	else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="delete")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Route deleted successfully</div>";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Routes | ENA Travels</title>
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
                    <li><a href="bus.php"><i class="fa fa-bus"></i>Bus Management</a></li>
                    <li class="active"><a href="route.php"> <i class="fa fa-road"></i>Route Details</a></li>
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
                    <li class="breadcrumb-item active">Routes</li>
                </ul>
            </div>
        </div>
        <!-- form area -->
        <section class="forms">
            <div class="container-fluid">
                <header>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-head-line">Routes Information 
                                <?php
                                    echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
                                    ' <a href="route.php" class="btn btn-primary btn-sm pull-right">Back <i class="fa fa-arrow-right"></i></a>':'<a href="route.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add </a>';
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
                                <h4><?php echo ($action=="add")? "Add Route": "Edit Route"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal needs-validation" role="form" action="route.php" id="signupForm1" method="POST" novalidate>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Start Point:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="origin" class="form-control" id="origin" value="<?php echo $origin; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Departure Station
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Destination:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="destination" class="form-control" id="destination" value="<?php echo $destination; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Arrival Station
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Price:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" id="price" value="<?php echo $price; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Route Price
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Route Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="routename" placeholder="Startpoint-Endpoint" class="form-control" id="routename" value="<?php echo $routename; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Route Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 offset-sm-2">
                                            <a href="route.php" class="btn btn-secondary">Cancel</a>
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
                        <h4>Manage Routes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-sorting table-hover">
                            <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Price</th>
                                        <th>Route Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- php code -->
                                    <?php
                                        $sql = "SELECT * FROM route WHERE delete_status = '0'";
                                        $a = $conn->query($sql);
                                        while($result = $a->fetch_assoc()){
                                            echo '<tr>
                                                <td>'.$result['id'].'</td>
                                                <td>'.$result['origin'].'</td>
                                                <td>'.$result['destination'].'</td>
                                                <td>'.$result['price'].'</td>
                                                <td>'.$result['routename'].'</td>
                                                <td>
                                                <a href="route.php?action=edit&id='.$result['id'].'" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>Edit</a>
                                                <a onclick="return confirm(\'Are you sure you want to delete this record\');" href="route.php?action=delete&id='.$result['id'].'" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span>Delete</a> </td>
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
    </body>
</html>