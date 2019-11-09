<?php 
include('config.php');
// $result=$_GET['shipping'];
$select_id=$_GET['cust_id'];
	$sql="SELECT * FROM customer_shipping WHERE cus_name='$select_id'";
	$query=$conn->query($sql);
	$countNum=$query->num_rows;
	$strOption = null;
	if ($countNum>0) {
		while ($row=$query->fetch_array()) { 
		$strOption.= '<option value="'.$row["ship_id"].'">'.$row["ship_name"].' '.$row["ship_address"].' '.$row["ship_province"].' '.$row["ship_zipcode"].'</option>';
		}
	}else{
		$strOption.= '<option value="">ลูกค้ายังไม่มีที่อยู่จัดส่ง</option>';
		}
	echo $strOption;

 ?>