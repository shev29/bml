<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$id_kurir = $_GET['id_kurir'];  
 
 
					 
 
  $sql = "DELETE FROM courierdtl_kurir WHERE id_kurir= '$id_kurir'";
// var_dump($sql);
   if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data kurir berhasil di hapus'); 
    window.location.href='master_kurir.php';
    </script>");
} else {
  echo "Error:update<br>";
}  
 