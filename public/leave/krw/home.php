 
<!DOCTYPE html>
<html lang="en">

<head>
<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
include "assets/template/head.php";

include "assets/configure/koneksi.php"; 
 
?>



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
 <head>  
<?php
include "assets/configure/koneksi.php"; 
error_reporting(0);

// query show start period
$sqltglawals = "SELECT `tgl_pengajuan` FROM `tr_cuti` WHERE id_trcuti='1'";
$resulttglawals = $conn->query($sqltglawals);

if ($resulttglawals->num_rows > 0) {
  // output data of each row
  while($rowtglawals = $resulttglawals->fetch_assoc()) {
    $period_tglawals = $rowtglawals['tgl_pengajuan'];
  }
}


// query show end period
$sqltglakhir = "SELECT `tgl_pengajuan` FROM `tr_cuti` order by id_trcuti DESC limit 0,1";
$resulttglakhir = $conn->query($sqltglakhir);

if ($resulttglakhir->num_rows > 0) {
  // output data of each row
  while($rowtglakhir = $resulttglakhir->fetch_assoc()) {
    $period_tglakhir = $rowtglakhir['tgl_pengajuan'];
  }
} 

///-----START DEPT ACCOUNTING ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctacc = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ACCOUNTING & TAX'
				AND kode_jcuti='CT12'
				";
$resultctacc  = $conn->query($sql_ctacc);

if ($resultctacc->num_rows > 0) {
  // output data of each row
  while($rowctacc = $resultctacc->fetch_assoc()) {
    $jml_ctacc = $rowctacc['jmlcuti'];
  }
} 
$sql_unpacc = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ACCOUNTING & TAX'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpacc  = $conn->query($sql_unpacc);

if ($resultsunpacc->num_rows > 0) {
  // output data of each row
  while($rowunpacc = $resultsunpacc->fetch_assoc()) {
    $jml_unpacc = $rowunpacc['jmlcuti'];
  }
} 
$sql_sktacc = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ACCOUNTING & TAX'
				AND kode_jcuti='CTSKT'
				";
$resultsktacc  = $conn->query($sql_sktacc);

if ($resultsktacc->num_rows > 0) {
  // output data of each row
  while($rowsktacc = $resultsktacc->fetch_assoc()) {
    $jml_sktacc = $rowsktacc['jmlcuti'];
  }
} 
///-----END DEPT ACCOUNTING ---- ///

///-----START DEPT AIR CARGO FORWADING ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctacf = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='AIR CARGO FORWARDING'
				AND kode_jcuti='CT12'
				";
$resultctacf  = $conn->query($sql_ctacf);

if ($resultctacf->num_rows > 0) {
  // output data of each row
  while($rowctacf = $resultctacf->fetch_assoc()) {
    $jml_ctacf = $rowctacf['jmlcuti'];
  }
} 
$sql_unpacf = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='AIR CARGO FORWARDING'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpacf  = $conn->query($sql_unpacf);

if ($resultsunpacf->num_rows > 0) {
  // output data of each row
  while($rowunpacf = $resultsunpacf->fetch_assoc()) {
    $jml_unpacf = $rowunpacf['jmlcuti'];
  }
} 
$sql_sktacf = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='AIR CARGO FORWARDING'
				AND kode_jcuti='CTSKT'
				";
$resultsktacf  = $conn->query($sql_sktacf);

if ($resultsktacf->num_rows > 0) {
  // output data of each row
  while($rowsktacf= $resultsktacf->fetch_assoc()) {
    $jml_sktacf = $rowsktacf['jmlcuti'];
  }
} 
///-----END DEPT AIR CARGO FORWADING ---- ///


///-----START DEPT EDII ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctedi = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EDII & UCI FORWARDING'
				AND kode_jcuti='CT12'
				";
$resultctedi  = $conn->query($sql_ctedi);

