<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
 
include "assets/configure/koneksi.php"; 	
 
$id = $_GET['id'];
//echo "ID nya $id";
 
$update = "UPDATE tr_cuti SET nik_approve1 = '$nikso', status_approve1='1', tgl_approve1 = NOW() 
WHERE tr_cuti.id_trcuti = $id";
 //var_dump($update);

   if ($conn->query($update) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Approve lev 2 Succesfully');
    window.location.href='hrga_app.php';
    </script>");
 
} else {
  echo "Error: " . $update . "<br>" . $conn->error;
}   
?>
 