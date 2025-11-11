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

$sql_id = "SELECT `id_alamat` FROM `courierm_alamat` order by id_alamat DESC limit 3,1";
$result_id = $conn->query($sql_id);

if ($result_id->num_rows > 0) {
  // output data of each row
  while($rowid = $result_id->fetch_assoc()) {
     $id_almt = $rowid['id_alamat'];
     $new_idalamat = $id_almt+1;
  }
} else {
  echo "0 results";
}   
  
   
$nama_perusahaan = $_POST['nama_perusahaan'];  
$dtl_alamat = $_POST['dtl_alamat'];  
$kode_pos = $_POST['kode_pos'];   
 
$kota = $_POST['kota'];  
$provinsi = $_POST['provinsi'];  
$map = $_POST['map'];  
 
  $sql = "INSERT INTO `courierm_alamat` (`id_alamat`, `nama_perusahaan`, `dtl_alamat`, `kode_pos`,   `kota`, `provinsi`, `map`) 
            VALUES ('$new_idalamat', '$nama_perusahaan', '$dtl_alamat', '$kode_pos',   '$kota', '$provinsi', '$map')";
 // var_dump($sql);
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
 