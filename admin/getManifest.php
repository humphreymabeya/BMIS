<?php
    include('../database/config.php');
    include('../database/authenticate.php');
    if(isset($_POST['req']) && $_POST['req'] == 1){
        $bid = (isset($_POST['bus']))?mysqli_real_escape_string($conn,$_POST['bus']):'';
        $sql = "SELECT seatnum, fullname, mobile, ticketID from reserves where bid = '".$bid."' order by reserves.seatnum ASC";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $sql = "select b.id,b.busregno,b.departure,b.arrival,r.routename,r.price, b.traveldate from bus as b,route as r where r.id=b.route  and b.id='".$bid."'";
            $res = $conn->query($sql);
            $sr = $res->fetch_assoc();

            echo '
                <h4>Bus Info</h4>
                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                    <th>Bus ID</th>
                        <td>'.$sr['id'].'</td>
                    <th>Bus Reg No</th>
                        <td>'.$sr['busregno'].'</td>
                    <th>Route</th>
                        <td>'.$sr['routename'].'</td>
                    </tr>
                    <tr>
                    <th>Travel Date</th>
                        <td>'.date("d-m-Y", strtotime($sr['traveldate'])).'</td>
                    <th>Departure</th>
                        <td>'.$sr['departure'].'</td>
                    <th>Arrival</th>
                    <td>'.$sr['arrival'].'</td>
                    </tr>
                </table>
                </div>
            ';
            echo '
                <h4>Passenger List</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Seat Number</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>TicketID</th>
                                <th>Check In</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($pass = $result->fetch_assoc())
                        {
                            echo '<tr>
                            <td>'.$pass['seatnum'].'</td>
                            <td>'.$pass['fullname'].'</td>
                            <td>'.$pass['mobile'].'</td>
                            <td>'.$pass['ticketID'].'</td>
                            <td></td>
                            </tr>' ;
                        }
        
                        echo '	  
                        </tbody>
                    </table>
                </div> 
            ';

        }
    }
    else
    {
    echo 'No Passenger List Available!.';
    }
?>
