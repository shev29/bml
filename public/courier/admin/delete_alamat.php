<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$id_alamat = $_GET['id_a'];  
 
 
					 
 
  $sql = "DELETE FROM courierm_alamat WHERE id_alamat= '$id_alamat'";
// var_dump($sql);
   if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data alamat berhasil di hapus'); 
    window.location.href='master_alamat.php';
    </script>");
} else {
  echo "Error:update<br>";
}  
 