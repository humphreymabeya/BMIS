<?php
	include("../../database/config.php");
	if($_GET['type'] == 'busname'){
		$result = $conn->query("SELECT busregno,bustype FROM bus where (busregno LIKE '%".$_GET['name_startsWith']."%' or bustype LIKE '%".$_GET['name_startsWith']."%')   ");	
		$data = array();
		while ($row = $result->fetch_assoc()) {
			//array_push($data, $row['sname'].'-'.$row['contact']);	
			array_push($data, $row['busregno']);	
		}	
		echo json_encode($data);
    }
?>