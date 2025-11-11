<?php
include('koneksi.php');
require 'vendor/autoload.php';
 error_reporting(0);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
 
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	
/*  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`,
	`password`, `kode_loc`, `kode_dep`, `level`, `atasan_nik`, `token`, `exp_token` */
	
	for($i = 1;$i < count($sheetData);$i++)
	{
    
        $nik = $sheetData[$i]['1'];
        $nama_lengkap = $sheetData[$i]['2'];
        $section = $sheetData[$i]['3'];
         
 //echo "$kode_dep<br>";
//$kami = mysqli_query($koneksi,"insert into user_master (id_user,nama_lengkap,nik,hire_date) values (NULL,'$nama_lengkap','$nik','$hire_date')");
 
		

 $sql = "UPDATE `user` SET `kode_section` = '$section' WHERE `nik` = '$nik'";
/* 	var_dump($sql);
echo "<br>"; */	 
				// pass generate =Bml123#
 			
  //`id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `level`, `atasan_nik`, `token`, `exp_token`
    if ($conn->query($sql) === TRUE) {
  echo "$nik succes update";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
 
 }    
  }
    //header("Location: ../home.php"); 
}
?>