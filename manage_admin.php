
<!doctype html>
<?php
  session_start();
  if (isset($_SESSION['login_name'])=="") {
    echo "<meta http-equiv=refresh content=0;URL=login.php>";
  }
 ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/truck.ico">

    <title>:: GPS SHOP :: </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" >

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <link  href="font/stylesheet.css" rel="stylesheet" type="text/css" >
    <style type="text/css">
      div, nav{
        font-family: 'Prompt', sans-serif;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">GPS SHOP</a>
      <h5 class="text-white">สวัสดี :: <?= $_SESSION['login_name'] ?> </h5>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Menu</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column">
            <?php if ($_SESSION['login_status']=="admin"){ ?>
              <li class="nav-item">
                <a class="nav-link active" href="?p=product_list">
                  <span class="far fa-home"></span>
                  จัดการสินค้า <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=customer_list">
                  <span class="far fa-users"></span>
                  <span data-feather="file"></span>
                  จัดการลูกค้า
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=shipping_list">
                  <span class="far fa-address-card"></span>
                  จัดการที่อยู่จัดส่ง
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=order">
                  <span class="far fa-cart-plus"></span>
                  เพิ่มออเดอร์
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=order_list">
                  <span class="far fa-shopping-cart"></span>
                  จัดการการออเดอร์
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=product_listall">
                  <span class="far fa-list-alt"></span>
                  สินค้าทั้งหมด
                </a>
              </li>
              <?php }elseif($_SESSION['login_status']=="sale"){ ?>
              <li class="nav-item">
                <a class="nav-link" href="?p=order">
                  <span class="far fa-cart-plus"></span>
                  เพิ่มออเดอร์
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=order_list">
                  <span class="far fa-shopping-cart"></span>
                  จัดการการออเดอร์
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?p=product_listall">
                  <span class="far fa-list-alt"></span>
                  สินค้าทั้งหมด
                </a>
              </li>
            <?php } ?>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item" hidden>
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>

            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <?php
              $page=isset($_GET['p']) ? $_GET['p'] : '';
              switch($page){
                case 'product_list': include('product_list.php') ;break;
                case 'product_add': include('product_add.php') ;break;
                case 'product_edit': include('product_edit.php') ;break;
                case 'product_detail_list': include('product_detail_list.php') ;break;
                case 'product_detail_add': include('product_detail_add.php') ;break;
                case 'product_detail_edit': include('product_detail_edit.php') ;break;
                case 'product_listall': include('product_listall.php') ;break;

                case 'customer_list': include('customer_list.php') ;break;
                case 'customer_add': include('customer_add.php') ;break;
                case 'customer_edit': include('customer_edit.php') ;break;

                case 'shipping_list': include('shipping_list.php') ;break;
                case 'shipping_add': include('shipping_add.php') ;break;
                case 'shipping_edit': include('shipping_edit.php') ;break;

                case 'order': include('order.php') ;break;
                case 'order_detail': include('order_detail.php') ;break;
                case 'order_list': include('order_list.php') ;break;

                case 'action_order': include('action_order.php'); break;
                case 'action_addProduct': include('action_addProduct.php'); break;

                default: include('order_list.php') ; break;
              }
             ?>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor\datetimepicker\jquery.datetimepicker.full.js" charset="utf-8"></script>
  </body>
</html>
