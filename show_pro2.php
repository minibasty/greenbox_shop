<!DOCTYPE html>
<?php include('config.php'); ?>
<html>
<head>
	<title></title>
        <link href="css/bs4.3.1/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link  href="css/mystyle.css" rel="stylesheet" type="text/css" > 

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
</head>
<body>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th style="width: 25%">ชื่อสินค้า</th>
            <th style="width: 30%">รหัส SN</th>
            <th style="width: 15%">ราคา</th>
            <th style="width: 25%"></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $num=0;
    // $q = intval($_GET['q']);
    $sql="SELECT * FROM v_product WHERE ordet_id is NULL";
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable({
        select: true,
        responsive: true
    });

} );
</script>
</body>
</html>