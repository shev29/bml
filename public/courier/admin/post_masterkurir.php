<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin; 
//SELECT  `id_kurir`, `nik`, `no_hp_kurir`, `no_plat`, `gambar`, `position` FROM `courierdtl_kurir`
error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d'); 
$nik = $_POST['nik_kurirs'];  
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
					 
 
  $sql = "INSERT INTO `courierdtl_kurir` (`nik`, `no_hp_kurir`,  `no_plat`,   `gambar`, `position`) 
            VALUES ('$nik', '$no_hp_kurir', '$no_plat',   '$nama', '$posisi')";
  //var_dump($sql);
  if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data master kurir berhasil ditambahkan'); 
    window.location.href='master_kurir.php';
    </script>");
} else {
  echo "Error: Duplicate Entry NIK<br>";
}    
 
//$conn->close();
 
	 
?>