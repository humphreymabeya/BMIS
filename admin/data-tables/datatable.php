<?php
	include("../../database/config.php");
	// include("php/checklogin.php");

	if($_GET['type']=="bussearch")
	{
		$aColumns = array( 'b.id','b.busregno','b.bustype', 'departure','r.routename','b.traveldate');
			
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "b.id";
			
			/* DB table to use */
			$sTable = " bus as b,route as r ";	
		/* 
		* Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".mysqli_real_escape_string($conn,$_GET['iDisplayStart'] ).", ".
				mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );
		}	
	/*
	 * Ordering
	 */
	 	$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".mysqli_real_escape_string($conn, $_GET['sSortDir_'.$i] ) .", ";
				}
			}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	$cond = "";
	$condArr = array();
	if(isset($_GET['bus']) && $_GET['bus']!="")
	{
		$condArr[] = "s.busregno like '%".mysqli_real_escape_string($conn,$_GET['bus'])."%'";
	
	}
	
	if(isset($_GET['route']) && $_GET['route']!="")
	{
		$condArr[] = "r.id = '".mysqli_real_escape_string($conn,$_GET['route'])."'";
	
	}
	
	
	if(isset($_GET['traveldate']) && $_GET['traveldate']!="")
	{
		$Adate= explode(' ',$_GET['traveldate']);
		$month = $Adate[0];
		$year = $Adate[1];
		$months = array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
		
		$doj = $months[$month].'-'.$year;	
		$condArr[] = " DATE_FORMAT(b.traveldate, '%m-%Y') = '".$doj."'";
	
	}
	if(count($condArr)>0)
	{
		$cond = " and ( ".implode(" and ",$condArr)." )";
	}
	 
	$mycount = count($aColumns);
	 
	$sWhere = " WHERE r.id=b.route and b.delete_status='0' ";
	if ( isset($_GET['sSearch'])&& $_GET['sSearch'] != "" )
	{
	    
		$sWhere = $sWhere." and (";
		for ( $i=0 ; $i<$mycount ; $i++ )
		{
		    
			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering 
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";
		}
	}*/
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS   ".implode(", ", $aColumns)."
		FROM   ".$sTable."	".$sWhere.$cond." ".$sOrder." ".$sLimit;
	
	$rResult = $conn->query($sQuery) or die(mysqli_error($conn));
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS() as rr
	";
	$rResultFilterTotal = $conn->query( $sQuery) or die(mysqli_error($conn));
	$aResultFilterTotal = $rResultFilterTotal->fetch_assoc();
	$iFilteredTotal = $aResultFilterTotal['rr'];
	
	/* Total data set length */
	$sQuery = "SELECT COUNT(".$sIndexColumn.") as cc
		FROM   ".$sTable." WHERE r.id=b.route and b.delete_status='0'";
	$rResultTotal = $conn->query( $sQuery ) or die(mysqli_error($conn));
	$aResultTotal = $rResultTotal->fetch_assoc();
	$iTotal = $aResultTotal['cc'];
	
	
	/*
	 * Output
	 */
	 
	if(isset($_GET['sEcho'])) 
	{
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	}else
	{
	 $output = array(
		
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	}
	
     $row =array();
	while ( $aRow = $rResult->fetch_assoc()  )
	{
		
		
		$row = array(
                    html_entity_decode($aRow['busregno'].'<br/>'.$aRow['bustype']),
                    $aRow['routename'],
					$aRow['traveldate'],
                    $aRow['departure'],
					// date("d M y", strtotime($aRow['joindate'])),
                    
					html_entity_decode('<button class="btn btn-primary" onclick="javascript:GetManifest('.$aRow['id'].')"><i class="fa fa-list-alt "></i>  Manifest </button>')
										
                );
		
		$output['aaData'][] =$row;
		
	}
	
	echo json_encode( $output );

}
?>