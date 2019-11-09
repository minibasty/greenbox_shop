<?php 

$ds= DIRECTORY_SEPARATOR;  //1
 
$storeFolder = "uploads/".$_POST['chassi'];   //2
 if (is_dir($storeFolder)) {
 	$path=$storeFolder;
 }else{
 	mkdir($storeFolder);
 	$path=$storeFolder;
 }

if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $path . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
     
}

?>