 <?php
 session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:../index.php?Pesan=Maaf anda harus login user!");
	}
	elseif($_SESSION['level_akses']!="user"){
		header("location:../index.php?Pesan=Maaf anda harus login user!");
	}
 
	$level_akses = $_SESSION['level_akses'];
	$namas = $_SESSION['nama'];	
	$username = $_SESSION['username'];	
	$nikso = $_SESSION['nik'];
	$kode_loca = $_SESSION['kode_loc'];
	$kode_depo = $_SESSION['kode_dep']; 
	$kode_section = $_SESSION['kode_section']; 
	$leveled = $_SESSION['level'];
	$tokens = $_SESSION['token'];
	
	//echo $username;
?> 