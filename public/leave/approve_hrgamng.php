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
$halaman = $_GET['halaman'];
//echo "ID nya $id";
 

$update = "UPDATE tr_cuti SET app_hrgamng = '1', tgl_apphrgamng = NOW() WHERE id_trcuti='$id'";

 if ($conn->query($update) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Approve  HRGA Manager Level Succesfully');
    window.location.href='view_app.php?halaman=$halaman';
    </script>");
} else {
  echo "Error: " . $update . "<br>" . $conn->error;
} 
?>
 