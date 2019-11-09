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
</head>
<body>
	<?php 
	$select="SELECT * FROM product WHERE id=$_GET[product]";
	$rs_select=$conn->query($select);
	$r_select=$rs_select->fetch_array();
	 ?>
<div class="container-fluid">
	<form action="" method="post" accept-charset="utf-8">
		<div class="card-body  form-group">
			<div class="container">
						<div class="form-group" style="padding: 0px">
				<div class="form-row">
					<div class="col">
						<h3>เพิ่มสินค้า <?= $r_select['pro_name'] ?>  ในสต๊อก </h3>
					</div>
					<div class="col text-right">
						<a href="?p=product_detail_list&product=<?= $_GET['product'] ?>" title=""><button type="button" class="btn btn-info btn-sm">
				<span class="far fa-search"></span> ดูสินค้าในสต๊อก</button></a>
					</div>
				</div>
			</div>
				<div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label text-right">S/N</label>
					<div class="col-sm-10">
					<textarea class="form-control" name="sn" id="sn"></textarea>
					</div>
				</div>
			</div>
			<div class="text-center" style="padding : 10px">
				<button class="btn btn-success" id="save" type="submit" name="save">บันทึก</button>
			</div>
		</div>

	</form>
	<?php
	if (isset($_POST['save'])) {
		$arrSerial=explode("\n",$_POST['sn']);
	$countArr=count($arrSerial)-1;
	$logInsert=null;
	for ($i=0; $i < $countArr; $i++) {
		$serial=trim($arrSerial[$i]);
		// เช็ค Serial ซ้ำ
		$check=$conn->query("SELECT * FROM product_detail WHERE prod_sn='$serial'");
		$checkNum=$check->num_rows;
		if ($checkNum == 0) {
			if ($serial!="") {
				$insert="INSERT INTO product_detail VALUES ('', '$_GET[product]', '$serial','')";
				// echo $insert;
				$insertQ=$conn->query($insert);
				if ($insertQ) {
					$logInsert.=$serial." | Success <br>";
						echo '<div class=" alert alert-success" role="alert">
  '.$serial.' | Success
  </div>';
				}
			}
		}else{
			$logInsert.=$serial." | Fail <br>";
			echo '<div class="alert alert-danger" role="alert">
  '.$serial.' | Fail
  </div>';
		}

	}
	}
	
	 ?>
	</div>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(function() {
		  $("#sn").focus();
		});

	var input = document.getElementById("sn");
	input.addEventListener("keyup", function(event) {
	  if (event.keyCode === 13) {
	   event.preventDefault();
	   document.getElementById("save").click();
	  }
	});
    </script>

</body>
</html>