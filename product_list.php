<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" >
<style>
	tr td,th{
		text-align: center;
	}
</style>
</head>
<body>
	<?php
		include 'config.php';
		$sql=$conn->query("SELECT * FROM product");

	 ?>
	<div class="container-fluid">
		<div class="card-body">
			<div class="table-responsive container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>เพิ่มสินค้า</h3>
					</div>
					<div class="col text-right">
						<a href="?p=product_add" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-plus"></span> เพิ่มสินค้า</button></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>รหัสสินค้า</th>
						<th>ชื่อรุ่น</th>
						<th>ราคา</th>
						<th></th>
					</tr>
				</thead>
				<form action="" method="post" accept-charset="utf-8">
				<tbody>
					<?php
					$i=0;
					while($row=$sql->fetch_assoc()){
					$i++;
					 ?>
					<tr>
						<td><?= $row['id'] ?></td>
						<td><?= $row['pro_name'] ?></td>
						<td><?= $row['pro_price'] ?></td>
						<td>
							<a href="?p=product_detail_list&product=<?= $row['id'] ?>" title="ดูรายละเอียดสินค้า">
							<button class="btn btn-info btn-sm" type="button">
								<span class="far fa-warehouse-alt"></span>
								สต๊อก
							</button></a>
							<a href="?p=product_edit&product=<?= $row['id'] ?>" title="แก้ไข">
							<button class="btn btn-primary btn-sm" type="button">
								<!-- <span class="far fa-warehouse-alt"></span> -->
								แก้ไข
							</button></a>
							<button type="submit" class="btn btn-danger btn-sm" value="<?= $row['id'] ?>" name="del" onclick="return confirm('ยืนยันการลบ')">ลบ</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</form>
			</table>
			</div>
		</div>
	</div>
	<?php
	if (isset($_POST['del'])) {
		$del=$conn->query("DELETE FROM product WHERE id='$_POST[del]'");
		if ($del) {
			echo '<script> alert("ลบรายการสำเร็จ")</script>';
			print "<meta http-equiv=refresh content=0;URL=?p=product_list";
		}else{
			echo '<script> alert("ผิดพลาด")</script>';
			echo $del;
		}
	}
	 ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
