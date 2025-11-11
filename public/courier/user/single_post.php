<?php 
include "../assets/sesion/sesionuser.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
 
$nik_kurir = $_POST['nik_kurir'];  
$resi = $_POST['resi'];  
   
 //var_dump($resi);

 
	  $sql = "UPDATE `tr_pengiriman` SET `nik_kurir` = '$nik_kurir' WHERE  no_order=$resi;";
//  echo "$sql<br>";
     if ($conn->query($sql) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    
    window.location.href='todayorder.php';
    </script>"); 
} else {
  echo "Error submit record: " . $conn->error;
}
   
  ?>