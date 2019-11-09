<!DOCTYPE html>
<?php
	include('config.php');
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
    <style type="text/css" media="screen">
    	td, th{
    		text-align: center;
    	}
    </style>
</head>
<body>
<div class="container-fluid">
	<?php
	$select="SELECT * FROM customer WHERE cus_id='$_GET[customer]'";
	$rs_select=$conn->query($select);
	$r_select=$rs_select->fetch_assoc();
	 ?>
	<form action="" method="POST" accept-charset="utf-8">
		<div class="form-group card-body">
			<div class="container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>ข้อมูลลูกค้า</h3>
					</div>
					<div class="col text-right">
						<a href="?p=customer_list" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-search"></span> รายชื่อลูกค้า</button></a>
					</div>
				</div>
			</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">รหัส</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="id" value="<?= $r_select['cus_id'] ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อลูกค้า</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="<?= $r_select['cus_name'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ที่อยู่</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="address" value="<?= $r_select['cus_address'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">เบอร์โทร</label>
					<div class="col-sm-10">
						<input id="input" class="form-control" type="text" name="tel" value="<?= $r_select['cus_tel'] ?>" onkeypress="key_number(this)">
					</div>
				</div>
			</div>
			<div class="text-center" style="padding : 10px">
			<button class="btn btn-success" type="submit" name="save" onclick="return confirm('ยืนยันการแก้ไข')"><span class="far fa-plus"></span> บันทึก</button>
			</div>
		</div>

		<!-- -------------ส่วนที่อยู่จัดส่ง -->
		<?php
		$sql_ship="SELECT * FROM customer_shipping WHERE cus_name=$r_select[cus_id]";
		$rs_ship=$conn->query($sql_ship);
		$countShip=$rs_ship->num_rows;

		 ?>
		<div class="form-group card-body">
			<div class="container">
				<div class="form-group">
					<div class="form-row">
						<div class="col">
							<h3>ที่อยู่จัดส่ง</h3>
						</div>
						<div class="col text-right">
							<a href="?p=shipping_add&customer=<?= $r_select['cus_id']?>" title=""><button type="button" class="btn btn-info btn-sm">
							<span class="far fa-plus"></span> เพิ่มที่อยู่จัดส่ง</button></a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>รหัสที่อยู่</th>
									<th>ชื่อผู้รับ</th>
									<th>ที่อยู่</th>
									<th>จังหวัด</th>
									<th>เบอร์โทร</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($countShip==0) {
										echo '<td colspan="6">ไม่มีข้อมูล <a href="?p=shipping_add&customer='.$r_select['cus_id'].'" title="">เพิ่มที่อยู่</a> </td>';
									}else{
									while ($r_ship=$rs_ship->fetch_assoc()) {
								 ?>
								<tr>
									<td ><?= $r_ship['ship_id'] ?></td>
									<td><?= $r_ship['ship_name'] ?></td>
									<td><?= $r_ship['ship_address'] ?></td>
									<td><?= $r_ship['ship_province'] ?></td>
									<td><?= $r_ship['ship_phone'] ?></td>
									<td>
										<a href="?p=shipping_edit&ship=<?= $r_ship['ship_id'] ?>" title=""><button class="btn btn-primary btn-sm" type="button" name="edit">แก้ไข</button></a>
									</td>
								</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
	<?php
	if (isset($_POST['save'])) {

		$sql="UPDATE `customer` SET `cus_name`='$_POST[name]',`cus_address`='$_POST[address]',`cus_tel`='$_POST[tel]' WHERE `cus_id`='$_POST[id]'";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('แก้ไขข้อมูลลูกค้าสำเร็จ') </script>";
			echo '<meta http-equiv=refresh content=0;URL=?p=customer_edit&customer='.$_POST['id'];
		}else{
			echo $sql;
			echo "<script> alert('แก้ไขข้อมูลผิดพลาด') </script>";
			// echo '<meta http-equiv=refresh content=0;URL=?p=customer_add';

		}
	}
	 ?>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
