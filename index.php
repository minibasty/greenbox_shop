<?php
	include("config.php");
	session_start();
	if (isset($_SESSION['login_name'])=="") {
		echo "<meta http-equiv=refresh content=0;URL=login.php>";
	}else {
		if ($_SESSION['login_status']=="sale") {
			echo "<meta http-equiv=refresh content=0;URL=manage_admin.php>";
		}elseif($_SESSION['login_status']=="admin"){
			echo "<meta http-equiv=refresh content=0;URL=manage_admin.php>";
		}
	}
 ?>
 