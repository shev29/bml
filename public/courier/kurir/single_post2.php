<?php 
include "../assets/configure/sesionkurir.php"; 
$nama_kurir = $_SESSION['nama'];
$nikkur = $_SESSION['nik'];
//echo $nikul;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
 
$nik_kurir = $_POST['nik_kurir'];  
$resi = $_POST['resi'];  
   var_dump($resi)
 //echo "$resi<br>$nik_kurir";
 //var_dump($resi);

 
	


   
  ?>