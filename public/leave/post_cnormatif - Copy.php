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
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
 
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
 $total_hari = strlen($detail_tanggal);
 
 
   if ($total_hari=="10"){
	$total_cuti="1";	
}
  elseif ($total_hari=="21"){
	$total_cuti='2';	
} 
  elseif ($total_hari=="32"){
	$total_cuti='3';	
} 
  elseif ($total_hari=="43"){
	$total_cuti='4';	
}
  elseif ($total_hari=="54"){
	$total_cuti='5';	
}

  elseif ($total_hari=="65"){
	$total_cuti='6';	
}
//------------------------ upload doc gambar pendukung
 
		
 //echo "`  `$nik`, `$kode_jcuti`, `$tgl_pengajuan`, $nm_lengkap, $detail_tanggal ";
/*   $sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`, cuti_tahun, alasan)
VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
				'$newtgl_akhir', '$newtgl_awalc sd $newtgl_akhir', '$total_cuti','$cuti_tahun','$alasan' )";
  var_dump($sql);
 
    if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data Leave Succesfully');
    window.location.href='preadd_cutinr.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}  */  
if($_POST['upload']){
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name']; 
//echo "$nama <br>$ekstensi<br>$ukuran<br>$file_tmp";		
 
 if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){	
					$namabaru = "$nama_userl".$nama;		 			
					move_uploaded_file($file_tmp, 'doc_pendukung/'.$namabaru);
					$query = "INSERT INTO upload (id_file, nama_file)
					VALUES (NULL, '$nama')";

if ($conn->query($query) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $query . "<br>" . $conn->error;
}
					if($query){
						echo 'FILE BERHASIL DI UPLOAD';
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
					}
				}else{
					echo 'Ukuran file terlalu besar diatas 1MB';
				}
			}else{
				echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
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

