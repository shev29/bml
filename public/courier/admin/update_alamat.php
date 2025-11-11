<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
// <!--   `id_alamat`, `nama_perusahaan`, `dtl_alamat`, `kode_pos`, `kelurahan`, `kelurahan`, `kota`, `provinsi`, `map`, `ket`, `ket2`    Date -->
error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
 
   
$nama_perusahaan = $_POST['nama_perusahaan'];  

$id_alamat = $_POST['id_alamat']; 
$dtl_alamat = $_POST['dtl_alamat'];  
$kode_pos = $_POST['kode_pos'];   
 
$kota = $_POST['kota'];  
$provinsi = $_POST['pro'];  
$map = $_POST['map'];  

 
  $sql = "UPDATE `courierm_alamat` SET
`nama_perusahaan` = '$nama_perusahaan', `dtl_alamat` = '$dtl_alamat', `kode_pos` = '$kode_pos', 
`kota` = '$kota', `provinsi` = '$provinsi', `map` = '$map' WHERE `courierm_alamat`.`id_alamat` ='$id_alamat'";
  var_dump($sql);
  if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data master alamat berhasil ditambahkan'); 
    window.location.href='master_alamat.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}    
 
//$conn->close();
?>
 