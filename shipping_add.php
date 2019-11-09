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
		$sql_customer="SELECT * FROM customer WHERE cus_id=$_GET[customer]";
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
						<a href="?p=customer_edit&customer=<?= $_GET['customer'] ?>" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-undo-alt"></span> ย้อนกลับ</button></a>
					</div>
				</div>
			</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อลูกค้า | ที่อยู่</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="nameCus" value="<?= $r_customer['cus_name'].' | '.$r_customer['cus_address'] ?>" readonly>
					<input id="input" class="form-control" type="text" name="cus_id" value="<?= $r_customer['cus_id']?>" hidden="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อผู้รับ</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ที่อยู่ผู้รับ</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="address" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">จังหวัด/สถานที่</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="province" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">เบอร์โทร</label>
					<div class="col-sm-10">
						<input id="input" class="form-control" type="text" name="zipcode" value="" onkeypress="key_number(this)">
					</div>
				</div>
			</div>
					<div class="container text-center" style="padding : 10px">
			<button class="btn btn-success" name="save" type="submit">บันทึก</button>
		</div>
		</div>

		</form>
	</div>
	<?php
	if (isset($_POST['save'])) {
		$sql="INSERT INTO customer_shipping VALUES ('','$_POST[name]','$_POST[address]','$_POST[province]','$_POST[zipcode]','$_POST[cus_id]')";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('เพิ่มชื่อลูกค้าสำเร็จ') </script>";
			echo '<meta http-equiv=refresh content=0;URL=?p=customer_edit&customer='.$_GET['customer'];
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
