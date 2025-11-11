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
$kode_jcuti = "ALPHA";
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

if ($newtgl_akhir >= '2025-02-16') {
	echo "Pengajuan baru Cuti, Izin dan Sakit untuk tanggal cuti 16 Feb 2025 sampai dengan tanggal saat ini silahkan menggunakan aplikasi Workplaze.<br>";
	exit();
}

$total_cutis =  $_POST['total_hari'];

date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
 
 		$nik_sleader = $_POST['tl_checker'];
		$status_sleader = "0";
		$tgl_appsleader = "0000-00-00";
		// Checked by
		$nik_check1 = $_POST['check_1'];
		$status_check1 = "0";
		$tgl_check1 = "0000-00-00";
		$nik_check2 = $_POST['check_2'];
		$status_check2 = "0";
		$tgl_check2 = "0000-00-00";
		//Approve by
		$nik_approve1 = $_POST['approve_1'];
		$status_approve1 = "0";
		$tgl_approve1 = "0000-00-00";
		
		$nik_approve2 = $_POST['approve_2'];
		$status_approve2 = "0";
		$tgl_approve2 = "0000-00-00";
		//hrga approval
		$nik_hrgas = $_POST['hrga_staff1'];
		$nik_hrgas2 = $_POST['hrga_staff2'];
		$app_hrgas = "0";
		$tgl_apphrgas = "0000-00-00";
		$nik_hrgaspv = $_POST['hrga_spv'];
		$app_hrgaspv = "0";
		$tgl_apphrgaspv = "0000-00-00";
		$nik_hrgamng = $_POST['hrga_mng'];
		$app_hrgamng = "0";
		$tgl_apphrgamng = "0000-00-00";
		$ket = $_POST['ket'];
		$ket2 = $_POST['ket2'];
 //echo "`  `$nik`, `$kode_jcuti`, `$tgl_pengajuan`, $nm_lengkap, $detail_tanggal "; 
 
  $sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`, cuti_tahun, alasan,					 
					 `nik_sleader`, `status_sleader`, `tgl_appsleader`, `nik_check1`,
					`status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`,
					`nik_approve1`, `status_approve1`, `tgl_approve1`, `nik_approve2`, 
					`status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`, `tgl_apphrgas`,
					`nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`, 
					`tgl_apphrgamng`,  `ket`, `ket2`)
	VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					'$newtgl_akhir', '$detail_tanggal', '$total_cutis','$cuti_tahun','$alasan',
					'$nik_sleader','$status_sleader','$tgl_appsleader', '$nik_check1',
					'$status_check1',  '$tgl_check1',  '$nik_check2',  '$status_check2', '$tgl_check2',
					'$nik_approve1',  '$status_approve1',  '$tgl_approve1',  '$nik_approve2',
					'$status_approve2','$tgl_approve2','$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
					'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
					'$app_hrgamng', '$tgl_apphrgamng',  '$ket', '$ket2')";
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

