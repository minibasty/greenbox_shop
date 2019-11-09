<html>
<head>
 <title>อัพโหลดรูป</title>
<!-- Style -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="vender/select2/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="vender/select2/css/select2-bootstrap4.css" type="text/css" />
<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
<!-- dropzone Scrip -->
<script src="js/dropzone.js"></script>
<style type="text/css">
	.font-1{
		color: #FFFFFF;
	}

</style>
</head>
<body>
	<div class="container bg-dark" style="padding-top: 50px">
		<form action="" method="get" accept-charset="utf-8">
				<div class="form-group row">
					<?php
					include('config.php');
					$check=isset($_GET['chassi']) ? $_GET['chassi'] : '';
					  if ($check==""){ 
					  $sql="SELECT id, user FROM member";
					  $rs=$conn->query($sql);
					 ?>
					<div class="col-sm-8">
						<select class="form-control form-control-sm" name="chassi" id="simple-single-select">
							<?php while ($r=$rs->fetch_array()) { ?>
				                <option value="<?= $r['user']?>"><?= $r['user']?></option>
			            	<?php } ?>
			             </select>
					</div>
					<div class="col-sm-4">
						<button type="submit" class="btn btn-info btn-block">บันทึก</button>
					</div>
					<?php }else{ ?> 
					<div class="col-sm-12">
						<h6 class="font-1">คัดซี :: <?= $check ?></h6>

					</div>
					<?php } ?>
				</div>
		</form>
		<?php 
			if ($check==""){ }else{
		 ?>
		<form action="upload.php" method="post" class="dropzone">
			<input type="text" hidden name="chassi" value="<?= $check ?>">
			
		</form>
		<div class="container row">
			<button type="button" class="btn btn-warning btn-block" name="rf" onclick='location.replace("?chassi=<?= $check ?>")'>>> รีโหลด <<</button>
		</div>
		<div style="padding-top: 30px">
			<?php 
			$dirname = "uploads/".$check."/";
			$images = glob($dirname."*.jpg");
			$i=0;
			foreach($images as $image) {
			$i++;
			    echo '<a href="'.$image.'" target="_BRANK"><img class="rounded " src="'.$image.'" height="200px" /></a>';
			    ?>
			<?php
			}
			 ?>
		<?php } ?>
		</div>

	</div>
</body>
</html>
<?php 

 ?>
<!-- select2 -->
<script type="text/javascript" src="vender/select2/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="vender/select2/js/select2.full.js"></script>
<?php //include('js.php') ?>
<!-- scrip select2 -->
<script type="text/javascript">
  $("#simple-single-select, #simple-multiple-select, #input-group-single-select, #input-group-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4",
    placeholder: "เลือกอุปกรณ์",
    allowClear: true
  });
  $("#disabled-single-select").select2({
    width: "100%",
    theme: "bootstrap4",
    disabled: true
  });
  $("#disabled-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4",
    allowClear: true
  });
  $("#form-single-select, #form-multiple-select").select2({
    width: "100%",
    theme: "bootstrap4"
  });
</script>
