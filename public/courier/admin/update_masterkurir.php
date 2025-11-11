<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nik = $_POST['nik'];  
$no_hp_kurir = $_POST['no_hp_kurir'];  
$no_plat = $_POST['no_plat'];   
$posisi = $_POST['position'];
$courier_akses = $_POST['courier_akses'];  
 
 
 $ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
 		
					move_uploaded_file($file_tmp, '../img/'.$nama);
					 
 
  $sql = "UPDATE `courierdtl_kurir` SET `no_hp_kurir` = '$no_hp_kurir',no_plat='$no_plat',position='$posisi', gambar='$nama'  WHERE  nik=$nik";
  //var_dump($sql);
   $sql2 = "UPDATE `user` SET `courier_akses` = '$courier_akses'  WHERE  nik=$nik";
 
  if ($conn->query($sql2) === TRUE){echo "Courier Akses $courier_akses";}
  if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data master kurir berhasil dirubah'); 
    window.location.href='master_kurir.php';
    </script>");
} else {
  echo "Error:update<br>";
}  
 
 