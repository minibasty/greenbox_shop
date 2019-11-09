<?php
  //ไฟล์เชืิ่อมต่อ DB --PHP 7
  include("../conn.php");
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/r-2.1.0/se-1.2.0/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="vendor/datatable/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="vendor/datatable/css/responsive.bootstrap.min.css">

    <!-- icon -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>


    <script type="text/javascript" src="vendor/datatable/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/datatable/js/datatables.min.js"></script>
    </script>

    <script>
    $(document).ready(function() {
       var table = $('#example').DataTable({
          'ajax': '',
          'responsive': {
             'details': {
                'type': 'column',
                'target': 0
             }
          },
          'columnDefs': [
             {
                'data': null,
                'defaultContent': '',
                'className': 'control',
                'orderable': false,
                'targets': 0
             }
          ],
          'columns': [
             { 'data': null },
             { 'data': 0 },
             { 'data': 1 },
             { 'data': 2 },
             { 'data': 3 },
             { 'data': 4 },
             { 'data': 5 },
             { 'data': 6 },
             { 'data': 7 },
             { 'data': 8  },
             { 'data': 9 },
             { 'data': 10 }
          ],
          'select': {
             'style': 'multi',
             'selector': 'td:not(.control)'
          },

       });
    });
    </script>

  </head>
  <?php
  // คำสั่งดึงข้อมูลจาก Database
  $sql="SELECT * FROM member order by id desc limit 100 ";
  $result=$conn->query($sql);

   ?>
  <body>
    <br/>
  <div class="container">
      <div class="card">
        <div class="card-header">
            <p>ตาราง</p>
        </div>

  			<div class="card-body">

  				<form>
  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
     <thead>
        <tr>
          <th></th>
           <th>เลขที่เอกสาร</th>
           <th>ชื่อผู้ประกอบการ</th>
           <th>IMEI</th>
           <th>ทะเบียนรถ</th>
           <th>เลขคัทซี</th>
           <th>วันที่เพิ่มข้อมูล</th>
           <th class="none">เบอร์ ติดต่อลูกค้า :</th>
           <th class="none">เบอร์ Sim ในเครื่อง :</th>
           <th class="none">User ลูกค้า :</th>
           <th class="none">ดิวจ่ายเงินรอบต่อไป :</th>
           <th class="none">คอมเม้น :</th>

        </tr>
     </thead>
     <tbody>
       <?php
       while ($rs=$result->fetch_assoc()) {
        ?>
        <tr>
          <td></td>
          <td><?= $rs['age']."-". $rs[member_id] ?></td>
          <td><?= $rs['name'] ?>555</td>
          <td><?= $rs[zipcode] ?></td>
          <td><?= $rs[amper] ?></td>
          <td><?= $rs[user] ?></td>
          <td><?= $rs[signup] ?></td>
          <td><?= $rs[contrack] ?></td>
          <td><?= $rs[simno] ?></td>
          <td><?= $rs[phone] ?></td>
          <td>27-11-2561</td>
          <td>รถปกติ</td>
        </tr>
      <? } ?>
     </tbody>
  </table>
  </form>
  </div>
  </div>

  </div>

    </body>
  </html>
