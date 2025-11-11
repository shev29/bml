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
	$nama_userl = $_SESSION['nama'];
	$username = $_SESSION['username'];	
	//echo $username;
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
// Variable for tr_cuti table  
$id_trcuti = $_POST['id_trcuti'];
$tgl_akhir_sebelumnya = $_POST['tgl_akhir_sebelumnya'];
$tgl_akhir = $_POST['tgl_akhir'];
$tgl_awal = $_POST['tgl_awal'];


//end of  Variable for tr_cuti table  

$niks = $_POST['niks'];
$namaewa = $_POST['namaewa']; 
$cuti_tahun = date('Y'); 
$over_cuti = $_POST['over_cuti'];  
$tgl_lahircuti = $_POST['tgl_lahircuti'];  
$newtgl_lahircuti = date("Y-m-d", strtotime($tgl_lahircuti)); 
$exp_cuti = "0000-00-00"; 
$tag = "1";
$ket =$_POST['ket'];
$kode_jcuti = "CTRPL";
 
$ket2 = "Sebelumnya cuti hamil tangga $tgl_awal sd $tgl_akhir di alokasikan ke cuti replacement 10 hari karena $ket";
 
$sql = "INSERT INTO cuti_lahir 
					(id_ctahunan, kode_jcuti, nik, tahun, jumlah, lahir_cuti, exp_cuti, tag, ket)
		VALUES (NULL,'$kode_jcuti', '$niks',  '$cuti_tahun', '$over_cuti', 	'$newtgl_lahircuti', '$exp_cuti',
					'$tag','$ket')";
 //var_dump($sql);
   if ($conn->query($sql) === TRUE) {
/*   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data Leave (Replacement) Succesfully');
    window.location.href='add_rborn.php';
    </script>"); */
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} 
$sql6 = "UPDATE `tr_cuti` SET `tgl_akhir` 	= '$tgl_akhir', 
									`ket2` 	= '$ket'
									WHERE id_trcuti ='$id_trcuti'";
 //var_dump($sql);
   if ($conn->query($sql6) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update Leave (Replacement) Succesfully');
    window.location.href='add_rborn.php';
    </script>");
} else {
  echo "Error: " . $sql6 . "<br>" . $conn->error;
}   
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

