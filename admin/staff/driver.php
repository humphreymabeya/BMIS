<?php
    include('../../database/config.php');
    include('../../database/authenticate.php');
    $errormsg = '';
    $action = "add";
    $dname = $idno = $lno = $mobile = $bus = '';
    $id = '';
    if(isset($_POST['save'])){
        $dname = mysqli_real_escape_string($conn, $_POST['dname']);
        $idno = mysqli_real_escape_string($conn, $_POST['idno']);
        $lno = mysqli_real_escape_string($conn, $_POST['lno']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $bus = mysqli_real_escape_string($conn, $_POST['bus']);
        if($_POST['action'] == "add"){
            $sql = $conn->query("INSERT into driver (dname, idno, lno, mobile, bus) VALUES('$dname', '$idno', '$lno', '$mobile', '$bus')");
            echo '<script type="text/javascript">window.location="driver.php?act=add";</script>';
        }elseif ($_POST['action'] == "update") {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $sql = $conn->query("UPDATE  driver SET dname = '$dname', idno = '$idno', lno = '$lno', mobile = '$mobile', bus = '$bus' WHERE id = '$id'");
            echo '<script type="text/javascript">window.location="driver.php?act=update";</script>';
        }
    }
    if(isset($_GET['action']) && $_GET['action']=="delete"){
		$conn->query("UPDATE  driver set delete_status = '1'  WHERE id='".$_GET['id']."'");
		header("location: driver.php?act=delete");
    }
    $action = 'add';
    if(isset($_GET['action']) && ($_GET['action']) == "edit"){
        $id = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
        $sqlEdit = $conn->query("SELECT * FROM driver WHERE id = '".$id."'");
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
		$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Driver Added successfully</div>";
	}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="update")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Success!</strong> Driver Updated successfully</div>";
	}
	else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="delete")
	{
		$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Driver deleted successfully</div>";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Drivers | ENA Travels</title>
        <?php include('../admin-sections/header.php'); ?>
    </head>
    <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                <div class="sidenav-header-inner text-center"><img src="../../assets/img/avatar-12.jpg" alt="person" class="img-fluid rounded-circle">
                    <h2 class="h5">Mabeya Humphrey</h2><span>BMIS Developer</span>
                </div>
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="../index.php" class="brand-small text-center"> <strong>E</strong><strong class="text-primary">T</strong><strong class="text-primary">C</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <h5 class="sidenav-heading">Main</h5>
                <ul id="side-main-menu" class="side-menu list-unstyled">                  
                    <li><a href="../index.php"> <i class="icon-home"></i>Home</a></li>
                    <li><a href="../bus.php"><i class="fa fa-bus"></i>Bus Management</a></li>
                    <li><a href="../route.php"> <i class="fa fa-road"></i>Route Details</a></li>
                    <li class="active"><a href="#staff" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-group"></i>Staff </a>
                    <ul id="staff" class="collapse list-unstyled ">
                        <li><a href="driver.php"><i class="fa fa-user"></i> Drivers</a></li>
                        <li><a href="#"><i class="fa fa-users"></i> Assistants</a></li>
                        <li><a href="#"><i class="fa fa-user"></i> Office Staff</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
            <div class="admin-menu">
                <h5 class="sidenav-heading">Secondary menu</h5>
                <ul id="side-admin-menu" class="side-menu list-unstyled"> 
                    <li> <a href="../manifest.php"> <i class="fa fa-file-excel-o"> </i>Manifests</a></li>
                    <li> <a href=""> <i class="fa fa-times-circle-o"> </i>Cancellations</a></li>
                    <li><a href="#settings" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"></i>Settings </a>
                        <ul id="settings" class="collapse list-unstyled ">
                            <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li><a href="#"><i class="fa fa-list"></i> Logs</a></li>
                            <li><a href="#"><i class="fa fa-globe"></i> Change Theme</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <?php include('../admin-sections/navbar2.php'); ?>
         <!-- Breadcrumb -->
        <div class="breadcrumb-holder">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active">Drivers</li>
                </ul>
            </div>
        </div>
        <!-- form area -->
        <section class="forms">
            <div class="container-fluid">
                <header>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-head-line">Drivers Information 
                                <?php
                                    echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
                                    ' <a href="driver.php" class="btn btn-primary btn-sm pull-right">Back <i class="fa fa-arrow-right"></i></a>':'<a href="driver.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add </a>';
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
                                <h4><?php echo ($action=="add")? "Add Driver": "Edit Driver"; ?></h4>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal needs-validation" role="form" action="driver.php" id="signupForm1" method="POST" novalidate>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="dname" class="form-control" id="dname" value="<?php echo $dname; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">ID Number:</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="idno" class="form-control" id="idno" value="<?php echo $idno; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Identification Number
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">License Number:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lno" class="form-control" id="lno" value="<?php echo $lno; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid License Number
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-2">Contact:</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="mobile" class="form-control" id="mobile" value="<?php echo $mobile; ?>" required/>
                                            <div class="valid-feedback">
                                                
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Provide a valid Mobile Number
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
										<label class="col-form-label col-sm-2" >Bus Allocated: </label>
										<div class="col-sm-10">
										
                                            <select  class="form-control" id="bus" name="bus">
												<option value="" >--Select bus--</option>
												<?php
													$sql = "select * from bus where delete_status='0'";
													$q = $conn->query($sql);
															
													while($res = $q->fetch_assoc())
														{
														echo '<option value="'.$res['id'].'"  '.(($bus==$res['id'])?'selected="selected"':'').'>'.$res['busregno'].'</option>';
													}
												?>									
										
											</select>
										</div>
									</div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 offset-sm-2">
                                            <a href="driver.php" class="btn btn-secondary">Cancel</a>
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
                        <h4>Manage Drivers</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-sorting">
                            <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>License Number</th>
                                        <th>Contact</th>
                                        <th>Allocated Bus</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- php code -->
                                    <?php
                                        // $sql = "SELECT * FROM driver WHERE delete_status = '0'";
                                        $sql = "SELECT driver.id, driver.dname, driver.idno, driver.lno, driver.mobile, bus.busregno FROM driver INNER JOIN bus ON driver.bus=bus.id WHERE driver.delete_status='0'";
                                        $a = $conn->query($sql);
                                        while($result = $a->fetch_assoc()){
                                            echo '<tr>
                                                <td>'.$result['id'].'</td>
                                                <td>'.$result['dname'].'</td>
                                                <td>'.$result['idno'].'</td>
                                                <td>'.$result['lno'].'</td>
                                                <td>'.$result['mobile'].'</td>
                                                <td>'.$result['busregno'].'</td>
                                                <td>
                                                <a href="driver.php?action=edit&id='.$result['id'].'" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>Edit</a>
                                                <a onclick="return confirm(\'Are you sure you want to delete this record\');" href="driver.php?action=delete&id='.$result['id'].'" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span>Delete</a> </td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                   
                </div>
            </div>
            <?php
                }
            ?>
        </section>
        <?php include('../admin-sections/footer.php'); ?>
        <script>
            $(document).ready(function () {
                $('#tSortable22').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": true 
                });	
                setTimeout(function(){
                    $(".alert").fadeTo(700,0).slideUp(700, function(){
                        $(this).remove();
                    });
                },2000);			
            });
        </script> 
    </body>
</html>