<!DOCTYPE html>
<?php
	include('config.php');
	include('all_function.php');
  	date_default_timezone_set("Asia/Bangkok");

 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>:: Order Details ::</title>
	<link href="css/bs4.3.1/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
	<link  href="css/mystyle.css" rel="stylesheet" type="text/css" >

</head>
<body>
	<?php
	$select_order=$conn->query("SELECT * FROM v_order_list WHERE ord_id=$_GET[order]");
	$row=$select_order->fetch_assoc();

	// shiping Address
	$shipingAddress=$row['ship_name']." ".$row['ship_address']." ". $row['ship_province']." ".$row['ship_phone'];
	 ?>
	<div class="container-fluid">
		<div class="card-body form-group">
			<div class="container">
				<div class="form-group">
				<div class="form-row">
					<div class="col">
						<h3>ข้อมูลลูกค้า</h3>
					</div>
				</div>
				</div>
				<table class="table table-borderless">
					<tbody>
						<tr>
							<td style="width: 15%;">รหัสออเดอร์</td>
							<td colspan="3" style="width: 35%;">: <?= $row['ord_id'] ?></td>
						</tr>						<tr>
							<td class="" style="width: 15%;">ชื่อลูกค้า</td>
							<td style="width: 35%;">: <?= $row['cus_name'] ?></td>
							<td class="" style="width: 15%;">วันที่ซื้อ</td>
							<td style="width: 35%;">: <?= DateThai($row['ord_date']) ?></td>
						</tr>
						<tr>
							<td class="" style="width: 15%;">ที่อยู่จัดส่ง</td>
							<td style="width: 35%;">: <?= $shipingAddress ?></td>
							<td class="" style="width: 15%;">ชื่อผู้ขาย</td>
							<td style="width: 35%;">: <?= $row['emp_name'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<form action="" method="post">
		<div class="card-body form-group">
			<div class="container">
				<div class="form-group">
				<div class="form-row">
					<div class="col">
						<h4>เพิ่มสินค้า</h4>
					</div>
				</div>
				</div>
				<table class="table table-borderless">
				<tbody>
					<tr>
						<td style="width: 15%;">รหัสสินค้า</td>
						<td style="width: 35%;"> <input class="form-control" type="text" name="pro_sn" id="pro_sn" value="" placeholder="" readonly onclick="return MM_openBrWindow('show_pro2.php','search2','scrollbars=yes,width=750,height=600')"> </td>
						<td style="width: 15%;">รับประกัน</td>
						<td style="width: 35%;"> <input class="form-control" type="text" name="warranty" value="" placeholder="จำนวนวันที่รับประกัน" onkeypress="key_number()"></td>
						<td style="width: 35%;"> <button class="btn btn-success" type="submit" name="add" >เพิ่ม</button></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
		</form>

		<div class="card-body form-group">
			<div class="container">
				<div class="form-group">
				<div class="form-row">
					<div class="col">
						<h4>รายการสินค้า</h4>
					</div>
				</div>
				</div>
				<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">ลำดับ</th>
						<th class="text-center">ชื่อสินค้า</th>
						<th class="text-center">รหัสสินค้า</th>
						<th class="text-center">รับประกัน/วัน</th>
						<th class="text-center" style="width: 15%;">ราคา</th>
						<th class="text-center" style="width: 15%;">ลบ</th>
					</tr>

				</thead>
				<form action="" method="post">
				<tbody>
				<?php
				$sql_detail=$conn->query("SELECT * FROM v_order_detail WHERE ord_id = $_GET[order] ORDER BY ordet_id ASC");
				$i=0;
				$sumPrice=0;
				while ($row_detail=$sql_detail->fetch_assoc()){
					$i++;
					$sumPrice+=$row_detail['pro_price'];
					?>
					<tr>
						<td class="text-center"><?= $i; ?></td>
						<td class="text-center"><?= $row_detail['pro_name']?></td>
						<td class="text-center"><?= $row_detail['prod_sn']?></td>
						<td class="text-center"><?= $row_detail['warranty']?></td>
						<td class="text-center"><?= $row_detail['pro_price']?></td>
						<td class="text-center"><button value="<?= $row_detail['ordet_id']?>" name="del" type="submit" onclick="return confirm('ยืนยันการลบ')">ลบ</button></td>
					</tr>
				<?php
				}
				 ?>
				 <tr>
				 	<td class="text-right" colspan="4" rowspan="" headers="">ราคารวม</td>
				 	<td class="text-center" colspan="" rowspan="" headers=""><?= $sumPrice ?></td>
				 </tr>
				</tbody>
				</form>
			</table>
			</div>
		</div>
		<div class="card-body form-group">
			<div class="col text-center">
				<a href="p_order_detail.php?order=<?= $_GET['order'] ?>" target="_BLANK" title=""><button type="button">ปริ้น</button></a>
			</div>
		</div>
	</div>
	<?php

	// ลบรายการ
	if (isset($_POST['del'])){
		// echo "string";
		$del="DELETE FROM order_detail WHERE ordet_id = '$_POST[del]'";
		$rs_del=$conn->query($del);
		print "<meta http-equiv=refresh content=0;URL=?p=order_detail&order=$_GET[order]&status=$_GET[status]>";
	}

	if (isset($_POST['add'])) {
		// หา ID ของสินค้า จาก sn
	$productSelect=$conn->query("SELECT * FROM product_detail WHERE prod_sn ='$_POST[pro_sn]'");
	$result_productSelect=$productSelect->fetch_assoc();
	// print_r($result_productSelect);
		// เพิ่มสินค้า
	$addProduct="INSERT INTO order_detail VALUES ('','$_GET[order]','$result_productSelect[prod_id]','$_POST[warranty]')";
	$rs_addProduct=$conn->query($addProduct);
		if ($rs_addProduct) {
		print "<meta http-equiv=refresh content=0;URL=?p=order_detail&order=$_GET[order]&status=$_GET[status]>";
		}
	}

	 ?>
	<script type="text/javascript">
<!--

function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