if ($resultctedi->num_rows > 0) {
  // output data of each row
  while($rowctedi = $resultctedi->fetch_assoc()) {
    $jml_ctedi = $rowctedi['jmlcuti'];
  }
} 
$sql_unpedi = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EDII & UCI FORWARDING'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpedi  = $conn->query($sql_unpedi);

if ($resultsunpedi->num_rows > 0) {
  // output data of each row
  while($rowunpedi = $resultsunpedi->fetch_assoc()) {
    $jml_unpedi = $rowunpedi['jmlcuti'];
  }
} 
$sql_sktedi = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EDII & UCI FORWARDING'
				AND kode_jcuti='CTSKT'
				";
$resultsktedi  = $conn->query($sql_sktedi);

if ($resultsktedi->num_rows > 0) {
  // output data of each row
  while($rowsktedi= $resultsktedi->fetch_assoc()) {
    $jml_sktedi = $rowsktedi['jmlcuti'];
  }
} 
///-----END DEPT EDI ---- ///

///-----START DEPT EXPORT & PROCUREMENT ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctepr = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EXPORT & PROCUREMENT'
				AND kode_jcuti='CT12'
				";
$resultctepr  = $conn->query($sql_ctepr);

if ($resultctepr->num_rows > 0) {
  // output data of each row
  while($rowctepr = $resultctepr->fetch_assoc()) {
    $jml_ctepr = $rowctepr['jmlcuti'];
  }
} 
$sql_unpepr = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EXPORT & PROCUREMENT'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpepr  = $conn->query($sql_unpepr);

if ($resultsunpepr->num_rows > 0) {
  // output data of each row
  while($rowunpepr = $resultsunpepr->fetch_assoc()) {
    $jml_unpepr = $rowunpepr['jmlcuti'];
  }
} 
$sql_sktepr = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='EXPORT & PROCUREMENT'
				AND kode_jcuti='CTSKT'
				";
$resultsktepr  = $conn->query($sql_sktepr);

if ($resultsktepr->num_rows > 0) {
  // output data of each row
  while($rowsktepr= $resultsktepr->fetch_assoc()) {
    $jml_sktepr = $rowsktepr['jmlcuti'];
  }
} 
///-----END DEPT EDI ---- ///
///-----START DEPT FINANCE ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctfin = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='FINANCE'
				AND kode_jcuti='CT12'
				";
$resultctfin  = $conn->query($sql_ctfin);

if ($resultctfin->num_rows > 0) {
  // output data of each row
  while($rowctfin = $resultctfin->fetch_assoc()) {
    $jml_ctfin = $rowctfin['jmlcuti'];
  }
} 
$sql_unpfin = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='FINANCE'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpfin  = $conn->query($sql_unpfin);

if ($resultsunpfin->num_rows > 0) {
  // output data of each row
  while($rowunpfin = $resultsunpfin->fetch_assoc()) {
    $jml_unpfin = $rowunpfin['jmlcuti'];
  }
} 
$sql_sktfin = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='FINANCE'
				AND kode_jcuti='CTSKT'
				";
$resultsktfin  = $conn->query($sql_sktfin);

if ($resultsktfin->num_rows > 0) {
  // output data of each row
  while($rowsktfin= $resultsktfin->fetch_assoc()) {
    $jml_sktfin = $rowsktfin['jmlcuti'];
  }
} 
///-----END DEPT FINANCE ---- ///


///-----START DEPT HMSI DISTRIBUTION ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_cthms = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI DISTRIBUTION'
				AND kode_jcuti='CT12'
				";
$resultcthms  = $conn->query($sql_cthms);

if ($resultcthms->num_rows > 0) {
  // output data of each row
  while($rowcthms = $resultcthms->fetch_assoc()) {
    $jml_cthms = $rowcthms['jmlcuti'];
	//7 echo $jml_cthms;
  }
} 
$sql_unphms = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI DISTRIBUTION'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunphms  = $conn->query($sql_unphms);

