<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="fontawesome/css/all.css"> -->
  <link rel="stylesheet" href="vendor\datetimepicker\jquery.datetimepicker.css">
</head>
<body>
  <?php
  require'config.php';
  require'pagination_function.php';
   ?>
  <div class="card-body">
    <form name="form1" method="POST" action="" autocomplete="off">
      <br>
      <div class="form-group form-row ">
        <div class="col-sm-6 offset-sm-3 form-inline">
          <!-- <input type="text" name="selectDate" class="form-control col testdate5" autocomplete="off" readonly placeholder="ค้นหาจากวันที่หมดอายุซิม" value="<?=(isset($_GET['selectDate']))?$_GET['selectDate']:""?>">
          &nbsp -->
          <input type="text" name="keyword" class="form-control col" autocomplete="off" placeholder="หมายเลขสินค้า" value="<?=(isset($_GET['keyword']))?$_GET['keyword']:""?>">
        </div>
        <div class="col-sm-3 form-inline">
          <button type="submit" class="btn btn-primary">ค้นหา</button>
          &nbsp;
          <a href="" class="btn btn-danger">ล้างค่า</a>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover table-sm">
        <thead>
          <tr class="text-center bg-success text-white">
            <th style="width:auto">รหัสสินค้า</th>
            <th style="width:20%">ชื่อสินค้า</th>
            <th style="width:20%">หมายเลขสินค้า</th>
            <th style="width:auto">รหัสออเดอร์</th>
            <th style="width:auto">ชื่อลูกค้า</th>
            <th style="width:auto">ดูออเดอร์</th>
          </tr>
        </thead>
        <tbody>

          <?php
$num = 0;
$month = date("m");
$day = 5;
$year = date("Y")+543;
$now = date("Y-m-d" ,strtotime("+3 DAY"));
$sql = "SELECT
  `product_detail`.`pro_id`,
  `product`.`pro_name`,
  `product`.`pro_price`,
  `product_detail`.`prod_id`,
  `product_detail`.`prod_sn`,
  `order_detail`.`ordet_id`,
  `order_detail`.`ord_id`,
  `order_detail`.`warranty`,
  `customer`.`cus_name`
FROM
  (`product_detail`
  JOIN `product` ON `product`.`id` = `product_detail`.`pro_id`)
  LEFT JOIN `order_detail` ON `order_detail`.`prod_id` =
    `product_detail`.`prod_id`
  LEFT JOIN `order_list` ON `order_list`.`ord_id` = `order_detail`.`ord_id`
  LEFT JOIN `customer` ON `customer`.`cus_id` = `order_list`.`cus_id`";

$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

if(isset($_GET['myradio']) && $_GET['myradio']!=""){
    // ต่อคำสั่ง sql
    $sql.=" AND province_name LIKE '%".trim($_GET['myradio'])."%' ";
}

if(isset($keyword) && $keyword!=""){
    // ต่อคำสั่ง sql
    $sql .= " WHERE ";
    $sql.=" prod_sn LIKE '%".trim($keyword)."%' ";
}

//////////////////// MORE QUERY
$result=mysqli_query($conn, $sql);
$total=mysqli_num_rows($result); ?>
          <!-- แสดงจำนวนทั้งหมด -->
          <div class="alert alert-warning" role="alert">
            <?php
    echo "คำค้น ( ";
    if ($keyword)
    {
      echo $keyword;
    }
    else
    {
      echo "ทั้งหมด";
    }
      echo " )";
    ?>
            จำนวนทั้งหมด
            <font color=red><?=$total ?></font>
            รายการ
          </div>

          <?php
$e_page=15; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า
$step_num=0;
if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){
    $_GET['page']=1;
    $step_num=0;
    $s_page = 0;
}else{
    $s_page = $_GET['page']-1;
    $step_num=$_GET['page']-1;
    $s_page = $s_page*$e_page;
}
$sql.=" ORDER BY ord_id DESC LIMIT ".$s_page.",$e_page";
// echo $sql;
$result=mysqli_query($conn, $sql);
if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
    while($row = $result->fetch_array()){ // วนลูปแสดงรายการ
?>
          <td class="text-center"><?= $row['prod_id'] ?></td>
          <td class="text-center"><?= $row['pro_name'] ?></td>
          <td class="text-center"><?= $row['prod_sn'] ?></td>
          <td class="text-center"><?= $row['ord_id'] ?></td>
          <td class="text-center"><?= $row['cus_name'] ?></td>
          <td class="text-center">
          <a href="?p=order_detail&order=<?= $row['ord_id'] ?>"><button class="btn btn-info btn-sm" type="button" name="button" data-toggle="modal" data-target="#addbill<?= $row['user'] ?>">
              <i class="fas fa-eye"></i>
            </button></a>
          </td>
          </tr>

          <?php
// loop while
    }
    //บันทึกบิล
    if (isset($_POST['save']))
    {
      $check=$_POST['check'];
      $sim_money=$_POST['sim_money'];
      // $sim_money=DateYMD($sim_money);

      $simexp=$_POST['simexp'];
      $simexp=DateYMD($simexp);

      $yy3=(date("Y")+543);
      $timenow = date("d-m-$yy3 H:i:s");
       $check="UPDATE member SET
        sim_money='$sim_money',
        simexp='$simexp',
        sim_manage='$_SESSION[login_true]',
        sim_stamp=NOW()
         WHERE user='$check'";
      $rs_check=$conn->query($check);
      if ($rs_check) {
        print "<meta http-equiv=refresh content=0;URL=sim.php?update=1&selectDate=$_GET[selectDate]&keyword=$_GET[keyword]>";
      }else {
        print "<meta http-equiv=refresh content=0;URL=sim.php?update=0&selectDate=$_GET[selectDate]&keyword=$_GET[keyword]>";
      }
    }
}
?>

        </tbody>
      </table>

      <?php
page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page,$_GET);
?>
    </div>

    <br>

    <br>
    <!-- ปิด card body -->
  </div>
</body>

</html>
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
