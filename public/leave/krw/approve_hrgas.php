 <?php
include "assets/configure/sesionadmin.php"; 	
	
 
include "assets/configure/koneksi.php"; 	
 
$id = $_GET['id'];
//echo "ID nya $id";
 $halaman = $_GET['halaman']; 

$update = "UPDATE tr_cuti SET app_hrgas = '1',`tgl_apphrgas` = NOW() WHERE id_trcuti='$id'";
//var_dump($update);
 if ($conn->query($update) === TRUE) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Approve HRGA Staff Level Succesfully');
    window.location.href='view_app.php?halaman=$halaman';
    </script>");
} else {
  echo "Error: " . $update . "<br>" . $conn->error;
} 
?>
 