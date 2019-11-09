<?php
include 'config.php';
include 'all_function.php';
  date_default_timezone_set("Asia/Bangkok");
// หาไอดีสุดท้าย
$selectMax="SELECT MAX(ord_id) As Maxid FROM order_list";
$resultMax=$conn->query($selectMax);
$resultQuery=$resultMax->fetch_assoc();
$maxid=$resultQuery['Maxid']+1;
$order_date=DateYMD($_POST['order_date']);
// บันทึกข้อมูล เดอร์
// $customerID=isset($_POST['customer_code']) ? $_POST['customer_code'] : '';
$sql="INSERT INTO order_list VALUES ('$maxid','$order_date','$_POST[customer_code]','$_POST[shiping]','$_POST[emp_id]')";
$result=$conn->query($sql);
if ($result) {
	$status=1;
	echo '<script> alert("บันทึกสำเร็จ") </script>';
	print "<meta http-equiv=refresh content=0;URL=?p=order_detail&order=$maxid&status=$status>";
}else{
	echo '<script> alert("ข้อมูลผิดพลาด") </script>';
	print "<meta http-equiv=refresh content=0;URL=?p=order>";
}
 ?>