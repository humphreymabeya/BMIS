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
            <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong>E</strong><strong class="text-primary">T</strong><strong class="text-primary">C</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">                  
                <li class="active"><a href="index.php"> <i class="icon-home"></i>Home</a></li>
                <li class><a href="bus.php"><i class="fa fa-bus"></i>Bus Management</a></li>
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
                <li><a href="#settings" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"></i>Settings </a>
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
