<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
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

$niks = $_POST['niks'];
$kode_jcuti = "CT12";
$tgl_pengajuan = $_POST['tgl_pengajuan'];  
$newtgl_pengajuan = date("Y-m-d", strtotime($tgl_pengajuan)); 
$detail_tanggal = $_POST['detail_tanggal'];
$cuti_tahun = $_POST['cuti_tahun'];
$total_hari = strlen($detail_tanggal);
$alasan = $_POST['alasan'];
$tgl_awalc = substr($detail_tanggal, 0, 10);
$newtgl_awalc = date("Y-m-d", strtotime($tgl_awalc));
$tgl_akhir = substr($detail_tanggal, -10);
$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
$total_cutis =  $_POST['total_hari'];

					date_default_timezone_set("Asia/Bangkok");
					$nowdate_forexpire = date('Y-m-d');
  
					 $sql_gm = "SELECT nama_lengkap, nik FROM `user` WHERE  level='GENERAL MANAGER'";
 					$result_gm = $conn->query($sql_gm);

					if ($result_gm->num_rows > 0) {
					  // output data of each row
					  while($row_gm = $result_gm->fetch_assoc()) {
						  $nama_gm = $row_gm["nama_lengkap"];
						  $nik_gm = $row_gm["nik"]; 
			 
					} 
					}					 
					$sql_dir = "SELECT nama_lengkap, nik FROM `user` WHERE  level='DIRECTOR'";
 					$result_dir = $conn->query($sql_dir);

					if ($result_dir->num_rows > 0) {
					  // output data of each row
					  while($row_dir = $result_dir->fetch_assoc()) {
						  $nama_dir = $row_dir["nama_lengkap"];
						  $nik_dir = $row_dir["nik"];  
					} 
					} 

 //echo "`  `$nik`, `$kode_jcuti`, `$tgl_pengajuan`, $nm_lengkap, $detail_tanggal ";
  

  $sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`, cuti_tahun, alasan,					 
					 nik_sleader, approve_sleader, tgl_appsleader, nik_spv, 
					 approve_spv, tgl_appspv, nik_manager, app_manager, 
					 tgl_appmanager, nik_hrgas, app_hrgas, tgl_apphrgas, 
					 nik_hrgaspv, app_hrgaspv, tgl_apphrgaspv, nik_hrgamng,
					 app_hrgamng, tgl_apphrgamng,nik_gm,stt_appgm,tgl_appgm, 
					 nik_pdir, stt_apppdir, tgl_apppdir, ket, ket2)
	VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					'$newtgl_akhir', '$detail_tanggal', '$total_cutis','$cuti_tahun','$alasan',
					'$nik_sleader','$approve_sleader','$tgl_appsleader', '$nik_spv',
					'$approve_spv',  '$tgl_appspv',  '$nik_manager',  '$app_manager', 
					'$tgl_appmanager', '$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
					'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
					'$app_hrgamng', '$tgl_apphrgamng','$nik_gm','0','$tgl_appgm', 
					 '$nik_dir','0', '$tgl_apppdir',  '$ket', '$ket2')";
//var_dump($sql);
 
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Tambah Data Alfa Berhasil');
    window.location.href='preadd_alpha.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}   
 
//$conn->close();
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

