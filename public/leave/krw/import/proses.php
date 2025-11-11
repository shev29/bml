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
	$no = 0;
	for($i = 1;$i < count($sheetData);$i++)
	{
		$no++;
    //`id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `group_email`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2`
        $nik = $sheetData[$i]['0'];
        $nama_lengkap = $sheetData[$i]['1'];
        $hire_date = $sheetData[$i]['4'];
		$title = $sheetData[$i]['5'];
        $level = $sheetData[$i]['7'];
		$dep = $sheetData[$i]['8'];
		$kode_section = $sheetData[$i]['8'];
		$sdep = $sheetData[$i]['5'];
		$kode_loc = $sheetData[$i]['9'];
		$email = $sheetData[$i]['13'];
        $email2 = $sheetData[$i]['14'];	
		$shiftleader = $sheetData[$i]['16'];		
        $username =  $nama_lengkap;		
        $password = $sheetData[$i]['7'];
        //$split_kodedep = explode(" " , $dep);		 
		$kode_dep = substr($sdep,-8);
      
	  
        $atasan_nik = $sheetData[$i]['11'];
        $token = $sheetData[$i]['12'];
        $exp_token = $sheetData[$i]['13'];  
		$cnik = strval($nik); 
		$hdate=date_create($hire_date);
		$post_date = date_format($hdate,"Y-m-d");
		$token = md5($username);
		$datanama = explode(" " , $nama_lengkap);
		$namadepan = $datanama[0];
		 
		$sub_nik = substr($nik,-3);
		$mixuser_generate = "$namadepan$sub_nik";
		$level_akses = "user";
 //echo "$nik<br>";
//$kami = mysqli_query($koneksi,"insert into user_master (id_user,nama_lengkap,nik,hire_date) values (NULL,'$nama_lengkap','$nik','$hire_date')");
 

 $sql = "INSERT INTO `user` ( `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2`, `courier_akses`) 
		 VALUES  
(NULL, '$nama_lengkap', '$cnik', '$post_date', '$email','$email2','$mixuser_generate','45ab9db141b155f2eace3145162a9584',   '$kode_loc', '$dep', '$kode_section','$title', '$level', '$level_akses','$token', curdate(),'1','','','user')";
				   
  echo "$no $sql;<br>";			
//`id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `level`, `atasan_nik`, `token`, `exp_token`
           if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data New User Succesfully');
    window.location.href='proses.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}          
  }
    //header("Location: ../home.php"); 
}
 
?>