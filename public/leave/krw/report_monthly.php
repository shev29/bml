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
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];

$originalDate = "$tahun-$bulan-01";
$newDate = date("F-Y", strtotime($originalDate));

//echo $datetime;
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=ReportYearlyBML-$datetime.xls");    ?>
<table border='1'>
<tr><td   colspan='13'><center><h3>LEAVE REPORT MONTHLY <?php echo "$newDate"; ?></h3></td></tr>
<tr bgcolor='#6495ED'>
	<td>No</td>
	<td>Nik</td>
	<td>Nama Lengkap</td>	
	<td>Total Leave</td> 
	<td>Alfa</td>	
	<td>Cuti</td> 	
	<td>Izin</td>
	<td>Sakit</td>
	<td>Half Day</td>  
	<td>Salary Cut</td> 
	<td>Transport</td> 
	<td>Atend</td>
	<td>Note</td> 
</tr>
 
<?php
include "assets/configure/koneksi.php";  
	$sql = " SELECT (user.nik) as nik_karyawan, nama_lengkap, 
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%')as alpha,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan AND total_hari<>'0.5' AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%' ) as cuti_tahunan,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan  AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%' ) as cuti_normatif,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%') as izin,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='CTSKT' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%') as sakit,
(SELECT count(total_hari) FROM tr_cuti WHERE nik=nik_karyawan AND total_hari='0.5' AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-$bulan%') as half_day
 
FROM user
INNER JOIN tr_cuti
ON user.nik=tr_cuti.nik group by nik_karyawan   
ORDER BY nama_lengkap;
			";
	$result = $conn->query($sql);
	

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
  while($row = $result->fetch_assoc()) { 
	  $rnik = $row['nik_karyawan'];
	  $rnama_lengkap = $row['nama_lengkap'];
	  $ralpha = $row['alpha']; 
	  $rcuti_tahunan = $row['cuti_tahunan'];
	  $rizin = $row['izin'];
	  $rsakit = $row['sakit'];
	  $half_day = $row['half_day']; 
	  $total =$ralpha + $rcuti_tahunan + $rizin + $rsakit  ;
	  $salary_cut = $ralpha + $rizin;
	  $hd_inday = $half_day / 2 ;
	  $total_leaveyear=  $total+$hd_inday;
    echo "<tr>
			<td>$no</td>
			<td>$rnik</td>
			<td>$rnama_lengkap</td>			
			<td>$total_leaveyear</td>	
			<td>$ralpha</td>
			<td>$rcuti_tahunan</td>		
			<td>$rizin</td>
			<td>$rsakit</td>
			<td>$half_day</td>
	<td>$salary_cut</td> 
	<td>$total</td> 
	<td>$salary_cut</td>
	<td>Note</td> 
		</tr>";
	  $no++;
  }

}
?>
 
</table>