<?php 
 
include 'assets/configure/koneksi.php';
error_reporting(0);
session_start();
 
 
	$username = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$passmd5 = md5($password);	
	//echo $username;
	//echo $password;
 


$sql = "select * from user where email='$username' and password='$passmd5'";
//var_dump($sql);
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:home.php");
}
 

else {
		$cek_miss = "select * from user where email='$username'";
		$result_miss = $conn->query($cek_miss);
	if ($result_miss->num_rows > 0) {
			$pesan = "Error .. Wrong Password.";
  	
	}
	else{
		$pesan = "Email $username Not Exist Anymore";
	}
	// echo $pesan;
//var_dump($cek_miss)
	
 header("location:index.php?Pesan=$pesan");
}
 
 
 
$conn->close();
 
?>