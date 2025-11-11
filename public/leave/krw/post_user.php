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
	
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/head.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
 <?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
      <?php
 
  
include "assets/configure/koneksi.php";  


$nama = $_POST['nama'];
$nik = $_POST['nik'];
$hire_date = $_POST['hire_date'];
$kode_loc = $_POST['kode_loc'];
$kode_dep = $_POST['kode_dep'];
$kode_section = $_POST['kode_section'];
//$atasan_nik = $_POST['atasan_nik'];
$username = $_POST['username'];
$password = $_POST['password'];
$pass_md5 = md5($password);
$level = $_POST['level'];
$level_akses = $_POST['level_akses'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$token = md5($username);
$exp_token = "2023-04-16";
$status_aktif = "1";
 
 
 //echo"$nama, $nik, $hire_date, $kode_loc, $kode_dep, $atasan_nik, $username, $password, $level, $email, $email2 ";

 $sql = "INSERT INTO user ( id_user, nama_lengkap,
							 nik, hire_date, email,
							 email2, username, password,
							 kode_loc, kode_dep, level,level_akses,
							 kode_section, token, exp_token,status_aktif)
VALUES (NULL, '$nama', '$nik', '$hire_date', '$email', '$email2', '$username', 
				'$pass_md5', '$kode_loc', '$kode_dep','$level','$level_akses', '$kode_section',
				'$token','$exp_token','$status_aktif')";
 
  if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data New User Succesfully');
    window.location.href='reg_user.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}   

$conn->close();
?>
          </div>
          </div>
          </div>
 <!-- End of form -->
 
 
 
 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include"assets/template/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<?php include"assets/template/footerjs.php";?>

</body>

</html>

