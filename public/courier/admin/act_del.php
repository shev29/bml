<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nama_admin = $_POST['nama_admin'];  
$nikpemohon = $_POST['nikpemohon']; 
$no_order = $_POST['no_order'];   
$reason = $_POST['reason'];
 
$sql2 = "INSERT INTO `courier_genlog` (`id_log`, `id_item`, `action`, `user`, `ket`,reason) VALUES (NULL, '$no_order', 'Delete', '$nikadmin', '$nikpemohon','$reason')";

if ($conn->query($sql2) === TRUE) {
  //echo "New record created successfully";
}  					 
 
  $sql = "DELETE FROM tr_pengiriman WHERE no_order= '$no_order'";
// var_dump($sql);
   if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data deleted successfully'); 
    window.location.href='manage_order.php';
    </script>");
} else {
  echo "Error:delete<br>";
}  
 
 ?>