if ($resultsunphms->num_rows > 0) {
  // output data of each row
  while($rowunphms = $resultsunphms->fetch_assoc()) {
    $jml_unphms = $rowunphms['jmlcuti'];
	//echo $jml_unphms;
  }
} 
$sql_skthms = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI DISTRIBUTION'
				AND kode_jcuti='CTSKT'
				";
$resultskthms  = $conn->query($sql_skthms);

if ($resultskthms->num_rows > 0) {
  // output data of each row
  while($rowskthms= $resultskthms->fetch_assoc()) {
    $jml_skthms = $rowskthms['jmlcuti'];
  }
} 
///-----END DEPT EDI ---- ///
///-----START DEPT HMSI WAREHOUSE ---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_cthmsw = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI WAREHOUSE'
				AND kode_jcuti='CT12'
				";
$resultcthmsw  = $conn->query($sql_cthmsw);

if ($resultcthmsw->num_rows > 0) {
  // output data of each row
  while($rowcthmsw = $resultcthmsw->fetch_assoc()) {
    $jml_cthmsw = $rowcthmsw['jmlcuti'];
  }
} 
$sql_unphmsw = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI WAREHOUSE'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunphmsw  = $conn->query($sql_unphmsw);

if ($resultsunphmsw->num_rows > 0) {
  // output data of each row
  while($rowunphmsw = $resultsunphmsw->fetch_assoc()) {
    $jml_unphmsw = $rowunphmsw['jmlcuti'];
  }
} 
$sql_skthmsw = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HMSI WAREHOUSE'
				AND kode_jcuti='CTSKT'
				";
$resultskthmsw  = $conn->query($sql_skthmsw);

if ($resultskthmsw->num_rows > 0) {
  // output data of each row
  while($rowskthmsw= $resultskthmsw->fetch_assoc()) {
    $jml_skthmsw = $rowskthmsw['jmlcuti'];
  }
} 
///-----END DEPT HMSI WAREHOUSE ---- ///

///-----START DEPT HRGA---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_cthrga = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HRGA'
				AND kode_jcuti='CT12'
				";
$resultcthrga  = $conn->query($sql_cthrga);

if ($resultcthrga->num_rows > 0) {
  // output data of each row
  while($rowcthrga = $resultcthrga->fetch_assoc()) {
    $jml_cthrga = $rowcthrga['jmlcuti'];
  }
} 
$sql_unphrga = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HRGA'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunphrga  = $conn->query($sql_unphrga);

if ($resultsunphrga->num_rows > 0) {
  // output data of each row
  while($rowunphrga = $resultsunphrga->fetch_assoc()) {
    $jml_unphrga = $rowunphrga['jmlcuti'];
  }
} 
$sql_skthrga = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='HRGA'
				AND kode_jcuti='CTSKT'
				";
$resultskthrga  = $conn->query($sql_skthrga);

if ($resultskthrga->num_rows > 0) {
  // output data of each row
  while($rowskthrga= $resultskthrga->fetch_assoc()) {
    $jml_skthrga = $rowskthrga['jmlcuti'];
  }
} 
///-----END DEPT HRGA ---- ///

///-----START DEPT IMPORT---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctimp = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IMPORT'
				AND kode_jcuti='CT12'
				";
$resultctimp  = $conn->query($sql_ctimp);

if ($resultctimp->num_rows > 0) {
  // output data of each row
  while($rowctimp = $resultctimp->fetch_assoc()) {
    $jml_ctimp = $rowctimp['jmlcuti'];
  }
} 
$sql_unpimp = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IMPORT'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpimp  = $conn->query($sql_unpimp);

if ($resultsunpimp->num_rows > 0) {
  // output data of each row
  while($rowunpimp = $resultsunpimp->fetch_assoc()) {
    $jml_unpimp = $rowunpimp['jmlcuti'];
  }
} 
$sql_sktimp = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IMPORT'
				AND kode_jcuti='CTSKT'
				";
