<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" >
	<style type="text/css" media="screen">
		tr td, th{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
	include'config.php';
	$show="SELECT * FROM customer";
	$rs_show=$conn->query($show);
	 ?>
	<div class="container-fluid">
		<form action="" method="POST" accept-charset="utf-8">
		<div class="container">

		</div>
		<div class="card-body">
			<div class="table-responsive container">
			<div class="form-group col" style="padding: 0px">
				<div class="form-row">
					<div class="col">
					<h2>รายชื่อลูกค้า</h2>
					</div>
					<div class="col text-right">
					<a href="?p=customer_add" title=""><button type="button" class="btn btn-info btn-sm">
					<span class="far fa-plus"></span> เพิ่มลูกค้า</button></a>
					</div>
				</div>

			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>รหัส</th>
						<th>ชื่อลูกค้า</th>
						<th>ที่อยู่ลูกค้า</th>
						<th>เบอร์โทร</th>
						<th>แก้ไข</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($r_show=$rs_show->fetch_assoc()) { ?>
					<tr>
						<td><?= $r_show['cus_id'] ?></td>
						<td><?= $r_show['cus_name'] ?></td>
						<td><?= $r_show['cus_address'] ?></td>
						<td><?= $r_show['cus_tel'] ?></td>
						<td>
						<a href="?p=customer_edit&customer=<?= $r_show['cus_id'] ?>" title=""><button type="button" class="btn btn-primary btn-sm">แก้ไข</button></a>
						<button type="submit" name="del" class="btn btn-danger btn-sm" value="<?= $r_show['cus_id'] ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			</div>
		</div>
		</form>
	</div>
	<?php
	include 'config.php';
	if (isset($_POST['del'])) {
		$del_ship="DELETE FROM customer_shipping WHERE cus_name='$_POST[del]'";
		$del_ship_rs=$conn->query($del_ship);

			if ($del_ship_rs) {
				$del="DELETE FROM customer WHERE cus_id='$_POST[del]'";
				$rs=$conn->query($del);
				if ($rs) {
					echo "<script> alert('ลบรายชื่อลูกค้าสำเร็จ') </script>";
					echo '<meta http-equiv=refresh content=0;URL=?p=customer_list';
				}else {
					echo $del;
					echo "<script> alert('ลบข้อมูลลูกค้าไม่สำเร็จ') </script>";
				}
			}else{
				echo $del_ship;
				echo "<script> alert('ลบข้อมูลที่อยู่ลูกค้าไม่สำเร็จ') </script>";
			// echo '<meta http-equiv=refresh content=0;URL=?p=customer_add';
			}
	}
	 ?>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
