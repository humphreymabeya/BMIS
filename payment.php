
<?php 
    $id = $errormsg = $action = $result = '';
    include('database/config.php');
    $send = 1;
    $amount = mysqli_real_escape_string($conn, $_POST['fare']);
    $mobile = mysqli_real_escape_string($conn, $_POST['contact']);
    $back = mysqli_real_escape_string($conn, $_POST['back']);
    // initiate transaction
    if($send = 1){
        require('mpesa/config/Constant.php');
        require('mpesa/lib/MpesaAPI.php');
        // mpesa credentials
        $PAYBILL_NO = "898998";
        $MERCHENTS_ID = $PAYBILL_NO;
        function generateRandomString() {
            $length = 7;
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $MERCHANT_TRANSACTION_ID = "NE8".generateRandomString();

        //Get the server address for callback
        $host=gethostname();
        $ip = gethostbyname($host);

        //$Password=Constant::generateHash();
        $Password='ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==';
        $mpesaclient=new MpesaAPI;
        $action = 1;
        if($action = 1){
            $mpesaclient->processCheckOutRequest($Password,$MERCHENTS_ID,$MERCHANT_TRANSACTION_ID,"ENA Travels",$amount,$mobile,$ip);
            echo "<br><br>";
            if(isset($_POST['save'])){
                $amount = mysqli_real_escape_string($conn, $_POST['fare']);
                $mobile = mysqli_real_escape_string($conn, $_POST['contact']);
                $sql = $conn->query("INSERT into payments (trans_id, mobile) VALUES('$MERCHANT_TRANSACTION_ID', '$mobile')");
            }
            echo "<script>window.alert('Transaction initiated. Check your mobile phone to complete Payments');</script>";
            echo "<br><br><br><center>You will be redirected in <span id='counter'>10</span> seconds</center>";
        }else
        {
            echo json_encode("No operation selected");
        }
    }else{
        echo json_encode("No data sent here");
    }
?>
<?php
	$action = $id = $tid = '';
	include('database/config.php');
	$fullname = $mobile = $idno = $email = $seat = $errormsg = $ticket = $bid = $fare = '';  
	$tid = $bid = isset($_GET['id'])?mysqli_real_escape_string($conn, $_GET['id']):'';
	$sq = $conn->query("SELECT * FROM reserves WHERE id = '".$tid."'");
	$res = $sq->fetch_assoc();

	if(isset($_POST['save'])){	
		$bid = mysqli_real_escape_string($conn, $_POST['bid']);
		$fare = mysqli_real_escape_string($conn, $_POST['fare']);
		foreach($_POST['fullname'] as $index => $val){
			$fullname = $val;
			$mobile = mysqli_real_escape_string($conn, $_POST['mobile'][$index]);
			$idno = mysqli_real_escape_string($conn, $_POST['idno'][$index]);
			$email = mysqli_real_escape_string($conn, $_POST['email'][$index]);
			$seat = mysqli_real_escape_string($conn, $_POST['seatnum'][$index]);
			$seat_xy = mysqli_real_escape_string($conn, $_POST['seat_xy'][$index]);
			// save into database
			$sql = $conn->query("INSERT into reserves (bid, fullname, mobile, idno, email, seatnum, seat_xy, paid) VALUES ('$bid','$fullname', '$mobile', '$idno','$email', '$seat', '$seat_xy', '$fare')");
			
			$sqlTicket = $conn->query("SELECT GROUP_CONCAT(CONCAT('''',fullname,'''')) AS fullnames FROM reserves where fullname = '".$fullname."' ");
			$results2 = $sqlTicket->fetch_array(MYSQLI_ASSOC);
			$res2 = $results2['fullnames'];
			// fetch ticketID from database
			$sql1 = $conn->query("SELECT GROUP_CONCAT(CONCAT('',ticketID,'')) AS tickets FROM reserves WHERE fullname IN($res2)");
			$result = $sql1->fetch_array(MYSQLI_ASSOC);
			$res = $result['tickets'];

			echo '<script type="text/javascript">alert("Your Ticket ID is : '.$res.'. Using this Ticket ID, Click on The Home Page, Print Ticket Tab, Insert the TicketID and Mobile Number To print Your Ticket. E-ticket notification sent to email and Mobile Number. Thank You, Welcome");</script>';
		}
    }
?>
<script type="text/javascript">
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = '<?php echo "../".$back; ?>';
        }
        i.innerHTML = parseInt(i.innerHTML)-1;
    }
    setInterval(function(){ countdown(); },1000);
</script>