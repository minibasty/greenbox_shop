<!DOCTYPE html>
<?php 
include('config.php');        
 ?>
<html>
<head>
    <title></title>
    <link href="css/bs4.3.1/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" > 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
    <input id="sc" type="text" name="" value="" placeholder="Search..">
    <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 25%">ชื่อสินค้า</th>
                        <th style="width: 30%">หมายเลข S/N</th>
                        <th style="width: 20%">ราคา</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                
                <tbody id="myTable">
                    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
  </tr>
  </thead>
  <tbody id="myTable">
<?php
$q = intval($_GET['q']);
$num = 0;
$sql = "SELECT * FROM v_product WHERE id = '".$q."' ";
//////////////////// MORE QUERY
// เงื่อนไขสำหรับ radi
$keyword = isset($_GET['keyword']);
if(isset($_GET['myradio']) && $_GET['myradio']!=""){
    // ต่อคำสั่ง sql
    $sql.=" AND province_name LIKE '%".trim($_GET['myradio'])."%' ";
}

// เงื่อนไขสำหรับ input text
if(isset($_GET['keyword']) && $_GET['keyword']!=""){
    // ต่อคำสั่ง sql
    $sql.=" AND zipcode LIKE '%".trim($_GET['keyword'])."%' ";
    $sql.=" OR user LIKE '%".trim($_GET['keyword'])."%'";
    $sql.=" OR zipcode LIKE '%".trim($_GET['keyword'])."%' ";
    $sql.=" OR name LIKE '%".trim($_GET['keyword'])."%' ";
    $sql.=" OR amper LIKE '%".trim($_GET['keyword'])."%' ";
    $sql.=" OR main_user LIKE '%".trim($_GET['keyword'])."%' ";
    $sql.=" OR phone LIKE '%".trim($_GET['keyword'])."%' ";

}

// เงื่อนไขสำหรับ select
if(isset($_GET['myselect']) && $_GET['myselect']!=""){
    // ต่อคำสั่ง sql
    $sql.=" AND province_name LIKE '".trim($_GET['myselect'])."%' ";
}

// เงื่อนไขสำหรับ checkbox
if((isset($_GET['mycheckbox1']) && $_GET['mycheckbox1']!="")
|| (isset($_GET['mycheckbox2']) && $_GET['mycheckbox2']!="")){
    // ต่อคำสั่ง sql
    if($_GET['mycheckbox1']!="" && $_GET['mycheckbox2']!=""){
         $sql.="
         AND (province_name LIKE '%".trim($_GET['mycheckbox1'])."'
         OR province_name LIKE '%".trim($_GET['mycheckbox2'])."' )
         ";
    }elseif($_GET['mycheckbox1']!=""){
         $sql.=" AND province_name LIKE '%".trim($_GET['mycheckbox1'])."' ";
    }elseif($_GET['mycheckbox2']!=""){
         $sql.=" AND province_name LIKE '%".trim($_GET['mycheckbox2'])."' ";
    }else{

    }
}
//////////////////// MORE QUERY
$result=mysqli_query($conn, $sql);
$total=mysqli_num_rows($result); ?>

<?php
$e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า
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
$sql.=" ORDER BY id DESC LIMIT ".$s_page.",$e_page";
$result=mysqli_query($conn, $sql);
if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
    while($row = $result->fetch_array()){ // วนลูปแสดงรายการ
        $num++;
?>      <tr>
            <td><?= $row['pro_name'] ?></td>
            <td><?= $row['prod_sn'] ?></td>
            <td><?= $row['pro_price'] ?></td>
            <td class="text-center"><button class="btn btn-info btn-sm" type="button" onClick="opener.document.all.pro_sn.value='<?= $row['prod_sn'] ?>';window.close();">เลือก</button></td>
        </tr>
        <?php }
            }
         ?>
                </tbody>
            </table>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      $("#sc").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>