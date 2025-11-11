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
   
 //var_dump($resi);

 
	  $sql = "UPDATE `tr_pengiriman` SET `nik_kurir` = '$nik_kurir' WHERE  no_order=$resi;";
   //echo "$sql<br>";
    if ($conn->query($sql) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    
    window.location.href='transfer_kurir.php';
    </script>"); 
} else {
  echo "Error submit record: " . $conn->error;
}
   
  ?>