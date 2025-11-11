 <?php
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
$kode_jcuti = "CTN1";
$tgl_pengajuan = $_POST['tgl_pengajuan'];  
$newtgl_pengajuan = date("Y-m-d", strtotime($tgl_pengajuan)); 
 
$cuti_tahun = date('Y');
 
$alasan = $_POST['ct'];

//$total_cuti =  
 

$detail_tanggal = $_POST['detail_tanggal'];

$total_hari = strlen($detail_tanggal);
$tgl_awalc = substr($detail_tanggal, 0, 10);
$newtgl_awalc = date("Y-m-d", strtotime($tgl_awalc));
$tgl_akhir = substr($detail_tanggal, -10);
$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));

if ($newtgl_akhir >= '2025-02-16') {
	echo "Pengajuan baru Cuti, Izin dan Sakit untuk tanggal cuti 16 Feb 2025 sampai dengan tanggal saat ini silahkan menggunakan aplikasi Workplaze.<br>";
	exit();
}

 $total_hari = strlen($detail_tanggal);
  // Approval Post
		$nik_sleader = $_POST['nik_sleader'];
		$status_sleader = "0";
		$tgl_appsleader = $_POST['tgl_appsleader'];
		$nik_spv = $_POST['nik_spv'];
		$approve_spv = $_POST['approve_spv'];
		$tgl_appspv = $_POST['tgl_appspv'];
		$nik_manager = $_POST['nik_manager'];
		$app_manager = $_POST['app_manager'];
		$tgl_appmanager = $_POST['tgl_appmanager'];
		$nik_hrgas = $_POST['nik_hrgas'];
		$app_hrgas = $_POST['app_hrgas'];
		$tgl_apphrgas = $_POST['tgl_apphrgas'];
		$nik_hrgaspv = $_POST['nik_hrgaspv'];
		$app_hrgaspv = $_POST['app_hrgaspv'];
		$tgl_apphrgaspv = $_POST['tgl_apphrgaspv'];
		$nik_hrgamng = $_POST['nik_hrgamng'];
		$app_hrgamng = $_POST['app_hrgamng'];
		$tgl_apphrgamng = $_POST['tgl_apphrgamng'];
		$ket = $_POST['ket'];
		$ket2 = $_POST['ket2'];
		$total_cutis =  $_POST['total_hari'];
 
 
 
//------------------------ upload doc gambar pendukung
 
		
 //echo "`  `$nik`, `$kode_jcuti`, `$tgl_pengajuan`, $nm_lengkap, $detail_tanggal ";

  //var_dump($sql);
 
  
if($_POST['upload']){
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name']; 
		//echo "$nama <br>$ekstensi<br>$ukuran<br>$file_tmp";	
		 date_default_timezone_set("Asia/Bangkok");
		$datenow = date('Ymd_H');  
  
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
 //SELECT `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`, 
// `total_hari`, `doc_pendukung`, `cuti_tahun`, `alasan`, `nik_sleader`, `status_sleader`, `tgl_appsleader`, 
// `nik_check1`, `status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`, `nik_approve1`,
 //`status_approve1`, `tgl_approve1`, `nik_approve2`, `status_approve2`, `tgl_approve2`, 
 //`nik_hrgas`, `app_hrgas`, `tgl_apphrgas`, `nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`,
//`nik_hrgamng`, `app_hrgamng`, `tgl_apphrgamng`, `ket`, `ket2` FROM `tr_cuti` WHERE 1
 //if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){	
					$namabaru = "$datenow$nama_userl".".".$ekstensi;		
					move_uploaded_file($file_tmp, 'doc_pendukung/'.$namabaru);
				$sql = "INSERT INTO tr_cuti 
								( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`, 
 `total_hari`, `doc_pendukung`, `cuti_tahun`, `alasan`, `nik_sleader`, `status_sleader`, `tgl_appsleader`, 
 `nik_check1`, `status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`, `nik_approve1`,
 `status_approve1`, `tgl_approve1`, `nik_approve2`, `status_approve2`, `tgl_approve2`, 
 `nik_hrgas`, `app_hrgas`, `tgl_apphrgas`, `nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`,
 `nik_hrgamng`, `app_hrgamng`, `tgl_apphrgamng`, `ket`, `ket2`)
				VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					   '$newtgl_akhir', '$newtgl_awalc sd $newtgl_akhir', '$total_cutis','$namabaru','$cuti_tahun','$alasan',
						'$nik_sleader','$status_sleader','$tgl_appsleader', '$nik_spv',
						'$approve_spv',  '$tgl_appspv',  '$nik_manager',  '$app_manager', 
						'$tgl_appmanager', '$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
						'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
						'$app_hrgamng', '$tgl_apphrgamng','$nik_gm','0','$tgl_appgm', 
					 '$nik_dir','0', '$tgl_apppdir',  '$ket', '$ket2')";
if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Tambah data cuti normatif berhsil');
    window.location.href='preadd_cutinr.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}/* 
if ($conn->query($query) === TRUE) {
  echo "Data gambar berhasil diupload";
} else {
  echo "Error: " . $query . "<br>" . $conn->error;
} */
					if($query){
						echo 'FILE BERHASIL DI UPLOAD';
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
					}
				}else{
					echo 'Gagal ukuran file terlalu besar diatas 1MB';
				}
			/* }else{
				echo 'Ekstensi file yang diupload tidak diperbolehkan';
			}  */
		}
	 
 //---------------------------- end upload
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

