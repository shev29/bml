 <?php
 session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['courier_akses']==""){
		header("location:../index.php?Pesan=Maaf anda harus login user!");
	}
	elseif($_SESSION['courier_akses']!="user"){
		header("location:../index.php?Pesan=Maaf anda harus login user!");
	}
 
	$courier_akses = $_SESSION['courier_akses'];
	$level_akses = $_SESSION['level_akses'];
	$namas = $_SESSION['nama'];	
	$username = $_SESSION['username'];	
	$nikso = $_SESSION['nik'];
	$kode_section = $_SESSION['kode_section'];
 
	$emails_ses = $_SESSION['email'];
	
	//echo $username;
?> 