$resultsktimp  = $conn->query($sql_sktimp);

if ($resultsktimp->num_rows > 0) {
  // output data of each row
  while($rowsktimp= $resultsktimp->fetch_assoc()) {
    $jml_sktimp = $rowsktimp['jmlcuti'];
  }
} 
///-----END DEPT IMPORT ---- ///

///-----START DEPT ISO & SAFETY---- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctiso = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ISO & SAFETY'
				AND kode_jcuti='CT12'
				";
$resultctiso  = $conn->query($sql_ctiso);

if ($resultctiso->num_rows > 0) {
  // output data of each row
  while($rowctiso = $resultctiso->fetch_assoc()) {
    $jml_ctiso = $rowctiso['jmlcuti'];
  }
} 
$sql_unpiso = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ISO & SAFETY'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpiso  = $conn->query($sql_unpiso);

if ($resultsunpiso->num_rows > 0) {
  // output data of each row
  while($rowunpiso = $resultsunpiso->fetch_assoc()) {
    $jml_unpiso = $rowunpiso['jmlcuti'];
  }
} 
$sql_sktiso = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='ISO & SAFETY'
				AND kode_jcuti='CTSKT'
				";
$resultsktiso  = $conn->query($sql_sktiso);

if ($resultsktiso->num_rows > 0) {
  // output data of each row
  while($rowsktiso= $resultsktiso->fetch_assoc()) {
    $jml_sktiso = $rowsktiso['jmlcuti'];
  }
} 
///-----END DEPT ISO & SAFETY ---- ///

///-----START DEPT IT--- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctit = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IT'
				AND kode_jcuti='CT12'
				";
$resultctit  = $conn->query($sql_ctit);

if ($resultctit->num_rows > 0) {
  // output data of each row
  while($rowctit = $resultctit->fetch_assoc()) {
    $jml_ctit = $rowctit['jmlcuti'];
  }
} 
$sql_unpit = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IT'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpit  = $conn->query($sql_unpit);

if ($resultsunpit->num_rows > 0) {
  // output data of each row
  while($rowunpit = $resultsunpit->fetch_assoc()) {
    $jml_unpit = $rowunpit['jmlcuti'];
  }
} 
$sql_sktit = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='IT'
				AND kode_jcuti='CTSKT'
				";
$resultsktit  = $conn->query($sql_sktit);

if ($resultsktit->num_rows > 0) {
  // output data of each row
  while($rowsktit= $resultsktit->fetch_assoc()) {
    $jml_sktit = $rowsktit['jmlcuti'];
  }
} 
///-----END DEPT IT ---- ///

///-----START DEPT MARKETING--- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctmar = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='MARKETING'
				AND kode_jcuti='CT12'
				";
$resultctmar  = $conn->query($sql_ctmar);

if ($resultctmar->num_rows > 0) {
  // output data of each row
  while($rowctmar = $resultctmar->fetch_assoc()) {
    $jml_ctmar = $rowctmar['jmlcuti'];
  }
} 
$sql_unpmar = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='MARKETING'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpmar  = $conn->query($sql_unpmar);

if ($resultsunpmar->num_rows > 0) {
  // output data of each row
  while($rowunpmar = $resultsunpmar->fetch_assoc()) {
    $jml_unpmar = $rowunpmar['jmlcuti'];
  }
} 
$sql_sktmar = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='MARKETING'
				AND kode_jcuti='CTSKT'
				";
$resultsktmar  = $conn->query($sql_sktmar);

if ($resultsktmar->num_rows > 0) {
  // output data of each row
  while($rowsktmar= $resultsktmar->fetch_assoc()) {
    $jml_sktmar = $rowsktmar['jmlcuti'];
  }
} 
///-----END DEPT MARKETING ---- ///

///-----START DEPT SEMPER PACKING--- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctsem = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SEMPER PACKING'
				AND kode_jcuti='CT12'
				";
$resultctsem  = $conn->query($sql_ctsem);

