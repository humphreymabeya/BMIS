<?php
    include('database/config.php');
    $traveldate = $route = $action = $id = '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>ENA Travels | Book Now</title>
    <?php include("sections/header.php");?>
</head>
<body>
    <?php include("sections/navbar.php");?><br/><br/>
    <div class="container section-1-container section-container">
        <section>
            <!-- <h3>Book Online Here</h3> -->
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">
                            Select Route
                        </div>
                        <div class="card-body text-secondary">
                            <form role="form" method="POST" action="booking.php">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
                                            </div>
                                            <select class="form-control" id="routename" name="routename">
                                                <option value="">--Choose Route--</option>
                                                <?php
                                                    $sql = "SELECT * from route where delete_status='0' order by route.routename asc";
                                                    $q = $conn->query($sql);
                                                    while($r = $q->fetch_assoc()){
                                                        echo '<option value="'.$r['id'].'"  '.(($route==$r['id'])?'selected="selected"':'').'>'.$r['routename'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 input-group">
                                        <div class="input-group-prepend">
                                            <span class="fa fa-calendar input-group-text traveldate" aria-hidden="true"></span>
                                        </div>
                                        <input data-date-format="dd-mm-yyyy" class="form-control" id="traveldate" name="traveldate" value="<?php echo  ($traveldate!='')?date("Y-m-d", strtotime($traveldate)):'';?>" readonly />
                                    </div>
                                    <div class="form-group col-12">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
										<input type="hidden" name="action" value="<?php echo $action;?>">
                                        <button type="submit" name="save" class="btn btn-primary">Find Buses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="container">
                <div class="card border-secondary">
                    <div class="card-header">
                        <h4>Available Buses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-sorting">
                            <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bus Registration No.</th>
                                        <th>Route</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Available</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['save'])){
                                            $route = mysqli_escape_string($conn, $_POST['routename']);
                                            $traveldate = mysqli_escape_string($conn, $_POST['traveldate']);

                                            $sql = "SELECT bus.id, bus.busregno, route.routename, bus.traveldate, bus.departure, bus.available, route.price FROM bus INNER JOIN route ON bus.route=route.id WHERE bus.traveldate = '".$traveldate."' AND bus.route = '".$route."' ";
                                            $a = $conn->query($sql);
                                            while($result = $a->fetch_assoc()){
                                                echo '<tr>
                                                <td>'.$result['id'].'</td>
                                                <td>'.$result['busregno'].'</td>
                                                <td>'.$result['routename'].'</td>
                                                <td>'.$result['traveldate'].'</td>
                                                <td>'.$result['departure'].'</td>
                                                <td><span class="badge badge-success">'.$result['available'].'</span></td>
                                                <td>Ksh.'.$result['price'].'</td>
                                                <td>
                                                    <a href="selectseat.php?id='.$result['id'].'" class="btn btn-primary btn-sm"><span class="fa fa-ticket"></span>Book Now</a>
                                                </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo "No Selection Made";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- footer -->
    <?php include ("sections/footer1.php"); ?>
    <?php include("sections/footer2.php");?>
    <!-- scripts -->
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