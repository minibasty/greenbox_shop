<script language="JavaScript" type="text/JavaScript">
  // เช็คตัวเลข
function key_number() {
use_key=event.keyCode
if (use_key != 13 && (use_key < 48) || (use_key > 57)) {
event.returnValue = false;
}
}
</script>
<?php
  date_default_timezone_set("Asia/Bangkok");
    function DateDMY($strDate)
  {
    list($y,$m,$d)=explode("-",$strDate);
    $dateTH=$d."-".$m."-".($y+543);
    return "$dateTH";
  }

    function DateYMD($strDate)
  {
    list($d,$m,$y)=explode("-",$strDate);
    $dateTH=($y-543)."-".$m."-".$d;
    return "$dateTH";
  }
  
  //หาค่าต่างของเดือน
  function countMonth($date1,$date2)
  {
  $interval = date_diff($date1, $date2);
  $year=$interval->format('%y');
  $month=$interval->format('%m');
  $day=$interval->format('%d');
  if ($year=="1") { $year="12"; }
  $power = $year-$month;
  return "$power";
  }

  function conYearEn($strDate)
  {
    list($d,$m,$y)=explode("-",$strDate);
    $format=($y-543)."-".$m."-".$d;
    $dateEN=date_create($format);
    return "$dateEN";
  }

  // แปลงวันที่ คศ เป็น พศ
  function YearTh($strDate)
  {
    list($d,$m,$y)=explode("-",$strDate);
    $dateTH=$d."-".$m."-".($y+543);
    return "$dateTH";
  }

    function YearTh2($strDate)
  {
    list($d,$m,$y)=explode("-",$strDate);
    $dateTH=$d."/".$m."/".($y+543);
    return "$dateTH";
  }

  // แปลงวันที่ พศ เป็น คศ
  function YearEn($strDate)
  {
    list($d,$m,$y)=explode("-",$strDate);
    $newDate=$d."-".$m."-".($y-543);
    return "$newDate";
  }

  // จำนวนเงินตัวหนังสือ
  function bahtText($amount_number)
  	{
      $amount_number = number_format($amount_number, 2, ".","");
      //echo "<br/>amount = " . $amount_number . "<br/>";
      $pt = strpos($amount_number , ".");
      $number = $fraction = "";
      if ($pt === false)
          $number = $amount_number;
      else
      {
          $number = substr($amount_number, 0, $pt);
          $fraction = substr($amount_number, $pt + 1);
      }

      //list($number, $fraction) = explode(".", $number);
      $ret = "";
      $baht = ReadNumber ($number);
      if ($baht != "")
          $ret .= $baht . "บาท";

      $satang = ReadNumber($fraction);
      if ($satang != "")
          $ret .=  $satang . "สตางค์";
      else
          $ret .= "ถ้วน";
      //return iconv("UTF-8", "TIS-620", $ret);
      return $ret;
  }

  function ReadNumber($number)
  {
      $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
      $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
      $number = $number + 0;
      $ret = "";
      if ($number == 0) return $ret;
      if ($number > 1000000)
      {
          $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
          $number = intval(fmod($number, 1000000));
      }

      $divider = 100000;
      $pos = 0;
      while($number > 0)
      {
          $d = intval($number / $divider);
          $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
              ((($divider == 10) && ($d == 1)) ? "" :
              ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
          $ret .= ($d ? $position_call[$pos] : "");
          $number = $number % $divider;
          $divider = $divider / 10;
          $pos++;
      }
      return $ret;
  }

  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }

    function DateThaiType2($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มค","กพ","มีค","เมย","พค","มิย","กค","สค","กย","ตค","พย","ธค");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay/$strMonthThai/$strYear";
  }

  function DateTime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
  }

    function DateFull($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม.","เมษายน.","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม.","กันยายน.","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return " $strDay $strMonthThai $strYear";
  }

  function NextYear($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+544;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม.","เมษายน.","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม.","กันยายน.","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return " $strDay $strMonthThai $strYear";
  }

    function Nextmonth($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return " $strDay $strMonthThai $strYear";
  }

  $strDate = date('Y-m-d', strtotime('+1 month'));
  //จบจำนวนเงิน

  function monthNum($monthStr){
    switch ($monthStr) {
      case 'มกราคม': $month="1"; break;
      case 'กุมภาพันธ์': $month="2"; break;
      case 'มีนาคม': $month="3"; break;
      case 'เมษายน': $month="4"; break;
      case 'พฤษภาคม': $month="5"; break;
      case 'มิถุนายน': $month="6"; break;
      case 'กรกฎาคม': $month="7"; break;
      case 'สิงหาคม': $month="8"; break;
      case 'กันยายน': $month="9"; break;
      case 'ตุลาคม': $month="10"; break;
      case 'พฤศจิกายน': $month="11"; break;
      case 'ธันวาคม': $month="12"; break;
    }
    return $month;
  }
    function monthShut($monthStr){
    switch ($monthStr) {
      case 'มกราคม': $month="มค"; break;
      case 'กุมภาพันธ์': $month="กพ"; break;
      case 'มีนาคม': $month="มีค"; break;
      case 'เมษายน': $month="เมย"; break;
      case 'พฤษภาคม': $month="พค"; break;
      case 'มิถุนายน': $month="มิย"; break;
      case 'กรกฎาคม': $month="กค"; break;
      case 'สิงหาคม': $month="สค"; break;
      case 'กันยายน': $month="กย"; break;
      case 'ตุลาคม': $month="ตค"; break;
      case 'พฤศจิกายน': $month="พย"; break;
      case 'ธันวาคม': $month="ธค"; break;
    }
    return $month;
  }

  function conModel($model){
    if ($model=="VT900") {
        $gpsmodel="VT900 T";
        $gpstype="iStartex";
    }elseif ($model=="VT900(A)") {
        $gpsmodel="VT900 T";
        $gpstype="iStartex";
    }elseif ($model=="VT900(U)") {
        $gpsmodel="VT900 T";
        $gpstype="iStartex";
    }elseif ($model=="GT06E") {
        $gpsmodel="GT06E";
        $gpstype="Concox";
    }elseif ($model=="T333") {
        $gpsmodel="T333";
        $gpstype="MEITRACK";
    }elseif ($model=="T1") {
        $gpsmodel="T1";
        $gpstype="MEITRACK";
    }else{
        $gpsmodel="";
        $gpstype="";
    }
    $conv=$gpsmodel."-".$gpstype;
    return $conv;
}

  function checkServer($sv){
    switch ($sv) {
      case 'greenboxsv3.com': $showSv="ตาจบ"; break;
      case 'greensv1.com': $showSv="หาร"; break;
      case 'greensv2.com': $showSv="ตี๋"; break;
      case 'greenboxsv.com': $showSv="ก๊อช"; break;
      case 'gpsgreenbox.com': $showSv="greenbox"; break;
      case 's1.gpsgreenbox.com': $showSv="s1"; break;
      case 's2.gpsgreenbox.com': $showSv="s2"; break;
      case 's3.gpsgreenbox.com': $showSv="s3"; break;
      case 's4.gpsgreenbox.com': $showSv="s4"; break;
      case 's5.gpsgreenbox.com': $showSv="s5"; break;

    }
    return $showSv;
  }
 ?>