if ($resultctsem->num_rows > 0) {
  // output data of each row
  while($rowctsem = $resultctsem->fetch_assoc()) {
    $jml_ctsem = $rowctsem['jmlcuti'];
  }
} 
$sql_unpsem = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SEMPER PACKING'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpsem  = $conn->query($sql_unpsem);

if ($resultsunpsem->num_rows > 0) {
  // output data of each row
  while($rowunpsem = $resultsunpsem->fetch_assoc()) {
    $jml_unpsem = $rowunpsem['jmlcuti'];
  }
} 
$sql_sktsem = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SEMPER PACKING'
				AND kode_jcuti='CTSKT'
				";
$resultsktsem  = $conn->query($sql_sktsem);

if ($resultsktsem->num_rows > 0) {
  // output data of each row
  while($rowsktsem= $resultsktsem->fetch_assoc()) {
    $jml_sktsem = $rowsktsem['jmlcuti'];
  }
} 
///-----END DEPT SEMPER PACKING ---- ///

///-----START DEPT   SURABAYA--- ///
// query show regular leave (cuti tahunan) dep accounting
$sql_ctsur = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SURABAYA'
				AND kode_jcuti='CT12'
				";
$resultctsur  = $conn->query($sql_ctsur);

if ($resultctsur->num_rows > 0) {
  // output data of each row
  while($rowctsur = $resultctsur->fetch_assoc()) {
    $jml_ctsur = $rowctsur['jmlcuti'];
  }
} 
$sql_unpsur = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SURABAYA'
				AND kode_jcuti='CTIZ'
				OR kode_jcuti='ALPHA'
				";
$resultsunpsur  = $conn->query($sql_unpsur);

if ($resultsunpsur->num_rows > 0) {
  // output data of each row
  while($rowunpsur = $resultsunpsur->fetch_assoc()) {
    $jml_unpsur = $rowunpsur['jmlcuti'];
  }
} 
$sql_sktsur = "	SELECT count(tr_cuti.id_trcuti) as jmlcuti  
				FROM `tr_cuti`
				LEFT JOIN user ON tr_cuti.nik = user.nik 
				WHERE kode_section='SURABAYA'
				AND kode_jcuti='CTSKT'
				";
$resultsktsur  = $conn->query($sql_sktsur);

if ($resultsktsur->num_rows > 0) {
  // output data of each row
  while($rowsktsur= $resultsktsur->fetch_assoc()) {
    $jml_sktsur = $rowsktsur['jmlcuti'];
  }
} 
///-----END DEPT SURABAYA ---- ///

