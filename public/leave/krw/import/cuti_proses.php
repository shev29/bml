<?php
$servername = "localhost";
$userdb = "root";
$password = "";
$dbname = "karawang";


// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//include('koneksi.php');
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
	
	for($i = 11;$i < count($sheetData);$i++)
	{
    //`id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `group_email`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2`
        $no = $sheetData[$i]['0'];
        $nik = $sheetData[$i]['1'];
        $nama = $sheetData[$i]['2'];
        $sleader = $sheetData[$i]['15'];
        $joindate = $sheetData[$i]['4'];
        $cadangan = $sheetData[$i]['5'];
        $appby1 = $sheetData[$i]['18'];
        $appby2 = $sheetData[$i]['19'];
 
$splitsleader 	= explode("-", $sleader);
$nama_sleader 	= $splitsleader[0]; // piece1
$nik_sleader 	= $splitsleader[1]; // piece2

$splitckby1 	= explode("-", $ckby1);
$nama_ckby1 	= $splitckby1[0]; // piece1
$nik_ckby1 		= $splitckby1[1]; // piece2

$splitckby2 	= explode("-", $ckby2);
$nama_ckby2 	= $splitckby2[0]; // piece1
$nik_ckby2 		= $splitckby2[1]; // piece2
		
$splitappby1 	= explode("-", $appby1);
$nama_appby1 	= $splitappby1[0]; // piece1
$nik_appby1 	= $splitappby1[1]; // piece2

$splitappby2 	= explode("-", $appby2);
$nama_appby2	= $splitappby2[0]; // piece1
$nik_appby2 	= $splitappby2[1]; // piece2
		
$nik_hrgastaff1 = $_POST['hrgastaff1'];
$nik_hrgastaff2 = $_POST['hrgastaff2'];
$nik_hrgaspv = $_POST['hrgaspv'];
$nik_hrgamng = $_POST['hrgamng'];
         
  echo " $nik - $nama - $joindate -$cadangan<br>";
//$kami = mysqli_query($koneksi,"insert into user_master (id_user,nama_lengkap,nik,hire_date) values (NULL,'$nama_lengkap','$nik','$hire_date')");
 

  $sql = "INSERT INTO `app_level` (`id_app`, `nik`, `tl_checker`, `check_1`, `check_2`, `approve_1`, `approve_2`, `hrga_staff1`, `hrga_staff2`, `hrga_spv`, `hrga_mng`) 
  VALUES
(NULL, '$nik', '$nik_sleader', '$nik_ckby1', '$nik_ckby2',
 '$nik_appby1', '$nik_appby2', '114050238', '0', '113050127', '123050011') ";
				   
 /* echo "$i - $sql;<br>"; */			
//`id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `level`, `atasan_nik`, `token`, `exp_token`
/*         if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data New User Succesfully');
    window.location.href='proses.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} */     
  }
    //header("Location: ../home.php"); 
}
?>