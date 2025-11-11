<?php 
// mengaktifkan session pada php
include 'assets/configure/koneksi.php'; // menghubungkan php dengan koneksi database
//error_reporting(0);
session_start();

$idload = $_GET['id_trcuti'];
$sqlxx = "SELECT  id_trcuti,nik_check1 FROM `tr_cuti` WHERE status_check1='1' and id_trcuti='$idload'";
//var_dump($sqlxx);
$resultxx = $conn->query($sqlxx);
if ($resultxx->num_rows > 0) {
  // output data of each row
  while($rowxx = $resultxx->fetch_assoc()) {
    echo "Leave request has been approved.<br>
    Pengajuan cuti telah disetujui.";
  }
} else {
  

 // sintak pengamanan untuk handle sql injection
	$user_temp = $_GET['user'];
	$token_temp = $_GET['token'];
	$nik_atasan = $_GET['nikp'];
 
// menyeleksi data user dengan username dan password yang sesuai

	date_default_timezone_set("Asia/Bangkok");
	$dtime_now = date('Y-m-d h:i:s');
 
 $sqltemp = "select * from user where username='$user_temp' and token='$token_temp' 
							and exp_token>'$dtime_now'";
$resulttemp = $conn->query($sqltemp);
  //var_dump($sqltemp);
if ($resulttemp->num_rows > 0) {
  // output data of each row
  while($rowtemp = $resulttemp->fetch_assoc()) {
?>


<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/headform.php"; ?>

</head>
<body>
  <div class="container-scroller"> 
    <div class="container-fluid page-body-wrapper"> 
      <div class="main-panel">
        <div class="content-wrapper"> 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <center><h4 class="card-title">Leave Approval 1</h4></center>

 <?php
 $id_trcuti = $_GET['id_trcuti'];

 $token = $_GET['token'];
 //$kode_section = $_GET['kode_section'];
    include "assets/configure/koneksi.php"; 
 
 $sql = "SELECT `id_trcuti`, tr_cuti.nik, nama_lengkap, jenis_cuti.nama_cuti,
 `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`, `total_hari`,
 `cuti_tahun`, `alasan`,`nik_sleader`, `status_sleader`, `tgl_appsleader`, `nik_check1`,
 `status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`, `nik_approve1`,
 `status_approve1`, `tgl_approve1`, `nik_approve2`, `status_approve2`, `tgl_approve2`, 
 tr_cuti.ket, tr_cuti.ket2, user.kode_loc, user.kode_section FROM `tr_cuti` 
INNER JOIN user ON tr_cuti.nik = user.nik 
INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti 
WHERE id_trcuti='$id_trcuti' GROUP BY id_trcuti order by id_trcuti DESC";
 
//var_dump($sql);
$result = $conn->query($sql);

 

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
$warnaGenap = "#CCCCCC";   // warna abu-abu
$warnaGanjil = "#FFFFFF";  // warna putih
$warnaHeading = "#FF0000";

  while($row = $result->fetch_assoc()) {
	    if ($no % 2 == 0)
		$warna = $warnaGenap;
	else $warna = $warnaGanjil;
		$id_trcuti = $row['id_trcuti'];
		$nik = $row['nik'];
		$nik_check1 = $row['nik_check1'];
		$nama_lengkap = $row['nama_lengkap'];
		$total_hari = $row['total_hari'];
		$nm_kecil = strtolower($nama_lengkap);
		$nmt_new = ucwords($nm_kecil);
		$nm_cuti = $row['nama_cuti'];	   
		$partnama_cuti = explode(" ", $nm_cuti); 
		$nama_cuti = $partnama_cuti[1]; 
		$nm_depan = explode(" ", $nmt_new);
		$nama_depan = $nm_depan[0]; // piece1 
	  
	  //$nm_lengkap = ucwords($nama_lengkap);
        $detail_tanggal = $row['detail_tanggal']; 
        $detail_date = explode(",", $detail_tanggal);
        $datail_date1 =  $detail_date[0]; // piece1
        $datail_date2 =  $detail_date[1];
        $datail_date3 =  $detail_date[2];
	    $datail_date4 =  $detail_date[3];
	    $datail_date5 =  $detail_date[4];
	    $datail_date6 =  $detail_date[5];
        $datail_date7 =  $detail_date[6];
	    $datail_date8 =  $detail_date[7];
	    $datail_date9 =  $detail_date[8];
        $datail_date10 =  $detail_date[6];
	    $datail_date11 =  $detail_date[7];
	    $datail_date12 =  $detail_date[8];
	    $alasan = $row['alasan'];
	  
	 
	  $tgl_pengajuan = $row['tgl_pengajuan'];
	  $tgl_ajuan = date('d M Y', strtotime($tgl_pengajuan));
	  $tgl_awalc = $row['tgl_awalc'];
	  $newtgl_awalc = date('d M Y', strtotime($tgl_awalc));
	  $tgl_akhir = $row['tgl_akhir'];	 
	  $newtgl_akhir = date('d M Y', strtotime($tgl_akhir));
 
}}
   ?>               <center>
                    <table border='0'>
                    <tr><td>Name</td><td>:</td><td> <?php echo $nama_lengkap;?></td><tr>
                     <tr><td>NIK</td><td>:</td><td> <?php echo $nik;?></td><tr>
                    <tr><td>Leave Type</td><td>:</td><td> <?php echo $nm_cuti;?></td><tr> 
                    <tr><td>Total</td><td>:</td><td> <?php echo $total_hari;?>Hari</td><tr>
                    <tr><td>Reason</td><td>:</td><td> <?php echo $alasan;?></td><tr>
                    <tr><td>Detail Date</td><td>:</td><td> <?php echo  $datail_date1;?></td></tr> 
                    <tr><td></td><td></td><td> <?php echo  $datail_date2;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date3;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date4;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date5;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date6;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date7;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date8;?><td></tr>
                    <tr><td></td><td></td><td> <?php echo  $datail_date9;?><td></tr>
                    </table>
 
					<a href='reject_mail.php?id=<?php echo $id_trcuti;?>'><label class="badge badge-danger">Reject</label> </a>					
					<a href='approve_check1.php?id=<?php echo $id_trcuti;?>&&nik_check1=<?php echo $nik_atasan;?>&&nik_pemohon=<?php echo $nik;?>'><label class="badge badge-warning">Approve</label> </a>
                    </center>
                </div>
                  Leave Balance 
                     <table id="dynamic-table"  border="1" style='border: 1px solid #fff; font-family: sans-serif; color: #232323;  border-collapse: collapse;
					} '> 
                        <thead>
                        <tr style='background: #35A9DB;color:#fff;font-weight:normal;'>
 						  
                          <th>Year</th>						  
                          <th>Ttl</th>						  
                          <th>Used</th>						  
                          <th>Balnc</th>						  
                          <th>Start</th>						  
                          <th>Exp</th> 				  
 
                        </tr>  
                      </thead>
                      <tbody>
<?php 
 
 $sql = "SELECT `id_ctahunan`, `nama_cuti`,nama_lengkap, cuti_lahir.nik, `tahun`,
				`jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, cuti_lahir.ket 
		 FROM `cuti_lahir` 
		 left JOIN jenis_cuti ON cuti_lahir.kode_jcuti=jenis_cuti.kode_jcuti
		 INNER JOIN user ON cuti_lahir.nik=user.nik
		 WHERE cuti_lahir.nik='$nik'";
 //var_dump($sql);
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
$warnaGenap = "#CCCCCC";   // warna abu-abu
$warnaGanjil = "#FFFFFF";  // warna putih
$warnaHeading = "#FF0000";

  while($row = $result->fetch_assoc()) {
	    if ($no % 2 == 0)
		$warna = $warnaGenap;
	else $warna = $warnaGanjil;
	  $id_ctahunan = $row['id_ctahunan'];
	  	  $nm_cuti = $row['nama_cuti']; 
		$singlename = explode(" ", $nm_cuti);
		$nama_cuti = $singlename[1]; // piece1
	  $nama_lengkap = $row['nama_lengkap'];
	  $nm_kecil = strtolower($nama_lengkap);
	  $nmt_new = ucwords($nm_kecil);
	  
	  $nik = $row['nik'];
	  $tahun = $row['tahun'];
	  $jumlah = $row['jumlah'];
	  $lahir_cuti = $row['lahir_cuti']; 
	  $lhr_cuti = date('d/m/y', strtotime($lahir_cuti));
	  $exp_cuti = $row['exp_cuti'];
	  $expired_cuti = date('d/m/y', strtotime($exp_cuti));
	  
	 if(strtotime($row['exp_cuti']) > 0){
     $showexpcuti=$expired_cuti;
 }else{
     $showexpcuti="<center><img src='images/tthinggas.png' width='60' height='20'>";
 }
 
	  $tag = $row['tag'];
	  $ket = $row['ket'];
/*  SELECT Sum(total_hari) as cuti_tahunan FROM `tr_cuti` WHERE kode_jcuti='CT12' CTIZ
ALPHA
CTBSM
CT12
CTO5 */
/* $resultalpha = mysqli_query($conn, "SELECT SUM(total_hari)as total_alpha FROM `tr_cuti` WHERE nik='$nik'AND cuti_tahun='$tahun'
									AND kode_jcuti='ALPHA'");
				 
						// tampilkan query
							$rowalpha=mysqli_fetch_row($resultalpha);
							$total_alpha=$rowalpha[0];
$resultizin = mysqli_query($conn, "SELECT SUM(total_hari)as total_alpha FROM `tr_cuti` WHERE nik='$nik'AND cuti_tahun='$tahun'
									AND kode_jcuti='CTIZ'"); */
				 
						// tampilkan query
/* 							$rowizin=mysqli_fetch_row($resultizin);
							$total_izin=$rowizin[0]; */
//var_dump($total_alpha);								 
 
									
$resultctthn = mysqli_query($conn, "SELECT SUM(total_hari)as total_cthn 
								FROM `tr_cuti` WHERE nik='$nik'AND cuti_tahun='$tahun'
									AND kode_jcuti='CT12' AND id_trcuti!='$id_trcuti'");
					 
						// tampilkan query
							$rowctthn=mysqli_fetch_row($resultctthn);
							$totalambil_cutitahunan=$rowctthn[0];
							$sisa = $jumlah-$totalambil_cutitahunan;
							if($totalambil_cutitahunan>0){
							$detaillink ="<a href='view_his.php'>Detail</a>";
							}
							else {
								$detaillink="";
							}
							
/* 							if(!empty($row6)){
							} */				
	echo "<tr bgcolor='$warna'>
 
			<td><center>$tahun </center></td>  
			<td><center>$jumlah</center></td>  
			<td><center>$totalambil_cutitahunan</center></td>  
			<td><center>$sisa</center></td>  
			<td><center>$lhr_cuti</center></td> 
			<td><center>$showexpcuti</center></td>   
		</tr>"; 
		$no++;
		
  }
  
}
  
									
 else {
  echo "0 results";
}
        
									
?>

 </tbody>
                    </table>
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


<?php
  }
} 
 
else{
		echo"Token expired, please <a href='https://www.bml-log.site'>re-login</a>";
	}

}// End off kondisi approval level1 (checked) masih 0
?>
