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
$kode_jcuti = "CTSKT";
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
 $total_hari = strlen($detail_tanggal);
 $total_cuti =  $_POST['total_hari'];
 
// Approval Post
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
 
 // nik GM and Dir
		date_default_timezone_set("Asia/Bangkok");
		$nowdate_forexpire = date('Y-m-d');

 
 
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
$datenow = date('Ymd_H_');
 
 
  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){	
					$namabaru = "$datenow$username".".".$ekstensi;		
					move_uploaded_file($file_tmp, '../doc_pendukung/'.$namabaru);
				$sql = "INSERT INTO tr_cuti 
								( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
								`tgl_akhir`, `detail_tanggal`, `total_hari`,doc_pendukung, cuti_tahun, alasan, 
					  `nik_sleader`, `status_sleader`, `tgl_appsleader`, `nik_check1`,
					`status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`,
					`nik_approve1`, `status_approve1`, `tgl_approve1`, `nik_approve2`, 
					`status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`, `tgl_apphrgas`,
					`nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`, 
					`tgl_apphrgamng`,  `ket`, `ket2`)
				VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					 '$newtgl_akhir', '$newtgl_awalc sd $newtgl_akhir', '$total_cuti','$namabaru','$cuti_tahun','$alasan',
					'$nik_sleader','$status_sleader','$tgl_appsleader', '$nik_check1',
					'$status_check1',  '$tgl_check1',  '$nik_check2',  '$status_check2', '$tgl_check2',
					'$nik_approve1',  '$status_approve1',  '$tgl_approve1',  '$nik_approve2',
					'$status_approve2','$tgl_approve2','$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
					'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
					'$app_hrgamng', '$tgl_apphrgamng',  '$ket', '$ket2'	)";
if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data izin sakit berhasil ditambahkan');
    window.location.href='form_sakit.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
/* if ($conn->query($query) === TRUE) {
  echo "New record created successfully";
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
			 }else{
				 echo"<div class='badge badge-warning'>Pengajuan ditolak sistem <br>
				 Harap lengkapi dengan dokumen surat sakit, file harus [.jpg, .png, jpeg]!! </div>
				 ";
			 } 
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

