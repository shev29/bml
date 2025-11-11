<?php 
// mengaktifkan session pada php
include 'assets/configure/koneksi.php'; // menghubungkan php dengan koneksi database
error_reporting(0);
session_start();
 
 // sintak pengamanan untuk handle sql injection
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$passmd5 = md5($password);

 
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from user where username='$username' and password='$passmd5'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 //$nama = $data['nama'];
	// cek jika user login sebagai admin
 
	if($data['level_akses']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['nik'] = $data['nik'];
		$_SESSION['level_akses'] = "admin";
		$_SESSION['nama'] = $data['nama_lengkap'];
		$_SESSION['kode_loc'] = $data['kode_loc'];
		$_SESSION['kode_dep'] = $data['kode_dep'];
		$_SESSION['kode_section'] = $data['kode_section'];
		$_SESSION['token'] = $data['token'];		 
		$_SESSION['level'] = $data['level'];		 
		//echo $data['nama'];
		// alihkan ke halaman dashboard admin
	 header("location:home.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level_akses']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['nik'] = $data['nik'];
		$_SESSION['level_akses'] = "user";
		$_SESSION['nama'] = $data['nama_lengkap'];
		$_SESSION['kode_loc'] = $data['kode_loc'];
		$_SESSION['kode_dep'] = $data['kode_dep'];
		$_SESSION['kode_section'] = $data['kode_section'];
		$_SESSION['level'] = $data['level'];		
		$_SESSION['token'] = $data['token'];		 
		// alihkan ke halaman dashboard pegawai
		header("location:staff/home.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['level']=="hrga"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level_akses'] = "hrga";
		// alihkan ke halaman dashboard pengurus
		header("location:halaman_pengurus.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{	 
		$cek_miss = "select * from user where username='$username'";
		$result_miss = $conn->query($cek_miss);
	if ($result_miss->num_rows > 0) {
			$pesan = "Error .. Wrong Password.";
  	
	}
	else{
		$pesan = "Username $username Not Exist Anymore";
	}
	// echo $pesan;
//var_dump($cek_miss)
	
 header("location:index.php?Pesan=$pesan");
 
}
 
?>