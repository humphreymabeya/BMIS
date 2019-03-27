<?php
    include('../database/config.php');
    $route = '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Passenger Manifests | ENA Travels</title>
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
                        <li><a href="route.php"> <i class="fa fa-road"></i>Route Details</a></li>
                        <li><a href="#staff" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-group"></i>Staff </a>
                        <ul id="staff" class="collapse list-unstyled ">
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
                        <li class="active"> <a href="manifest.php"> <i class="fa fa-file-excel-o"> </i>Manifests</a></li>
                        <li><a href="#settings" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"></i>Settings </a>
                            <ul id="settings" class="collapse list-unstyled ">
                                <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>
                                <li><a href="#"><i class="fa fa-file-word-o"></i> Logs</a></li>
                                <li><a href="#"><i class="fa fa-globe"></i> Change Theme</a></li>
                            </ul>
                        </li>
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
                        <li class="breadcrumb-item active">Manifests</li>
                    </ul>
                </div>
            </div>
            <!-- form area -->
            <section class="forms">
                <div class="container-fluid">
                    <header>
                        <h1 class="page-head-line">Buses Information</h1>
                    </header>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h4>Search</h4>
                                </div>
                                <div class="card-body">
                                <form class="form-inline" role="form" id="searchform">
                                    <div class="form-group">
                                        <label for="busreg" class="sr-only">Bus Registration</label>
                                        <input id="bus" name="bus" type="text" placeholder="KCQ 111A" class="mr-4 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="traveldate" class="sr-only">Travel Date</label>
                                        <input type="text" placeholder="Travel Date" class="mr-4 form-control" id="traveldate" name="traveldate" >
                                    </div>
                                    <div class="form-group">
                                        <label for="route" class="sr-only">Route</label>
                                        <select  class="mr-4 form-control" id="route" name="route">
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
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success mr-3" id="find" > Search </button>
                                        <button type="reset" class="btn btn-danger mr-3" id="clear" > Clear </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                <h4>Manage Buses</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-sorting table-responsive" id="subjectresult">
                                    <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                        <thead>
                                                <tr>
                                                
                                                    <th>Bus Reg No/Type</th>                                            
                                                    <th>Route</th>
                                                    <th>Travel Date</th>
                                                    <th>Departure Time</th>
                                                    <th>Action</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('admin-sections/footer.php');?>
            <!-- jquery -->
            <script type="text/javascript">
                $(document).ready( function() {	
                    $("#traveldate").datepicker({                           
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,
                        dateFormat: 'mm/yy',
                        onClose: function(dateText, inst) {
                            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
                        }
                    });

                    $("#traveldate").focus(function () {
                        $(".ui-datepicker-calendar").hide();
                        $("#ui-datepicker-div").position({
                            my: "center top",
                            at: "center bottom",
                            of: $(this)
                        });
                    });

                    // /*****************/
                    // $('#bus').autocomplete({
                    //     source: function( request, response ) {
                    //         $.ajax({
                    //             url : 'data-tables/ajax.php',
                    //             dataType: "json",
                    //             data: {
                    //                 name_startsWith: request.term,
                    //                 type: 'busname'
                    //             },
                    //             success: function( data ) {                               
                    //                 response( $.map( data, function( item ) {                                   
                    //                     return {
                    //                         label: item,
                    //                         value: item
                    //                     }
                    //                 }));
                    //             }                      
                    //         });
                    //     }
		            // });
                    $('#find').click(function () {
                        mydatatable();
                    });
                    $('#clear').click(function () {
                        $('#searchform')[0].reset();
                        mydatatable();
                    });
                                    
                    function mydatatable()
                    {
                        $("#subjectresult").html('<table class="table table-striped table-bordered table-hover" id="tSortable22"><thead><tr><th>Bus Reg No/Type</th><th>Route</th><th>Travel Date</th><th>Departure Time</th><th>Action</th></tr></thead><tbody></tbody></table>');                              
                        $("#tSortable22").dataTable({
                            'sPaginationType' : 'full_numbers',
                            "bLengthChange": false,
                            "bFilter": false,
                            "bInfo": false,
                            'bProcessing' : true,
                            'bServerSide': true,
                            'sAjaxSource': "data-tables/datatable.php?"+$('#searchform').serialize()+"&type=bussearch",
                            'aoColumnDefs': [{
                                'bSortable': false,
                                'aTargets': [-1] /* 1st one, start by the right */
                            }]
                        });
                    }
		
                    ////////////////////////////
                    $("#tSortable22").dataTable({                                         
                        'sPaginationType' : 'full_numbers',
                        "bLengthChange": false,
                        "bFilter": false,
                        "bInfo": false,                       
                        'bProcessing' : true,
                        'bServerSide': true,
                        'sAjaxSource': "data-tables/datatable.php?type=bussearch",                                          
                        'aoColumnDefs': [{
                            'bSortable': false,
                            'aTargets': [-1] /* 1st one, start by the right */
                        }]
                    });
	                                
                });

                function GetManifest(bid)
                {
                    $.ajax({
                        type: 'post',
                        url: 'getmanifest.php',
                        data: {bus:bid,req:'1'},
                        success: function (data) {
                            $('#formcontent').html(data);
                            $("#myModal").modal({backdrop: "static"});
                        }
                    });
                }
            </script>
            <!-- modal class -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Take Fee</h4>
                        </div>
                        <div class="modal-body" id="formcontent">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>	  
        </div>
    </body>
</html>