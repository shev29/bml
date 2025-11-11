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
 
$id = $_GET['id'];
//echo "ID nya $id";
 

$update = "UPDATE tr_cuti SET app_manager = '1',`tgl_appmanager` = NOW() WHERE id_trcuti='$id'";

 if ($conn->query($update) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Approve Manager Level Succesfully');
    window.location.href='view_app.php';
    </script>");
} else {
  echo "Error: " . $update . "<br>" . $conn->error;
} 
?>
 