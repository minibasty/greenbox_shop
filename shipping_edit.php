<!DOCTYPE html>
<?php
	include 'config.php';
	include('all_function.php');
 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
	<?php

		$sql_ship="SELECT * FROM customer_shipping WHERE ship_id=$_GET[ship]";
		$rs_ship=$conn->query($sql_ship);
		$r_ship=$rs_ship->fetch_assoc();


		$sql_customer="SELECT * FROM customer WHERE cus_id=$r_ship[cus_name]";
		$rs_customer=$conn->query($sql_customer);
		$r_customer=$rs_customer->fetch_assoc();
	 ?>
	<div class="container-fluid">
		<form action="" method="post">
		<div class="card-body">
			<div class="container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>เพิ่มที่อยู่จัดส่ง</h3>
					</div>
					<div class="col text-right">
						<a href="?p=customer_edit&customer=<?= $r_customer['cus_id'] ?>" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-undo-alt"></span> ย้อนกลับ</button></a>
					</div>
				</div>
			</div>
				<!-- ค่า ID ซ่อน -->
				<input id="input" class="form-control" type="text" name="ship_id" value="<?= $r_ship['ship_id']?>" hidden="">

				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อลูกค้า | ที่อยู่</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="nameCus" value="<?= $r_customer['cus_name'].' | '.$r_customer['cus_address'] ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อผู้รับ</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="<?= $r_ship['ship_name'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ที่อยู่ผู้รับ</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="address" value="<?= $r_ship['ship_address'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">จังหวัด</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="province" value="<?= $r_ship['ship_province'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">เบอร์โทร</label>
					<div class="col-sm-10">
						<input id="input" class="form-control" type="text" name="zipcode" value="<?= $r_ship['ship_phone'] ?>" onkeypress="key_number(this)">
					</div>
				</div>
			</div>
			<div class="text-center" style="padding : 10px">
			<button class="btn btn-success" name="save" type="submit">บันทึก</button>
			</div>
		</div>

		</form>
	</div>
	<?php
	if (isset($_POST['save'])) {
		$sql="UPDATE `customer_shipping` SET `ship_name`='$_POST[name]',`ship_address`='$_POST[address]',`ship_province`='$_POST[province]',`ship_phone`='$_POST[zipcode]' WHERE ship_id=$_POST[ship_id]";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('บันทึกสำเร็จ') </script>";
			echo '<meta http-equiv=refresh content=0;URL=?p=shipping_edit&ship='.$_GET['ship'];
		}else{
			echo $sql;
			echo "<script> alert('บันทึกผิดพลาด') </script>";
			// echo '<meta http-equiv=refresh content=0;URL=?p=customer_add';

		}
	}
	 ?>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
