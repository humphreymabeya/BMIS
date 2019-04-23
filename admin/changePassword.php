<?php
    include('../database/config.php');
    include('../database/authenticate.php');
    $alert = $oldpass = $newpass = '';

    $sql = $conn->query("SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
    $data = $sql->fetch_assoc();
    if(isset($_POST['save'])){
        $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
        $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
        $sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
        $res = $conn->query($sql);
        if(password_verify($oldpass, $res->fetch_assoc()['password'])){
            $result = $conn->query("update users set password = '".password_hash($newpass, PASSWORD_DEFAULT)."' WHERE username = '".$_SESSION['username']."'");
            echo '<script type="text/javascript">window.location="changePassword.php?act=authenticate"; </script>';
        }else
		{
			$error = '<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Error!</strong> Wrong old password
			</div>';
		}
    }
    if(isset($_REQUEST['act']) && @$_REQUEST['act']=="authenticate")
	{
		$alert = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Password changed successfully</div>";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Authentication | ENA Travels</title>
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
                        <h2 class="h5">Mabeya Humphrey</h2><span>BMIS Developer</span>
                    </div>
                    <!-- Small Brand information, appears on minimized sidebar-->
                    <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong>E</strong><strong class="text-primary">T</strong><strong class="text-primary">C</strong></a></div>
                </div>
                <!-- Sidebar Navigation Menus-->
                <div class="main-menu">
                    <h5 class="sidenav-heading">Main</h5>
                    <ul id="side-main-menu" class="side-menu list-unstyled">                  
                        <li><a href="index.php"> <i class="icon-home"></i>Home</a></li>
                        <li><a href="bus.php"><i class="fa fa-bus"></i>Bus Management</a></li>
                        <li><a href="route.php"> <i class="fa fa-road"></i>Route Details</a></li>
                        <li><a href="#staff" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-group"></i>Staff </a>
                        <ul id="staff" class="collapse list-unstyled ">
                            <li><a href="staff/driver.php"><i class="fa fa-user"></i> Drivers</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> Assistants</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Office Staff</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>
                <div class="admin-menu">
                    <h5 class="sidenav-heading">Secondary menu</h5>
                    <ul id="side-admin-menu" class="side-menu list-unstyled"> 
                        <li> <a href="manifest.php"> <i class="fa fa-file-excel-o"> </i>Manifests</a></li>
                        <li> <a href=""> <i class="fa fa-times-circle-o"> </i>Cancellations</a></li>
                        <li class="active"><a href="#settings" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"></i>Settings </a>
                            <ul id="settings" class="collapse list-unstyled ">
                                <li><a href="changePassword.php"><i class="fa fa-lock"></i> Change Password</a></li>
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
            <?php include('admin-sections/navbar2.php'); ?>
            <!-- Breadcrumb -->
            <div class="breadcrumb-holder">
                <div class="container-fluid">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ul>
                </div>
            </div>
            <!-- form -->
            <section class="statistics">
                <div class="container-fluid">
                    <!-- Page Header-->
                    <header> 
                        <h1 class="h3 display">Change Password</h1>
                        <?php echo $alert; ?>
                    </header>
                    <div class="row d-flex">
                        <!-- account details -->
                        <div class="col-lg-4">
                            <div class="card income text-center">
                                <div class="card-body">
                                    <div class="icon"><i class="icon-user"></i></div><br>
                                    <div class="number">
                                        <h4 class="text-primary">
                                            Account type : Admin<br>
                                            Access Level: Level 3<br>
                                            User Name: <?php echo $data['username']; ?> <br>
                                            Email: <?php echo $data['email']; ?><br>
                                            Account Created at: <?php echo $data['created_at']; ?> <br>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h4>Edit Credentials</h4>
                                </div>
                                <div class="card-body">
                                <form class="form-horizontal" id="signupForm1" role="form" action="" method="POST">
                                    <div class="form-group row">
                                        <label class="col-sm-2">Current Password:</label>
                                        <div class="col-sm-10">
                                            <input id="oldpass" name="oldpass" type="password" placeholder="Old Password" class="form-control form-control-success">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2">New Password:</label>
                                        <div class="col-sm-10">
                                            <input id="newpass" name="newpass" type="password" placeholder="New Password" class="form-control form-control-success">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2">Confirm Password:</label>
                                        <div class="col-sm-10">
                                            <input id="confirmpass" name="confirmpass" type="password" placeholder="Confirm Password" class="form-control form-control-success">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 offset-sm-2">
                                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('admin-sections/footer.php'); ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#signupForm1").validate({
                        rules: {
                            oldpass: "required",
                            newpass: {
                                required: true,
                                minlength: 8,
                            },
                            confirmpass: {
                                required: true,
                                minlength: 8,
                                equalTo: "#newpass",
                            }
                        },
                        messages: {
                            oldpass: "Please provide your old password",
                            newpass: {
                                required: "Please provide a password",
						        minlength: "Your password must be at least 8 characters long"
                            },
                            confirmpass: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 8 characters long",
                                equalTo: "Please enter the same password as above"
                            }
                        },
                    });
                    setTimeout(function(){
                        $(".alert").fadeTo(700,0).slideUp(700, function(){
                            $(this).remove();
                        });
                    },2000);
                });
            </script>
        </div>
    </body>
</html>