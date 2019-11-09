<!DOCTYPE html>
<?php 
	include('config.php');
	include('all_function.php');
	include('pagination_function.php');
 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>:: Order Details ::</title>
	<link href="css/bs4.3.1/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
	<link  href="css/mystyle.css" rel="stylesheet" type="text/css" > 

	
</head>
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","show_pro2.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<body>
	<div class="container-fluid">
		<div>
		<select class="form-control" name="users" onchange="showUser(this.value)">
		  <option value="">Select a person:</option>
		  <option value="1">VT900</option>
		  <option value="2">เครื่องรูดบัตร</option>
		  <option value="3">ซิม</option>
		</select>
		</div>
		<div id="txtHint"><b>กรุณาเลือกสินค้า</b></div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    

</body>
</html>