<!DOCTYPE html>
<?php
include('config.php');
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
	<?php
	$sql_ship="SELECT * FROM customer_shipping";
	$rs_ship=$conn->query($sql_ship);
	 ?>
	<div class="container-fluid">
    <form class="" action="" method="post">

		<div class="card-body">
			<div class="">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>ข้อมูลที่อยู่จัดส่ง</h3>
					</div>
					<div class="col text-right">
						<a href="?p=customer_list" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-search"></span> รายชื่อลูกค้า</button></a>
					</div>
				</div>
			</div>
			</div>
			<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>รหัสที่อยู่</th>
						<th>ชื่อผู้รับ</th>
						<th style="width:30%">ที่อยู่ผู้รับ</th>
						<th>จังหวัด/สถานที่</th>
						<th>เบอร์โทร</th>
						<th>ลูกค้า (ผู้สั่ง)</th>
						<th>แก้ไข</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($r_ship=$rs_ship->fetch_assoc()) {
							$sql_customer="SELECT * FROM customer WHERE cus_id=$r_ship[cus_name]";
							$rs_customer=$conn->query($sql_customer);
							$row_customer=$rs_customer->fetch_assoc()
					 ?>
					<tr>
						<td><?= $r_ship['ship_id'] ?></td>
						<td><?= $r_ship['ship_name'] ?></td>
						<td><?= $r_ship['ship_address'] ?></td>
						<td><?= $r_ship['ship_province'] ?></td>
						<td><?= $r_ship['ship_phone'] ?></td>
						<td><?= $row_customer['cus_name'] ?></td>
						<td>
							<a href="?p=shipping_edit&ship=<?= $r_ship['ship_id'] ?>" title="">
							<button class="btn btn-primary btn-sm" type="button"> <span class="far fa-edit"></span> แก้ไข</button></a>
              <button type="submit" class="btn btn-danger btn-sm" value="<?= $r_ship['ship_id'] ?>" name="del_ship" onclick="return confirm('ยืนยันการลบ')"> <span class="far fa-trash-alt"></span> ลบ</button>
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
  if (isset($_POST['del_ship'])) {
    $del_ship="DELETE FROM customer_shipping WHERE ship_id = '$_POST[del_ship]'";
    $del_ship_rs=$conn->query($del_ship);
    if ($del_ship_rs) {
      echo "<script> alert('ลบที่อยู่สำเร็จ') </script>";
      echo '<meta http-equiv=refresh content=0;URL=?p=shipping_list';
    }
  }
   ?>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