?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		  fontFamily: "Calibri",
		text: " Leave Report Chart from: <?php echo "$period_tglawals to $period_tglakhir";?> "
	},	
	  
	axisY: {
		title: "Total Pengajuan",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2:{
  title: "",
  tickThickness: 0,
  lineThickness: 0,
  labelFormatter: function(){
     return " ";
  }  
},
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		indexLabel: "{y}",
		name: "Cuti",
		legendText: "Cuti",
		showInLegend: true, 
		dataPoints:[
			{ label: "ACC & TAX", y: <?php echo $jml_ctacc;?> },
			{ label: "AIR CARGO FORWARDING", y: <?php echo $jml_ctacf;?> },
			{ label: "EDII & UCI FORWARDING", y: <?php echo $jml_ctedi;?>  },
			{ label: "EXPORT & PROCUREMENT", y: <?php echo $jml_ctepr;?> },
			{ label: "FINANCE", y: <?php echo $jml_ctfin;?> },
			{ label: "HMSI DISTRIBUTION", y: <?php echo $jml_cthms;?> },
			{ label: "HMSI WAREHOUSE", y: <?php echo $jml_cthmsw;?> },
			{ label: "HRGA", y: <?php echo $jml_cthrga;?> },
			{ label: "IMPORT", y: <?php echo $jml_ctimp;?>},
			{ label: "ISO & SAFETY", y: <?php echo $jml_ctiso;?> },
			{ label: "IT", y: <?php echo $jml_ctit;?>  },
			{ label: "MARKETING", y: <?php echo $jml_ctmar;?>  },
			{ label: "SEMPER PACKING", y: <?php echo $jml_ctsem;?> },
			{ label: "SURABAYA", y: <?php echo $jml_ctsur;?> }
		]
	},{
		type: "column",
		indexLabel: "{y}",
		name: "Unpaid Cuti",
		legendText: "Unpaid Cuti",
		showInLegend: true, 
				dataPoints:[
			{ label: "ACC & TAX", y: <?php echo $jml_unpacc;?> },
			{ label: "AIR CARGO FORWARDING", y: <?php echo $jml_unpacf;?> },
			{ label: "EDII & UCI FORWARDING", y: <?php echo $jml_unpedi;?>},
			{ label: "EXPORT & PROCUREMENT", y: <?php echo $jml_unpepr;?> },
			{ label: "FINANCE", y: <?php echo $jml_unpfin;?> },
			{ label: "HMSI DISTRIBUTION", y: <?php echo $jml_unphms;?> },
			{ label: "HMSI WAREHOUSE", y: <?php echo $jml_unphmsw;?> },
			{ label: "HRGA", y: <?php echo $jml_unphrga;?> },
			{ label: "IMPORT", y: <?php echo $jml_unpimp;?> },
			{ label: "ISO & SAFETY", y: <?php echo $jml_unpiso;?> },
			{ label: "IT", y: <?php echo $jml_unpit;?> },
			{ label: "MARKETING", y: <?php echo $jml_unpmar;?> },
			{ label: "SEMPER PACKING", y: <?php echo $jml_unpsem;?> },
			{ label: "SURABAYA", y: <?php echo $jml_unpsur;?> }
		]
	},
	{
		type: "column",	
		indexLabel: "{y}",
		name: "Sakit",
		legendText: "Sakit",
		axisYType: "secondary",
		showInLegend: true,
				dataPoints:[
			{ label: "ACC & TAX", y: <?php echo $jml_sktacc;?> },
			{ label: "AIR CARGO FORWARDING", y: <?php echo $jml_sktacf;?> },
			{ label: "EDII & UCI FORWARDING", y: <?php echo $jml_sktedi;?> },
			{ label: "EXPORT & PROCUREMENT", y: <?php echo $jml_sktepr;?> },
			{ label: "FINANCE", y: <?php echo $jml_sktfin;?> },
			{ label: "HMSI DISTRIBUTION", y: <?php echo $jml_skthms;?> },
			{ label: "HMSI WAREHOUSE", y: <?php echo $jml_skthmsw;?>  },
			{ label: "HRGA", y: <?php echo $jml_skthrga;?> },
			{ label: "IMPORT", y: <?php echo $jml_sktimp;?> },
			{ label: "ISO & SAFETY", y: <?php echo $jml_sktiso;?> },
			{ label: "IT", y: <?php echo $jml_sktit;?> },
			{ label: "MARKETING", y: <?php echo $jml_sktmar;?> },
			{ label: "SEMPER PACKING", y: <?php echo $jml_sktsem;?> },
			{ label: "SURABAYA", y: <?php echo $jml_sktsur;?> }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
$("#exportButton").click(function(){
    var pdf = new jsPDF();
    pdf.addImage(dataURL, 'JPEG', 0, 0);
    pdf.save("download.pdf");
});
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div> 
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
<?php 


 $sql = "SELECT `id_ctahunan`, `nama_cuti`,nama_lengkap, cuti_lahir.nik, `tahun`,
				`jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, cuti_lahir.ket 
		 FROM `cuti_lahir` 
		 LEFT JOIN jenis_cuti ON cuti_lahir.kode_jcuti=jenis_cuti.kode_jcuti
		 INNER JOIN user ON cuti_lahir.nik=user.nik
		 WHERE cuti_lahir.nik='$nikso' order by id_ctahunan DESC";
 //var_dump($sql);
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
$warnaGenap = "#CCCCCC";   // warna abu-abu
$warnaGanjil = "#FFFFFF";  // warna putih
$warnaHeading = "#FF0000";

  while($row = $result->fetch_assoc()) { 
	  $nik = $row['nik'];
	  $tahun = $row['tahun'];
	  $jumlah = $row['jumlah']; 
	  
	 if(strtotime($row['exp_cuti']) > 0){
     $showexpcuti=$expired_cuti;
 }else{
     $showexpcuti="<center><img src='images/tthinggas.png' width='60' height='20'>";
 }
 
	  $tag = $row['tag'];
	  $ket = $row['ket'];
 
$result6 = mysqli_query($conn, "SELECT SUM(total_hari)as total FROM `tr_cuti` 
WHERE nik='$nik'AND cuti_tahun='$tahun' 
			AND kode_jcuti='CT12'");
					 
						// tampilkan query
							$row6=mysqli_fetch_row($result6);
							$totalambil=$row6[0];
							$sisa = $jumlah-$totalambil; 
$result7 = mysqli_query($conn, "SELECT SUM(total_hari)as totalcthn FROM `tr_cuti` WHERE nik='$nik'
								AND cuti_tahun='$tahun' 
								AND kode_jcuti='CT12'");
					 
						// tampilkan query
							$row7=mysqli_fetch_row($result7);
							$totalambil7=$row7[0];
							
							
		$sqlalpha =  "SELECT SUM(total_hari)as totalalpha FROM `tr_cuti` WHERE nik='$nik'
									AND cuti_tahun='$tahun' AND kode_jcuti='ALPHA'";
		//var_dump($sqlalpha);			 
						// tampilkan query ALPHA
							$resultalpha = $conn->query($sqlalpha);
										if ($resultalpha->num_rows > 0) {
			  // output data of each row
			  while($rowalpha = $resultalpha->fetch_assoc()) {
				  $totalalpha = $rowalpha['totalalpha'];
				   if(!empty($totalalpha)){
					   		$showalpha=$totalalpha;
				   }
				else{
					$showalpha="0";
				} 
				
			  }
			}
			// tampilkan query IZIN 
 
			 $sqlizins = "SELECT SUM(total_hari)as totalizins FROM `tr_cuti` WHERE nik='$nik'
						AND cuti_tahun='$tahun' AND kode_jcuti='CTIZ'";
			$resultizins = $conn->query($sqlizins);

			if ($resultizins->num_rows > 0) {
			  // output data of each row
			  while($rowizins = $resultizins->fetch_assoc()) {
				  $totalizins = $rowizins['totalizins'];
				   if(!empty($totalizins)){
					   $showizins=$totalizins;
				   }
				   else{
					   $showizins="0";
				   }
				
			  }
			} 
}
}

 
?>
          <div class="row">
 
            <div class="col-md-6 grid-margin transparent">
              <div class="row"> 
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Sisa Cuti</p>
                      <p class="fs-30 mb-2"><?php echo $sisa; ?> Days</p>  
					  <p>Tahun <?php echo $tahun; ?><a href='view_his.php'><button type="button" class="btn btn-primary btn-sm">Detail</button></a></p>
                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Cuti Terpakai <?php echo $totalambil7;?> </p> 
                      <p class="fs-30 mb-2"><?php echo $totalambil7;?> Days</p>
                      <p>Tahun <?php echo $tahun; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Izin</p>
                      <p class="fs-30 mb-2"><?php echo $showizins;?> Days</p>
                      <p>Tahun <?php echo $tahun; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Alpa</p>
                      <p class="fs-30 mb-2"><?php echo $showalpha;?>Days</p>
                      <p>Tahun <?php echo $tahun; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
 
			
          </div>
 <!-- Aprroval Cuti -->
 
 
 
 
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
