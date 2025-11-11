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
	$nikul = $_SESSION['nik']; 
	
	//echo $username;
?> 