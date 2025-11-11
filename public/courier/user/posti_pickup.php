<?php 
include"../assets/sesion/sesionuser.php"; 
?>
<?php 
 
 error_reporting(0);
include "../assets/vendor/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$type_order = "Pickup"; 
$nikso = $_POST['nikso'];
$nama_barang1 = $_POST['nama_barang1'];  
$nama_barang2 = $_POST['nama_barang2'];  
$nama_barang3 = $_POST['nama_barang3'];  
$nama_barang4 = $_POST['nama_barang4'];  
$nama_barang5 = $_POST['nama_barang5'];  
$nama_barang6 = $_POST['nama_barang6'];  
$nama_barang = "$nama_barang1 $nama_barang2 $nama_barang3 $nama_barang4 $nama_barang5 $nama_barang6";  
$job_refnumber = $_POST['job_refnumber'];  
$idalamat_asal = $_POST['idalamat_asal'];  
$idalamat_tujuan = $_POST['idalamat_tujuan'];  
$date_proses = $_POST['date_proses']; 
$time_proses = $_POST['time_proses']; 
$datatgl_proses = "$date_proses $time_proses";  
              // returns Saturday, January 30 10 02:06:34
$old_date_timestamp = strtotime($datatgl_proses);
$datetime_proses = date('Y-m-d H:i:s', $old_date_timestamp);  
 
$penerima = "$namas";  
$dept_penerima = "$kode_section";  
$pengirim = $_POST['pengirim'];  
$dept_pengirim = $_POST['dept_pengirim'];  
$status = "Requested";  
$ket1 = $_POST['ket'];  
$ket2 = $_POST['ket2'];  
//$status = "On the way Pickup point";  


$tgl_log = date("Y-m-d H:i:s"); 
$aktif = "1"; 
$detail_tanggal = $_POST['detail_tanggal'];
 
  $sql = "	INSERT INTO tr_pengiriman 
					( `no_order`, `type_order`, `nama_barang`, `job_refnumber`, `idalamat_asal`,
					`idalamat_tujuan`, `tgl_log`, `datetime_proses`, pengirim, penerima,dept_pengirim, dept_penerima,
					  `nik_kurir`,nik_user, `status`, `ket1`, `ket2`, aktif,sequence)
			VALUES (NULL, '$type_order', '$nama_barang', '$job_refnumber', '$idalamat_asal', 
				'$idalamat_tujuan', '$tgl_log', '$datetime_proses','$pengirim','$penerima',
					'$dept_pengirim','$dept_penerima','$nik_kurir', '$nikso', '$status','$ket1', '$ket2', '$aktif','0')";
 // var_dump($sql);
  if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data Pick Up berhasil ditambahkan');
    window.location.href='mail_additional.php?resi=$last_id';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}    
 
//$conn->close();
?>
 