<!DOCTYPE html>
<?php 
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
<div class="container-fluid">
		<form action="" method="POST">
		<div class="card-body">
			<div class="container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>เพิ่มสินค้า</h3>
					</div>
					<div class="col text-right">
						<a href="?p=product_list" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-list"></span> รายชื่อสินค้า</button></a>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="input" class="col-sm-2 col-form-label text-right">ชื่อสินค้า</label>
				<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="">
				</div>
			</div>
			<div class="form-group row">
				<label for="input" class="col-sm-2 col-form-label text-right">ราคาสินค้า</label>
				<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="price" value="" onkeypress="key_number(this)">
				</div>
			</div>
			</div>
			<div class="text-center" style="padding : 10px">
			<button class="btn btn-success" name="add" type="submit">บันทึก</button>
		</div>
		</div>

	</form>
	<?php 
	include'config.php';
	if (isset($_POST['add'])) {
		$sql="INSERT INTO product VALUES ('','$_POST[name]','$_POST[price]')";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('บันทึกข้อมูลสินค้าเรียบร้อย') </script>";
			echo '<meta http-equiv=refresh content=0;URL=?p=product_list';
		}else{
			echo $sql;
			echo "<script> alert('บันทึกข้อมูลผิดพลาด') </script>";
			// echo '<meta http-equiv=refresh content=0;URL=?p=customer_add';
		}
	}
	 ?>
	</div>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>