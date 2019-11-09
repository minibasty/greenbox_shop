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
		td, th{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
		include 'config.php';
		$sql="SELECT * FROM v_product";
		if (isset($_GET['product'])) {
		$sql.=" WHERE pro_id='$_GET[product]'";
		}
		$rs_sql=$conn->query($sql);
	?>
	<div class="container-fluid">

		<div class="card-body">
			<div class="table-responsive container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>รายละเอียดสินค้า</h3>
					</div>
					<div class="col text-right">
						<a href="?p=product_detail_add&product=<?= $_GET['product'] ?>" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-plus"></span> เพิ่มรายการ</button></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>ลับดับ</th>
						<th style="width: 30%">ชื่อสินค้า</th>
						<th style="width: 30%">หมายเลข</th>
						<th></th>
					</tr>
				</thead>
			<form action="" method="post" accept-charset="utf-8">
				<tbody>
					<?php
					$i=0;
					while($row=$rs_sql->fetch_assoc()){
					$i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= $row['pro_name'] ?></td>
						<td><?= $row['prod_sn'] ?></td>
						<td>
						<button class="btn btn-danger btn-sm" value="<?= $row['prod_id']?>" name="del" type="submit" onclick="return confirm('ยืนยันการลบ')">ลบ</button>
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
		$del=$conn->query("DELETE FROM product_detail WHERE prod_id='$_POST[del]'");
		if ($del) {
			echo '<script> alert("ลบรายการสำเร็จ")</script>';
			print "<meta http-equiv=refresh content=0;URL=?p=product_detail_list&product=$_GET[product]>";
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