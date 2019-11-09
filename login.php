<?php
session_start() ;
/* add by kergrit(redthird.com) for compatible global variable off/on php.ini */
/* end of add */
?>
<link href="css/login.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<?php
	error_reporting(~E_NOTICE);
  if(isset($_POST['user_login']) and isset($_POST['pwd_login'])) {
  include("config.php") ;
  $user_login=$_POST['user_login'];
  $pwd_login=$_POST['pwd_login'];
  $sql="select * from employee where emp_user='$user_login' and emp_pass='$pwd_login'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
    echo $sql;
    echo "<script> alert('Username หรือ Password ผิด') </script>" ;
    // print "<meta http-equiv=refresh content=0;URL=login.php>";
    exit() ;
    }
    else{
		// echo $sql;
		$_SESSION['login_id'] = $row['emp_id'];
    	$_SESSION['login_name'] = $user_login;
		$_SESSION['login_status'] = $row['emp_status'];
		$_SESSION['login_tel'] = $row['emp_tel'];
		if ($_SESSION['login_status']=="admin") {
			echo "<script> alert('เข้าสู่รับบสำเร็จ (Admin)') </script>" ;
			print "<meta http-equiv=refresh content=0;URL=manage_admin.php>";
		}elseif($_SESSION['login_status']=="sale") {
			echo "<script> alert('เข้าสู่รับบสำเร็จ (Sale)') </script>" ;
			print "<meta http-equiv=refresh content=0;URL=manage_admin.php>";
		}
		exit() ;
    }
  }
?>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>ลงชื่อเข้าใช้</h3>
			</div>
			<div class="card-body">
				<form name="form1" method="post" action="">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="user_login" placeholder="username">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="pwd_login" placeholder="password">
					</div>

					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<script lanuage="javascript">
				function check() {
					var v1 = document.form1.user_login.value;
					var v2 = document.form1.pwd_login.value;
					if (v1.length == 0) {
						alert("อะไรสักอย่าง");
						document.form1.user_login.focus();
						return false;
					} else if (v2.length == 0) {
						alert("อะไรสักอย่าง2");
						document.form1.pwd_login.focus();
						return false;
					} else
						return true;
				}
			</script>
			<!-- <div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div> -->
		</div>
	</div>
</div>
</body>
</html>
