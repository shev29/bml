<?php
session_start();
error_reporting(0); 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$leveled = $_SESSION['level'];
	$nama = $_SESSION['nama'];	
	$username = $_SESSION['username'];	
	$kode_loca = $_SESSION['kode_loc'];
	$kode_depo = $_SESSION['kode_dep'];
	$kode_section = $_SESSION['kode_section'];
	$nikso = $_SESSION['nik'];
	$tokens = $_SESSION['token'];
	//echo $username;
	?>