 <?php
include "assets/configure/sesionadmin.php";
?> 
<?php 
error_reporting(0);
include "../assets/configure/sesion.php";
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
		error_reporting(0);  
        $total_cutis =  $_POST['total_hari'];
 
        if (empty($total_cutis)) {
             echo "Error Jumlah cuti kosong / Total Leave cannot be empty.<br>";
            }
            else{
		$cuti_tahun = $_POST['cuti_tahun'];
		$niks = $_POST['niks'];
		
        $sql_hitung = "SELECT  sum(total_hari)as total_ambil FROM `tr_cuti` 
                WHERE cuti_tahun='$cuti_tahun' AND nik='$niks' AND kode_jcuti='CT12'";
        $result_hitung = $conn->query($sql_hitung);
        //var_dump($sql_hitung);
        if ($result_hitung->num_rows > 0) {
    // output data of each row
    while($row_hitung = $result_hitung->fetch_assoc()) {
      $total_ambil = $row_hitung['total_ambil']; 
    //echo " $jml_ct <br>";
    }
    } 
     // Hitung jumlah cuti yang dimiliki dalam tahun pengambilan 
  $sql_jmlct = "SELECT  `id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, `ket` 
                FROM `cuti_lahir` 
                WHERE tahun='$cuti_tahun' AND nik='$niks' AND kode_jcuti='CT12'";
$result_jmlct = $conn->query($sql_jmlct);
 //var_dump($sql_jmlct);
if ($result_jmlct->num_rows > 0) {
  // output data of each row
  while($row_jmlct = $result_jmlct->fetch_assoc()) {
      $jml_ct = $row_jmlct['jumlah'];
      $cuti_stahun = $row_jmlct['tahun'];
    //echo " $jml_ct <br>";
  }
} 
else{
    $jml_ct=0;
}
$sisa = $jml_ct-$total_ambil;
//echo"Sisa $sisa<br> jumlah cuti: $jml_ct<br>";
        //Validasi Cuti dan sisa
        //echo"total $total_cutis >$sisa";
           if ($total_cutis >$sisa) {
 
                
                echo"Mohon maaf cuti  $cuti_tahun anda tidak mencukupi /
                <br>Silahkan  <a href='preadd_izin.php'<button class='btn btn-inverse-success btn-fw'>Ajukan Izin</button> </a> jika cuti anda habis";
            }
            else {
               
          
		 
		$kode_jcuti = $_POST['kode_jcuti'];
		$tgl_pengajuan = $_POST['tgl_pengajuan'];  
		$newtgl_pengajuan = date("Y-m-d", strtotime($tgl_pengajuan)); 
		$detail_tanggal = $_POST['detail_tanggal'];
		$cuti_tahun = $_POST['cuti_tahun'];
		$total_hari = strlen($detail_tanggal);
		// $alasan1 = $_POST['alasan1'];
		// $alasan2 = $_POST['alasan2'];
		// $alasan3 = $_POST['alasan3'];
		// $alasan4 = $_POST['alasan4'];
		// $alasan = "$alasan1 $alasan2 $alasan3 $alasan4";
		$alasan = $_POST['alasan'];
		$tgl_awalc = substr($detail_tanggal, 0, 10);
		$newtgl_awalc = date("Y-m-d", strtotime($tgl_awalc));
		$tgl_akhir = substr($detail_tanggal, -10);
		$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
		
		$id_cutirplcmn =  $_POST['id_cutirplcmn']; 

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
 		date_default_timezone_set("Asia/Bangkok");
		$nowdate_forexpire = date('Y-m-d'); 
		$sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`,  `cuti_tahun`, 
					`alasan`, `nik_sleader`, `status_sleader`, `tgl_appsleader`, `nik_check1`,
					`status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`,
					`nik_approve1`, `status_approve1`, `tgl_approve1`, `nik_approve2`, 
					`status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`, `tgl_apphrgas`,
					`nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`, 
					`tgl_apphrgamng`,  `ket`, `ket2`)
			VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					'$newtgl_akhir', '$detail_tanggal', '$total_cutis','$cuti_tahun',
					'$alasan','$nik_sleader','$status_sleader','$tgl_appsleader', '$nik_check1',
					'$status_check1',  '$tgl_check1',  '$nik_check2',  '$status_check2', '$tgl_check2',
					'$nik_approve1',  '$status_approve1',  '$tgl_approve1',  '$nik_approve2',
					'$status_approve2','$tgl_approve2','$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
					'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
					'$app_hrgamng', '$tgl_apphrgamng',  '$ket', '$ket2')
					";
//var_dump($sql);
   
   if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}    
 
$sqlupdate = "UPDATE cuti_lahir SET tag ='0' WHERE id_ctahunan ='$id_cutirplcmn'";
//var_dump($sql);
 //echo $sqlupdate;
   if ($conn->query($sqlupdate) === TRUE) {
     echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data cuti tahunan berhasil ditambahkan/New leave created successfully.');
    window.location.href='getmail_lev1.php?getid=$last_id';
    </script>");  
}  else {
  echo "Error: " . $sqlupdate . "<br>" . $conn->error;
}        
  
//$conn->close();

/// end off validasi jumlah sisa cuti 
  }
// end cuti kosong

}

?>
      
          </div>
          </div>
          </div>
 <!-- End of form -->
 <!-- Email -->

 
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

