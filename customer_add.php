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
	<form action="" method="POST" accept-charset="utf-8">
		<div class="card-body">
			<div class="container">
			<div class="form-group col" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>รายชื่อลูกค้า</h3>
					</div>
					<div class="col text-right">
				<a href="?p=customer_list" title=""><button type="button" class="btn btn-info btn-sm">
				<span class="far fa-search"></span> รายชื่อลูกค้า</button></a>
					</div>
				</div>
			</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ชื่อลูกค้า</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">ที่อยู่</label>
					<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="address" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">เบอร์โทร</label>
					<div class="col-sm-10">
						<input id="input" class="form-control" type="text" name="tel" value="" onkeypress="key_number(this)">
					</div>
				</div>
			</div>
			<div class="container text-center" style="padding : 10px">
				<button class="btn btn-success" type="submit" name="save"><span class="far fa-plus"></span> บันทึก</button>
			</div>
		</div>

	</form>
</div>
	<?php 
	include 'config.php';
	if (isset($_POST['save'])) {
		$max="SELECT MAX(cus_id) as maxID FROM customer";
		$rs_max=$conn->query($max);
		$check_max=$rs_max->fetch_assoc();
		$maxID=$check_max['maxID']+1;
		$sql="INSERT INTO customer VALUES ('$maxID','$_POST[name]','$_POST[address]','$_POST[tel]')";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('เพิ่มชื่อลูกค้าสำเร็จ') </script>";
			echo '<meta http-equiv=refresh content=0;URL=?p=customer_edit&customer='.$maxID;
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