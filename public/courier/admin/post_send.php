<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
//SELECT  `no_order`, `type_order`, `nama_barang`, `job_refnumber`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif` FROM `tr_pengiriman` WHERE 1
error_reporting(0);
include "vendor/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$type_order = "Send"; 
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
$datatgl_proses = $_POST['datetime_proses'];  
              // returns Saturday, January 30 10 02:06:34
$old_date_timestamp = strtotime($datatgl_proses);
$datetime_proses = date('Y-m-d H:i:s', $old_date_timestamp);  
 
$pengirim = "$namas";  
$dept_penerima = "$kode_section";  
$penerima = $_POST['penerima'];  
$dept_pengirim = $_POST['dept_pengirim'];  
$status = "Waiting Courier";  


$tgl_log = date("Y-m-d H:i:s"); 
$aktif = "1"; 
$detail_tanggal = $_POST['detail_tanggal'];
 
  $sql = "	INSERT INTO tr_pengiriman 
					( `no_order`, `type_order`, `nama_barang`, `job_refnumber`, `idalamat_asal`,
					`idalamat_tujuan`, `tgl_log`, `datetime_proses`, pengirim, penerima,dept_pengirim, dept_penerima,
					  `nik_kurir`, nik_user, `status`, `ket1`, `ket2`, aktif)
			VALUES (NULL, '$type_order', '$nama_barang', '$job_refnumber', '$idalamat_asal', 
				'$idalamat_tujuan', '$tgl_log', '$datetime_proses','$pengirim','$penerima',
					'$dept_pengirim','$dept_penerima','$nik_kurir', '$nikadmin', '$status','$ket1', '$ket2', '$aktif')";
 // var_dump($sql);
  if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data Send barang berhasil ditambahkan'); 
    window.location.href='send.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}    
 
//$conn->close();
?>
 