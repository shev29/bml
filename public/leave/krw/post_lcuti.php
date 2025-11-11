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

 
$nik = $_POST['nik'];
$total = $_POST['total'];
$tgllahir_cuti = $_POST['tgllahir_cuti'];
$ket = "Cuti Tahunan by Manual Post";
 
$tgl_lcuti = date("Y-m-d", strtotime($tgllahir_cuti)); 
$effectiveDate = date('Y-m-d', strtotime("+12 months", strtotime($tgl_lcuti)));
$thn_ambil = date("Y", strtotime($tgllahir_cuti)); 
 
 //echo"$nama, $nik, $hire_date, $kode_loc, $kode_dep, $atasan_nik, $username, $password, $level, $email, $email2 ";

 $sql = "INSERT INTO `cuti_lahir` (`id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, ket) 
 VALUES (NULL, 'CT12', '$nik', '$thn_ambil', '$total', '$tgl_lcuti', '$effectiveDate', '12', '$ket')";
 //var_dump($sql);
 
if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data cuti Succesfully');
    window.location.href='lahir_cuti.php';
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

