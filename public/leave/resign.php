 <?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$nama = $_SESSION['nama'];	
include "assets/configure/koneksi.php"; 	
 
$id = $_GET['id_user'];
 
//echo "ID nya $id";
 

$update = "UPDATE `user` SET `status_aktif` = '0' WHERE id_user='$id'";

   if ($conn->query($update) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data User Nonactive Berhasil');
    window.location.href='data_user.php';
    </script>");
}   else {
  echo "Error: " . $update . "<br>" . $conn->error;
}   
?>
 