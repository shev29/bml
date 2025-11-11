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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Pengajuan Cuti Bersama</p>
                  <div class="row">
                    <div class="col-12">

  
<?php 
include "assets/configure/koneksi.php";  

$niks = $_POST['niks'];
$kode_jcuti = "CT12";
$tgl_pengajuan = $_POST['tgl_pengajuan'];  
$newtgl_pengajuan = date("Y-m-d", strtotime($tgl_pengajuan)); 
$detail_tanggal = $_POST['detail_tanggal'];
$cuti_tahun = $_POST['tahun_cbersama'];
$total_hari = strlen($detail_tanggal);
$alasan = $_POST['alasan'];
$tgl_awalc = substr($detail_tanggal, 0, 10);
$newtgl_awalc = date("Y-m-d", strtotime($tgl_awalc));
$tgl_akhir = substr($detail_tanggal, -10);
$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
$total_cutis =  $_POST['total_hari'];
 
$sql = "SELECT(SELECT COUNT(nik)  FROM   user) AS Total_Employees,
				`id_user`, `nama_lengkap`, `nik`,
				`hire_date`, `email`, `email2`, 
				`username`, `password`, `kode_loc`,
				`kode_dep`, `level`, `level_akses`, 
				  `token`, `exp_token`, 
				`status_aktif`
			FROM `user` where nik='$niks' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $no='0';
  while($row = $result->fetch_assoc()) {
	  $no++;
 	  $gen_nik = $row['nik'];
 	  $nama_lengkap = $row['nama_lengkap'];
	  $nm_kecil = strtolower($nama_lengkap);
	  $nmt_new = ucwords($nm_kecil);
	  $Total_Employees = $row['Total_Employees'];
	  
     //insert cuti bersama";
     
  $sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`, cuti_tahun, alasan,ket,
					
					`nik_sleader`, `status_sleader`, `tgl_appsleader`,
					`nik_check1`,	`status_check1`, `tgl_check1`, 
					`nik_check2`, `status_check2`,	`tgl_check2`,
					
					`nik_approve1`, `status_approve1`, `tgl_approve1`, 
					`nik_approve2`, `status_approve2`, `tgl_approve2`,
					`nik_hrgas`, `app_hrgas`, `tgl_apphrgas`,
					
					`nik_hrgaspv`,`app_hrgaspv`, `tgl_apphrgaspv`,
					`nik_hrgamng`, `app_hrgamng`, `tgl_apphrgamng`
					
					)
VALUES (NULL, '$gen_nik', '$kode_jcuti', '$newtgl_pengajuan','$newtgl_awalc', 
        '$newtgl_akhir', '$newtgl_awalc sd $newtgl_akhir', '$total_cutis','$cuti_tahun','$alasan','CTBRSM',
				'120000010','1','$newtgl_pengajuan',
				'120000010','1','$newtgl_pengajuan',
				'120000010','1','$newtgl_pengajuan',
				
				'120000010','1','$newtgl_pengajuan', 
				'120000010','1','$newtgl_pengajuan',
				'120000010','1','$newtgl_pengajuan',	
				
				'120000010','1','$newtgl_pengajuan',
				'120000010','1','$newtgl_pengajuan'	
				)";
  //var_dump($sql);
  echo "<br>";
  if ($conn->query($sql) === TRUE) {
	   
  echo ("Karyawan dengan Nama <div class='badge badge-success'>$nmt_new</div> 
		berhasil di proses $no dari Total $Total_Employees Karyawan");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}  
  }
} else {
  echo "0 results";
}
 

  
 
//$conn->close();
?>
 
                    </div>
                  </div>
                  </div>
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

