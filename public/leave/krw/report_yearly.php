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

$originalDate = "$tahun";
$newDate = date("Y", strtotime($originalDate));

//echo $datetime;
 header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=ReportYearlyBML-$datetime.xls");    ?>
<table border='1'>
<tr><td   colspan='25'><center><h3>LEAVE REPORT PT BERDIRI MATAHARI LOGISTIK <?php echo "$newDate"; ?></h3></td></tr>
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
	<td>January</td> 
	<td>February</td> 
	<td>March</td>
	<td>April</td>
	<td>May</td>
	<td>June</td>
	<td>July</td>
	<td>August</td>
	<td>September</td>
	<td>October</td>
	<td>November</td> 
	<td>December</td> 
</tr>
 
<?php
include "assets/configure/koneksi.php";  
	$sql = " SELECT (user.nik) as nik_karyawan, nama_lengkap, 
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%')as alpha,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan AND total_hari<>'0.5' AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%' ) as cuti_tahunan,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan  AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%' ) as cuti_normatif,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%') as izin,
(SELECT SUM(total_hari) FROM tr_cuti WHERE nik=nik_karyawan   AND kode_jcuti='CTSKT' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%') as sakit,
(SELECT Count(total_hari) FROM tr_cuti WHERE nik=nik_karyawan AND total_hari='0.5' AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun%') as half_day
 
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
	  $hd_inday = $half_day /2 ;
	  $total_leaveyear=  $total+$hd_inday;

	  
// START IZIN
	  
//	Start Alfa Januari
    $sqli = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-01%'";
$resulti = $conn->query($sqli);
//var_dump($sqli);
if ($resulti->num_rows > 0) {
  // output data of each row
  while($rowi = $resulti->fetch_assoc()) {
    $izin_1 = $rowi["total_hari"];
} 	
}

//  End izin Januari

//	Start izin feb
    $sqli2 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-02%'";
$resulti2 = $conn->query($sqli2);
//var_dump($sqli);
if ($resulti2->num_rows > 0) {
  // output data of each row
  while($rowi2 = $resulti2->fetch_assoc()) {
    $izin_2 = $rowi2["total_hari"];
} 	
}

//  End izin feb	  
 
//	Start izin maret
    $sqli3 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-03%'";
$resulti3 = $conn->query($sqli3);
//var_dump($sqli);
if ($resulti3->num_rows > 0) {
  // output data of each row
  while($rowi3 = $resulti3->fetch_assoc()) {
    $izin_3 = $rowi3["total_hari"];
} 	
}

//  End izin maret
//	Start izin April
    $sqli4 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-04%'";
$resulti4 = $conn->query($sqli4);
//var_dump($sqli);
if ($resulti4->num_rows > 0) {
  // output data of each row
  while($rowi4 = $resulti4->fetch_assoc()) {
    $izin_4 = $rowi4["total_hari"];
} 	
}

//  End izin april
//	Start izin Mei
    $sqli5 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-05%'";
$resulti5 = $conn->query($sqli5);
//var_dump($sqli);
if ($resulti5->num_rows > 0) {
  // output data of each row
  while($rowi = $resulti5->fetch_assoc()) {
    $izin_5 = $rowi5["total_hari"];
} 	
}

//  End izin Mei
//	Start izin juni
    $sqli6 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-06%'";
$resulti6 = $conn->query($sqli6);
//var_dump($sqli);
if ($resulti6->num_rows > 0) {
  // output data of each row
  while($rowi6 = $resulti6->fetch_assoc()) {
    $izin_6 = $rowi6["total_hari"];
} 	
}

//  End izin Juni//	

//Start izin Juli
    $sqli7 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-07%'";
$resulti7 = $conn->query($sqli7);
//var_dump($sqli);
if ($resulti7->num_rows > 0) {
  // output data of each row
  while($rowi7 = $resulti7->fetch_assoc()) {
    $izin_7 = $rowi7["total_hari"];
} 	
}

//  End izin Juli
//	Start izin Aug
    $sqli8 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-08%'";
$resulti8 = $conn->query($sqli8);
//var_dump($sqli);
if ($resulti8->num_rows > 0) {
  // output data of each row
  while($rowi8 = $resulti8->fetch_assoc()) {
    $izin_8 = $rowi8["total_hari"];
} 	
}

//  End izin Aug

//	Start izin Sept
    $sqli9 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-09%'";
$resulti9 = $conn->query($sqli9);
//var_dump($sqli);
if ($resulti9->num_rows > 0) {
  // output data of each row
  while($rowi9 = $resulti9->fetch_assoc()) {
    $izin_9 = $rowi9["total_hari"];
} 	
}

//  End izin Sept

//	Start izin Oct
    $sqli10 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-10%'";
$resulti = $conn->query($sqli10);
//var_dump($sqli);
if ($resulti10->num_rows > 0) {
  // output data of each row
  while($rowi10 = $resulti10->fetch_assoc()) {
    $izin_10 = $rowi10["total_hari"];
} 	
}

//  End izin Oct

//	Start izin nov
    $sqli11 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-11%'";
$resulti11 = $conn->query($sqli11);
//var_dump($sqli);
if ($resulti11->num_rows > 0) {
  // output data of each row
  while($rowi11 = $resulti11->fetch_assoc()) {
    $izin_11 = $rowi11["total_hari"];
} 	
}

//  End izin nov

//	Start izin dec
    $sqli12 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTIZ' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-12%'";
$resulti12 = $conn->query($sqli12);
//var_dump($sqla);
if ($resulti12->num_rows > 0) {
  // output data of each row
  while($rowi12 = $resulti12->fetch_assoc()) {
    $izin_12 = $rowi12["total_hari"];
} 	
}

//  End izin Dec
// END IZIN

	  
//	Start Alfa Januari
    $sqla = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-01%'";
$resulta = $conn->query($sqla);
//var_dump($sqla);
if ($resulta->num_rows > 0) {
  // output data of each row
  while($rowa = $resulta->fetch_assoc()) {
    $alfa_1 = $rowa["total_hari"];
} 	
}

//  End Alfa Januari

//	Start Alfa feb
    $sqla2 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-02%'";
$resulta2 = $conn->query($sqla2);
//var_dump($sqla);
if ($resulta2->num_rows > 0) {
  // output data of each row
  while($rowa2 = $resulta2->fetch_assoc()) {
    $alfa_2 = $rowa2["total_hari"];
} 	
}

//  End Alfa feb	  
 
//	Start Alfa maret
    $sqla3 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-03%'";
$resulta3 = $conn->query($sqla3);
//var_dump($sqla);
if ($resulta3->num_rows > 0) {
  // output data of each row
  while($rowa3 = $resulta3->fetch_assoc()) {
    $alfa_3 = $rowa3["total_hari"];
} 	
}

//  End Alfa maret
//	Start Alfa April
    $sqla4 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-04%'";
$resulta4 = $conn->query($sqla4);
//var_dump($sqla);
if ($resulta4->num_rows > 0) {
  // output data of each row
  while($rowa4 = $resulta4->fetch_assoc()) {
    $alfa_4 = $rowa4["total_hari"];
} 	
}

//  End Alfa april
//	Start Alfa Mei
    $sqla5 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-05%'";
$resulta5 = $conn->query($sqla5);
//var_dump($sqla);
if ($resulta5->num_rows > 0) {
  // output data of each row
  while($rowa = $resulta5->fetch_assoc()) {
    $alfa_5 = $rowa5["total_hari"];
} 	
}

//  End Alfa Mei
//	Start Alfa juni
    $sqla6 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-06%'";
$resulta6 = $conn->query($sqla6);
//var_dump($sqla);
if ($resulta6->num_rows > 0) {
  // output data of each row
  while($rowa6 = $resulta6->fetch_assoc()) {
    $alfa_6 = $rowa6["total_hari"];
} 	
}

//  End Alfa Juni//	

//Start Alfa Juli
    $sqla7 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-07%'";
$resulta7 = $conn->query($sqla7);
//var_dump($sqla);
if ($resulta7->num_rows > 0) {
  // output data of each row
  while($rowa7 = $resulta7->fetch_assoc()) {
    $alfa_7 = $rowa7["total_hari"];
} 	
}

//  End Alfa Juli
//	Start Alfa Aug
    $sqla8 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-08%'";
$resulta8 = $conn->query($sqla8);
//var_dump($sqla);
if ($resulta8->num_rows > 0) {
  // output data of each row
  while($rowa8 = $resulta8->fetch_assoc()) {
    $alfa_8 = $rowa8["total_hari"];
} 	
}

//  End Alfa Aug

//	Start Alfa Sept
    $sqla9 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-09%'";
$resulta9 = $conn->query($sqla9);
//var_dump($sqla);
if ($resulta9->num_rows > 0) {
  // output data of each row
  while($rowa9 = $resulta9->fetch_assoc()) {
    $alfa_9 = $rowa9["total_hari"];
} 	
}

//  End Alfa Sept

//	Start Alfa Oct
    $sqla10 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-10%'";
$resulta = $conn->query($sqla10);
//var_dump($sqla);
if ($resulta10->num_rows > 0) {
  // output data of each row
  while($rowa10 = $resulta10->fetch_assoc()) {
    $alfa_10 = $rowa10["total_hari"];
} 	
}

//  End Alfa Oct

//	Start Alfa nov
    $sqla11 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-11%'";
$resulta11 = $conn->query($sqla11);
//var_dump($sqla);
if ($resulta11->num_rows > 0) {
  // output data of each row
  while($rowa11 = $resulta11->fetch_assoc()) {
    $alfa_11 = $rowa11["total_hari"];
} 	
}

//  End Alfa nov

//	Start Alfa dec
    $sqla12 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='ALPHA' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-12%'";
$resulta12 = $conn->query($sqla12);
//var_dump($sqla);
if ($resulta12->num_rows > 0) {
  // output data of each row
  while($rowa12 = $resulta12->fetch_assoc()) {
    $alfa_12 = $rowa12["total_hari"];
} 	
}

//  End Alfa Dec
	  
	  
// CUTI TAHUNAN DAN NORMATIF

//	Start Cuti Tahunan Januari
    $sqlct = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-01%'";
$resultct = $conn->query($sqlct);
//var_dump($sqla);
if ($resultct->num_rows > 0) {
  // output data of each row
  while($rowct = $resultct->fetch_assoc()) {
    $ct_1 = $rowct["total_hari"];
} 	
}

//  End Cuti Tahunan
 
//	Start Cuti Tahunan Januari
    $sqlct2 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-02%'";
$resultct2 = $conn->query($sqlct2);
//var_dump($sqla);
if ($resultct2->num_rows > 0) {
  // output data of each row
  while($rowct2 = $resultct2->fetch_assoc()) {
    $ct_2 = $rowct2["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlct3 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-03%'";
$resultct3 = $conn->query($sqlct3);
//var_dump($sqla);
if ($resultct3->num_rows > 0) {
  // output data of each row
  while($rowct3 = $resultct3->fetch_assoc()) {
    $ct_3 = $rowct3["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlct4 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-04%'";
$resultct4 = $conn->query($sqlct4);
//var_dump($sqlct4);
if ($resultct4->num_rows > 0) {
  // output data of each row
  while($rowct4 = $resultct4->fetch_assoc()) {
    $ct_4 = $rowct4['total_hari'];
    //var_dump($ct_4);
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlct5 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-05%'";
$resultct5 = $conn->query($sqlct5);
 //var_dump($sqlct5);
if ($resultct5->num_rows > 0) {
  // output data of each row
  while($rowct5 = $resultct5->fetch_assoc()) {
    $ct_5 = $rowct5["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan juni
    $sqlct6 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-06%'";
$resultct6 = $conn->query($sqlct6);
//var_dump($sqla);
if ($resultct6->num_rows > 0) {
  // output data of each row
  while($rowct6 = $resultct6->fetch_assoc()) {
    $ct_6 = $rowct6["total_hari"];
} 	
}

//  End Cuti Tahunan juni

//	Start Cuti Tahunan Januari
    $sqlct7 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-07%'";
$resultct7 = $conn->query($sqlct7);
//var_dump($sqla);
if ($resultct7->num_rows > 0) {
  // output data of each row
  while($rowct7 = $resultct7->fetch_assoc()) {
    $ct_7 = $rowct7['total_hari'];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlct8 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-08%'";
$resultct8 = $conn->query($sqlct8);
//var_dump($sqla);
if ($resultct8->num_rows > 0) {
  // output data of each row
  while($rowct8 = $resultct8->fetch_assoc()) {
    $ct_8 = $rowct8["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlct9 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-09%'";
$resultct9 = $conn->query($sqlct9);
//var_dump($sqla);
if ($resultct9->num_rows > 0) {
  // output data of each row
  while($rowct9 = $resultct9->fetch_assoc()) {
    $ct_9 = $rowct9["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 10
    $sqlct10 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-10%'";
$resultct10 = $conn->query($sqlct10);
//var_dump($sqla);
if ($resultct10->num_rows > 0) {
  // output data of each row
  while($rowct10 = $resultct10->fetch_assoc()) {
    $ct_10 = $rowct10["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 11
    $sqlct11 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-11%'";
$resultct11 = $conn->query($sqlct11);
//var_dump($sqla);
if ($resultct11->num_rows > 0) {
  // output data of each row
  while($rowct11 = $resultct11->fetch_assoc()) {
    $ct_11 = $rowct11["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 12
    $sqlct12 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-12%'";
$resultct12 = $conn->query($sqlct12);
//var_dump($sqla);
if ($resultct12->num_rows > 0) {
  // output data of each row
  while($rowct12 = $resultct12->fetch_assoc()) {
    $ct_12 = $rowct["total_hari"];
} 	
}

//  End Cuti Tahunan 12
 


// CUTI  NORMATIF

//	Start Cuti Tahunan Januari
    $sqlctn = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-01%'";
$resultctn = $conn->query($sqlctn);
//var_dump($sqla);
if ($resultctn->num_rows > 0) {
  // output data of each row
  while($rowctn = $resultctn->fetch_assoc()) {
    $ctn_1 = $rowctn["total_hari"];
} 	
}

//  End Cuti Tahunan
 
//	Start Cuti Tahunan Januari
    $sqlctn2 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-02%'";
$resultctn2 = $conn->query($sqlctn2);
//var_dump($sqla);
if ($resultctn2->num_rows > 0) {
  // output data of each row
  while($rowctn2 = $resultctn2->fetch_assoc()) {
    $ctn_2 = $rowctn2["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlctn3 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-03%'";
$resultctn3 = $conn->query($sqlctn3);
//var_dump($sqla);
if ($resultctn3->num_rows > 0) {
  // output data of each row
  while($rowctn3 = $resultctn3->fetch_assoc()) {
    $ctn_3 = $rowctn3["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlctn4 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-04%'";
$resultctn4 = $conn->query($sqlctn4);
//var_dump($sqlct4);
if ($resultctn4->num_rows > 0) {
  // output data of each row
  while($rowctn4 = $resultctn4->fetch_assoc()) {
    $ctn_4 = $rowctn4['total_hari'];
    //var_dump($sqlctn4);
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlctn5 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-05%'";
$resultctn5 = $conn->query($sqlctn5);
 //var_dump($sqlct5);
if ($resultctn5->num_rows > 0) {
  // output data of each row
  while($rowctn5 = $resultctn5->fetch_assoc()) {
    $ctn_5 = $rowctn5["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan juni
$sqlctn6 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-06%'";
$resultctn6 = $conn->query($sqlctn6);
//var_dump($sqla);
if ($resultctn6->num_rows > 0) {
  // output data of each row
  while($rowctn6 = $resultctn6->fetch_assoc()) {
    $ctn_6 = $rowctn6["total_hari"];
} 	
}

//  End Cuti Tahunan juni

//	Start Cuti Tahunan Januari
    $sqlctn7 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CT12' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-07%'";
$resultctn7 = $conn->query($sqlctn7);
//var_dump($sqla);
if ($resultctn7->num_rows > 0) {
  // output data of each row
  while($rowctn7 = $resultctn7->fetch_assoc()) {
    $ctn_7 = $rowctn7['total_hari'];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlctn8 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-08%'";
$resultctn8 = $conn->query($sqlctn8);
//var_dump($sqla);
if ($resultctn8->num_rows > 0) {
  // output data of each row
  while($rowctn8 = $resultctn8->fetch_assoc()) {
    $ctn_8 = $rowctn8["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan Januari
    $sqlctn9 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-09%'";
$resultctn9 = $conn->query($sqlctn9);
//var_dump($sqla);
if ($resultctn9->num_rows > 0) {
  // output data of each row
  while($rowctn9 = $resultctn9->fetch_assoc()) {
    $ctn_9 = $rowctn9["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 10
    $sqlctn10 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-10%'";
$resultctn10 = $conn->query($sqlctn10);
//var_dump($sqla);
if ($resultctn10->num_rows > 0) {
  // output data of each row
  while($rowctn10 = $resultctn10->fetch_assoc()) {
    $ctn_10 = $rowctn10["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 11
    $sqlctn11 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-11%'";
$resultctn11 = $conn->query($sqlctn11);
//var_dump($sqla);
if ($resultctn11->num_rows > 0) {
  // output data of each row
  while($rowctn11 = $resultctn11->fetch_assoc()) {
    $ctn_11 = $rowctn11["total_hari"];
} 	
}

//  End Cuti Tahunan

//	Start Cuti Tahunan 12
    $sqlctn12 = "SELECT SUM(total_hari) as total_hari FROM tr_cuti WHERE nik='$rnik'   AND kode_jcuti='CTN1' AND cuti_tahun='$tahun' AND tgl_awalc like'%$tahun-12%'";
$resultctn12 = $conn->query($sqlctn12);
//var_dump($sqla);
if ($resultctn12->num_rows > 0) {
  // output data of each row
  while($rowctn12 = $resultctn12->fetch_assoc()) {
    $ctn_12 = $rowctn12["total_hari"];
} 	
}

//  End Cuti Tahunan 12
 
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
	<td>A : $alfa_1 C: $ct_1 CN: $ctn_1 I: $izin_1</td>  
	<td>A : $alfa_2  C: $ct_2 CN: $ctn_2 I: $izin_2</td>  
	<td>A : $alfa_3  C: $ct_3 CN: $ctn_3 I: $izin_3</td>  
	<td>A : $alfa_4  C: $ct_4 CN: $ctn_4 I: $izin_4</td>  
	<td>A : $alfa_5  C: $ct_5 CN: $ctn_5 I: $izin_5</td>  
	<td>A : $alfa_6  C: $ct_6 CN: $ctn_6 I: $izin_6</td>  
	<td>A : $alfa_7  C: $ct_7 CN: $ctn_7 I: $izin_7</td>  
	<td>A : $alfa_8  C: $ct_8 CN: $ctn_8 I: $izin_8</td>  
	<td>A : $alfa_9  C: $ct_9 CN: $ctn_9 I: $izin_9</td>  
	<td>A : $alfa_10  C: $ct_10 CN: $ctn_10 I: $izin_10</td>  
	<td>A : $alfa_11  C: $ct_11 CN: $ctn_11 I: $izin_11</td>  
	<td>A : $alfa_12  C: $ct_12 CN: $ctn_12 I: $izin_12</td>  
		</tr>";
	  $no++;
  }

}
?>
 
</table>