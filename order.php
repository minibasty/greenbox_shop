<!DOCTYPE html>
<?php 
    include('config.php');
	include('all_function.php');
    date_default_timezone_set("Asia/Bangkok");
 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor\datetimepicker\jquery.datetimepicker.css">
	<link  href="css/mystyle.css" rel="stylesheet" type="text/css" > 
</head>
<body>
<?php 
    // query data customer
    $sql_customer="SELECT * FROM customer";
    $result_customer=$conn->query($sql_customer);

    // query data employee
    $sql_employee="SELECT * FROM employee";
    $result_employee=$conn->query($sql_employee);

 ?>
<div class="container-fluid">
    <form name="form1" action="?p=action_order" method="POST" onSubmit="return check()">
		<div class="card-body">
			<div class="container">
			<div class="form-group" style="padding: 0px">
                <div class="form-row">
                    <div class="col">
                        <h3>เพิ่มรายการสั่งซื้อ</h3>
                    </div>
                    <div class="col">
                        <a href="?p=product_detail_list" title="" hidden><button type="button" class="btn btn-info">
                        <span class="far fa-plus"></span>ดูสินค้าในสต๊อก</button></a>
                    </div>
                </div>
			</div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-2 text-right">
                            <label for="input" class="text-right">ที่อยู่จัดส่ง</label>
                        </div>
                        <div class="col-sm-9">
                        <select class="form-control" name="customer_code" id="customer_code">
                            <option value="">กรุณาเลือกลูกค้า</option>
                            <?php 
                            while($row_customer=$result_customer->fetch_assoc()){ ?>
                            <option value="<?= $row_customer['cus_id']?>"><?= $row_customer['cus_name']?></option>
                        <?php
                            }
                         ?>
                    </select>
                        </div>
                     <?php if($_SESSION['login_status']=="admin"){ ?>   
                        <div class="col-sm-1">
                          <a href="?p=customer_add" title=""><button class="btn btn-dark" type="button">เพิ่มลูกค้า</button></a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="form-group">
    				<div class="form-row">
                        <div class="col-sm-2 text-right">
                            <label for="input" class="text-right">ที่อยู่จัดส่ง</label>
                        </div>
    					<div class="col-sm-9">
    					<select id="shiping" class="form-control" name="shiping" disabled="">
                            <option value="">กรุณาเลือกลูกค้าก่อน</option>
                        </select>
    					</div>
    				</div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-2 text-right">
                            <label for="input" class="">วันที่ขาย</label> 
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control testdate5" type="text" name="order_date" value="<?= DateDMY(date("Y-m-d")) ?>" placeholder="" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group" <?php if($_SESSION['login_status'] <> "admin"){ echo "hidden"; } ?>>
                    <div class="form-row">
                        <div class="col-sm-2 text-right">
                            <label for="input" class="text-right">ชื่อผู้ขาย</label>
                        </div>
                        <div class="col-sm-9">
                        <select id="emp_id" class="form-control" name="emp_id">
                            <?php 
                            while($row_employee=$result_employee->fetch_assoc()){ ?>
                            <option value="<?= $row_employee['emp_id']?>" <?php if($row_employee['emp_id']==$_SESSION['login_id']) { echo "selected"; } ?>><?= $row_employee['emp_name']." | ".$row_employee['emp_status']?></option>
                        <?php
                            }
                         ?>                        </select>
                        </div>
                    </div>
                </div>                
            </div>
		<div class="container text-center" style="padding : 10px">
			<button class="btn btn-success" type="submit">บันทึก</button>
		</div>
	</div>
    </form>
</div>
	<script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="vendor\datetimepicker\jquery.datetimepicker.full.js" charset="utf-8"></script>

    
    <script>
    $(function(){
        $("#customer_code").change(function() {
            var cus_id = $(this).val();
            $.get("ajaxData.php",{cust_id:cus_id},function(data){
                $("#shiping").children().remove().end();
                $("#shiping").children().end().append(data);
                $("#shiping").removeAttr('disabled');
            });
        });
    });
    </script>

 
    <script type="text/javascript">

    // Datetimepicker
    $(function(){
    // กรณีใช้แบบ inline
    $("#testdate4").datetimepicker({
        timepicker:false,
        format:'d-m-Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        inline:true
    });


    // กรณีใช้แบบ input
    $(".testdate5").datetimepicker({
        zIndex: 2048,
        timepicker:false,
        format:'d-m-Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;
            var yearTH=yearT+543;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
    });
    // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
    $(".testdate5").on("mouseenter mouseleave",function(e){
        var dateValue=$(this).val();
        if(dateValue!=""){
                var arr_date=dateValue.split("-"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
                // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
                //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0
                if(e.type=="mouseenter"){
                    var yearT=arr_date[2]-543;
                }
                if(e.type=="mouseleave"){
                    var yearT=parseInt(arr_date[2])+543;
                }
                dateValue=dateValue.replace(arr_date[2],yearT);
                $(this).val(dateValue);
            }
        });
    });
    // END Datetimepicker


    // เช็คค่าว่าง
    function check() {
        if (document.form1.customer_code.value == "") {
            alert("กรุณาเลือกชื่อลูกค้า");
            document.form1.customer_code.focus();
            return false;
          }
        if (document.form1.shiping.value == "") {
            alert("กรุณาเลือกที่อยู่จัดส่ง");
            document.form1.shiping.focus();
            return false;
          }
        if (document.form1.shiping.value == "") {
            alert("กรุณาเลือกที่อยู่จัดส่ง");
            document.form1.shiping.focus();
            return false;
          }    
    }

    function checkCustomer(){
        if (document.form1.customer_code.value == "") {
            alert("กรุณาเลือกชื่อลูกค้า");
            document.form1.customer_code.focus();
            return false;
        }
    }
</script>
</body>
</html>