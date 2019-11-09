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
	$sql_order="SELECT * FROM v_order_list ORDER BY ord_id DESC";
	$rs_order=$conn->query($sql_order);
	 ?>

	<div class="container-fluid">
    <form action="" method="post">
		<div class="card-body">
			<div class="">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>รายการออเดอร์</h3>
					</div>
					<div class="col text-right">
						<a href="?p=order" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-plus"></span> เพิ่มออเดอร์</button></a>
					</div>
				</div>
			</div>
			</div>
			<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>รหัสออเดอร์</th>
						<th>วันที่</th>
						<th>ชื่อลูกค้า</th>
						<th>ที่อยู่</th>
						<th>เบอร์โทร</th>
						<th>ชื่อ-ที่อยู่จัดส่ง</th>
						<th>แก้ไข</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($r_order=$rs_order->fetch_assoc()) {
							// $sql_customer="SELECT * FROM customer WHERE cus_id=$r_ship[cus_name]";
							// $rs_customer=$conn->query($sql_customer);
							// $row_customer=$rs_customer->fetch_assoc()
					 ?>
					<tr>
						<td><?= $r_order['ord_id'] ?></td>
						<td><?= $r_order['ord_date'] ?></td>
						<td><?= $r_order['cus_name'] ?></td>
						<td><?= $r_order['cus_address'] ?></td>
						<td><?= $r_order['cus_tel'] ?></td>
						<td><?= $r_order['ship_name']." ".$r_order['ship_address']." ". $r_order['ship_province'] ?></td>
						<td>
							<a href="?p=order_detail&order=<?= $r_order['ord_id'] ?>" title="">
							<button class="btn btn-primary btn-sm" type="button"> <span class="far fa-edit"></span> แก้ไข</button></a>
              <button type="submit" class="btn btn-danger btn-sm" value="<?= $r_order['ord_id'] ?>" name="del_order" onclick="return confirm('ยืนยันการลบ')"> <span class="far fa-trash-alt"></span> ลบ</button>
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
  if (isset($_POST['del_order'])) {
    $del_ordetail="DELETE FROM order_detail WHERE ord_id='$_POST[del_order]'";
    $del_ordetail_rs=$conn->query($del_ordetail);


    if ($del_ordetail_rs) {
      $del_order="DELETE FROM order_list WHERE ord_id='$_POST[del_order]'";
      $del_order_rs=$conn->query($del_order);

      if ($del_order_rs) {
        echo "<script> alert('ลบรายชื่อลูกค้าสำเร็จ') </script>";
        echo '<meta http-equiv=refresh content=0;URL=?p=order_list';
      }else {
        echo $del_order;
        echo "<script> alert('ลบรายการออเดอร์ไม่สำเร็จ') </script>";
      }
    }else{
      echo $del_ordetail;
      echo "<script> alert('ลบรายละเอียดออเดอร์ไม่สำเร็จ') </script>";
    // echo '<meta http-equiv=refresh content=0;URL=?p=customer_add';
    }
  }



   ?>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
