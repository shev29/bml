<?php 
 
 error_reporting(0);
include "vendor/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
 
//$nik_kurir = $_POST['nik_kurir'];  
$resi = $_POST['resi']; 
$nik_kurir = $_POST['nik_kurir']; 
$count = count($resi);  
 //var_dump($resi);

 for( $i=0; $i < $count; $i++ )
{
 	$rezi = "$resi[$i]";
	$niko = "$nik_kurir[$i]";
	 
 
	//echo "$niko<br>";  
	
	 $sql = "UPDATE `tr_pengiriman` SET `nik_kurir` = '$niko' WHERE  no_order  = $rezi;";
echo "$sql<br>";
  if ($conn->query($sql) === TRUE) {
  echo "Order number $rezi submit successfully";
} else {
  echo "Error submit record: " . $conn->error;
}
  
 
}
   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data Pick Up berhasil ditambahkan');
    window.location.href='home.php';
    </script>"); 