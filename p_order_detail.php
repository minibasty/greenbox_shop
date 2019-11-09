<head>
  <meta charset="utf-8">
  <title>พิมพ์เอกสาร</title>
    <link href="css/bs4.3.1/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style_pdf/pdf.css">
</head>
<style>
  div.a {
    font-size: 50px;
  }
  table{
    padding: 10px;
  }
</style>

<body>
  <?php
  require_once __DIR__ . '/vendor/mpdf/vendor/autoload.php';
  session_start() ;
  include('config.php');
  include('all_function.php');
  date_default_timezone_set("Asia/Bangkok");

  $select_order=$conn->query("SELECT * FROM v_order_list WHERE ord_id= $_GET[order]");
  $row=$select_order->fetch_assoc();
  // shiping Address
  $shipingAddress=$row['ship_name']." ".$row['ship_address']." ". $row['ship_province']." ".$row['ship_zipcode'];
  $address=$row['ship_address'];
  $province=$row['ship_province'];
  $phone=$row['ship_phone'];
  ?>
  <?php
  //ส่วนหัว
  $html='
  <table id="head">
    <tbody>
            <tr>
              <td style="width: 10%;">รหัสออเดอร์</td>
              <td colspan="3" style="width: 35%;">: '.$row['ord_id'].'</td>
            </tr>           <tr>
              <td class="" style="width: 10%;">ชื่อลูกค้า</td>
              <td style="width: 35%;">: '.$row['cus_name'].'</td>
              <td class="" style="width: 10%;">วันที่ซื้อ</td>
              <td style="width: 35%;">: '.DateThai($row['ord_date']).'</td>
            </tr>
            <tr>
              <td class="" style="width: 10%;">ที่อยู่จัดส่ง</td>
              <td style="width: 35%;">: '.$shipingAddress.'</td>
              <td class="" style="width: 10%;">ชื่อผู้ขาย</td>
              <td style="width: 35%;">: '.$row['emp_name'].'</td>
            </tr>
          </tbody>
  </table>';

  $html.='<div class="container">
            <h4 id="txt-list">รายการสินค้า</h4>
        <table id="list" class="table-report" style="width:1000;">
        <thead >
          <tr>
            <th>ลำดับ</th>
            <th class="border">ชื่อสินค้า</th>
            <th class="border">หมายเลขเครื่อง</th>
            <th class="border">รับประกัน</th>
            <th class="border" style="width: 15%;">ราคา</th>
          </tr>

        </thead>
        <form action="" method="post">
        <tbody>';
        $sql_detail=$conn->query("SELECT * FROM v_order_detail WHERE ord_id = $_GET[order] ORDER BY ordet_id ASC");
        $i=0;
        $sumPrice=0;
        while ($row_detail=$sql_detail->fetch_assoc()){
          $i++;
          $sumPrice+=$row_detail['pro_price'];
        $html.='<tr id="list">
            <td >'. $i.'</td>
            <td >'.$row_detail['pro_name'].'</td>
            <td >'.$row_detail['prod_sn'].'</td>
            <td >'.$row_detail['warranty'].'</td>
            <td >'.$row_detail['pro_price'].'</td>
          </tr>';
        }
        $html.='<tr>
          <td colspan="4" rowspan="" headers="" style=" font-weight: bold;">ราคารวม</td>
          <td colspan="" rowspan="" headers="" style=" font-weight: bold;">'.$sumPrice.'</td>
         </tr>
        </tbody>
        </form>
      </table>
      </div>';
  $html2='<table  class="border" id="address">
    <tbody>
      <tr>
        <td style="width:20%">ชื่อผู้ส่ง</td>
        <td>: '.$row['cus_name'].'</td>
      </tr>
      <tr>
        <td style="width:20%">ที่อยู่</td>
        <td>: '.$row['cus_address'].'</td>
      </tr>
      <tr>
        <td style="width:20%">โทร</td>
        <td>: '.$row['cus_tel'].'</td>
      </tr>
    </tbody>
  </table><br>';
  $html2.='<table style="margin-left: 50px; margin-right: 0; width: 100%;" id="address" class="border">
    <tbody>
      <tr>
        <td style="width:100px; font-size:40">ชื่อผู้รับ</td>
        <td style="font-size:40">: '.$row['ship_name'].'</td>
      </tr>
      <tr>
        <td style="width:50px; font-size:40">ที่อยู่</td>
        <td style="font-size:40">: '.$address.'</td>
      </tr>

      <tr>
        <td style="width:50px; font-size:40">เบอร์โทร</td>
        <td style="font-size:40">: '.$phone.'</td>
      </tr>
    </tbody>
  </table>';
  $html3='<table style="margin-left: 30px; width: 40%;"; id="address" class="border">
    <tbody>
      <tr>
        <td style="width:20%" align="center">ผู้ส่ง <img src="img/logo.jpg" width="150px"> Tel.0882528227</td>
      </tr>
    </tbody>
  </table><br>';

  $html3.='<table style="margin-left: 30px; margin-right: 0; width: 70%;" id="address" class="border">
    <tbody>
      <tr>
        <td colspan="2" style="text-align:center; font-size:56pt">ผู้รับ : '.$row['ship_name'].'</td>
      </tr>

      <tr>
        <td colspan="2" style="text-align:center; font-size:68pt">โทร : '.$phone.'</td>
      </tr>
      <tr>
        <td colspan="2" collapse="0" style="text-align:center; font-size:72pt;	font-weight:bold; color:red">'.$province.'</td>
      </tr>
    </tbody>
  </table>';
 ?>

  <?php
    $mpdf = new \Mpdf\Mpdf(
      ['mode' => 'utf-8', 'format' => 'A4-L',
      'default_font_size' => 16,
      'default_font' => 'sarabun',
      'margin_top' => 9,
      'margin_left' => 9,
      'margin_right' => 9,
      'mirrorMargins' => true
    ]);
    $css = file_get_contents('css/style_pdf/pdf.css');
    $mpdf->writeHTML($css, 1);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html2);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html3);
    $mpdf->Output();
   ?>
</body>

</html>
