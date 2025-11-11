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
	
 date_default_timezone_set('Asia/Jakarta');
		$tgl_awal = $_POST['tgl_awal'];  
		$newtgl_awal = date("Y-m-d", strtotime($tgl_awal));
		$tgl_akhir = $_POST['tgl_akhir'];
		$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
		$jenis_cuti = $_POST['jenis_cuti'];
		$nik = $_POST['nik'];
		$kode_loc = $_POST['kode_loc'];
		$kode_dep = $_POST['kode_dep'];
		$kode_section = $_POST['kode_section'];
		$datetime = date("Ymd_His");

//echo "1.$newtgl_awal - 2.$newtgl_akhir - 3.$jenis_cuti - 4.$nik - 5.$kode_loc - 6.$kode_dep - 7.$kode_section";
		 
		 ?>
<?php
//echo $datetime;
 header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataCutiBML $datetime.xls");    ?>
<table border='1'>
<tr><td bgcolor='' colspan='13'><center><h3>REPORT CUTI PT.BML</h3></td></tr>
<tr bgcolor='#6495ED'>
	<td>No</td>
	<td>Nik</td>
	<td>Nama Lengkap</td>	
	<td>Location</td> 
	<td>Department</td>	
	<td>Section</td> 	
	<td>Jenis Cuti</td>
	<td>Tanggal Diajukan</td>
	<td>Tanggal Awal</td> 
	<td>Tanggal Akhir</td> 
	<td>Total</td> 
	<td>Alasan</td> 
</tr>
<?php
include "assets/configure/koneksi.php";  
	$sql = "SELECT `id_trcuti`, nama_lengkap, tr_cuti.nik, `nama_cuti`, `tgl_pengajuan`, `tgl_awalc`,
					user.kode_dep,nama_dep,user.kode_section,nama_loc,user.kode_loc,alias,
					`tgl_akhir`, `detail_tanggal`, `total_hari`, `doc_pendukung`, `cuti_tahun`, 
					`alasan`, `nik_sleader`, `approve_sleader`, `tgl_appsleader`, `approve_spv`,
					`tgl_appspv`, `app_manager`, `tgl_appmanager`, `app_hrgas`, `tgl_apphrgas`,
					`app_hrgaspv`, `tgl_apphrgaspv`, `app_hrgamng`, `tgl_apphrgamng`, tr_cuti.ket, tr_cuti.ket2 
			FROM `tr_cuti`
			INNER JOIN user ON tr_cuti.nik = user.nik
			INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti
            INNER JOIN department ON user.kode_dep=department.kode_dep
            INNER JOIN section ON user.kode_section=section.kode_section
            INNER JOIN location ON user.kode_loc=location.alias
			WHERE tgl_awalc BETWEEN '$newtgl_awal'  AND '$newtgl_akhir'
			GROUP BY id_trcuti
			";
	$result = $conn->query($sql);
	

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
  while($row = $result->fetch_assoc()) {
	  $rid_trcuti = $row['id_trcuti'];
	  $rnik = $row['nik'];
	  $rnama_cuti = $row['nama_cuti'];
	  $rnama_dep = $row['nama_dep'];
	  $ralias = $row['alias'];
	  $rkode_loc = $row['kode_loc'];
	  $rnama_loc = $row['nama_loc'];
	  $rkode_dep = $row['kode_dep'];
	  $tgl_pengajuan = $row['tgl_pengajuan'];
	  $rtgl_awalc = $row['tgl_awalc'];
	  $rtgl_akhir = $row['tgl_akhir'];
	  $rtotal_hari = $row['total_hari'];
	  $ralasan = $row['alasan'];
	  $rkode_section = $row['kode_section'];
	  $rnama_lengkap = $row['nama_lengkap']; 
	  $rnm_kecil = strtolower($rnama_lengkap);
	  $rnama_newz = ucwords($rnm_kecil);
    echo "<tr>
			<td>$no</td>
			<td>($rnik)</td>
			<td>$rnama_newz</td>			
			<td>$ralias - $rnama_loc</td>	
			<td>$rnama_dep-$rkode_dep</td>
			<td>$rkode_section</td>		
			<td>$rnama_cuti</td>
			<td>$tgl_pengajuan</td>
			<td>$rtgl_awalc</td>
			<td>$rtgl_akhir</td>
			<td>$rtotal_hari Hari</td>
			<td>$ralasan </td>
		</tr>";
	  $no++;
  }

}
?>
 
</table>