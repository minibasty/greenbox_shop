<!DOCTYPE html>
<?php
  require('config.php');
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
  $product_select="SELECT * FROM product WHERE id = '$_GET[product]'";
  $product_select_rs=$conn->query($product_select);
  $product_select_row=$product_select_rs->fetch_assoc();
   ?>
<div class="container-fluid">
		<form action="" method="POST">
		<div class="card-body">
			<div class="container">
			<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>แก้ไขสินค้า</h3>
					</div>
					<div class="col text-right">
						<a href="?p=product_list" title=""><button type="button" class="btn btn-info btn-sm">
						<span class="far fa-list"></span> รายชื่อสินค้า</button></a>
					</div>
				</div>
			</div>
      <div class="form-group row">
        <label for="input" class="col-sm-2 col-form-label text-right">รหัสสินค้า</label>
        <div class="col-sm-10">
          <input id="input" class="form-control" type="text" name="name" value="<?= $product_select_row['id'] ?>" readonly>
        </div>
      </div>
			<div class="form-group row">
				<label for="input" class="col-sm-2 col-form-label text-right">ชื่อสินค้า</label>
				<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="name" value="<?= $product_select_row['pro_name'] ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="input" class="col-sm-2 col-form-label text-right">ราคาสินค้า</label>
				<div class="col-sm-10">
					<input id="input" class="form-control" type="text" name="price" value="<?= $product_select_row['pro_price'] ?>" onkeypress="key_number(this)" required>
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
		$sql="UPDATE product SET pro_name='$_POST[name]' , pro_price='$_POST[price]' WHERE id = '$_GET[product]' ";
		$rs=$conn->query($sql);
		if ($rs) {
			echo "<script> alert('แก้ไขข้อมูลสินค้าเรียบร้อย') </script>";
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
