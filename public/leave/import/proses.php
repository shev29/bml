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
    
        $p_nik = $sheetData[$i]['0']; // Payroll ID 
        $nama_lengkap = $sheetData[$i]['1'];
		$birth_date = $sheetData[$i]['2']; 
		$joindate = $sheetData[$i]['3'];
		$hire_date = date('Y-m-d',strtotime($joindate));
 
        $title = $sheetData[$i]['4'];
		$section = $sheetData[$i]['5'];
		$level = $sheetData[$i]['6'];
		
		$depart = $sheetData[$i]['7'];  
		$dept = substr($depart,-8); 
		
		
		$location = $sheetData[$i]['8'];
		$tb = $sheetData[$i]['9'];
        $number = $sheetData[$i]['10'];	 
		$prepare = $sheetData[$i]['11'];
		$email1 = $sheetData[$i]['12'];
		$email2 = $sheetData[$i]['13'];
		$sl_checker = $sheetData[$i]['14'];
		$allsl_checker = explode("-" , $sl_checker);
		$tl_checker = $allsl_checker[1];		
		
		$check_satu = $sheetData[$i]['15'];
		$nik_check1 = explode("-" , $check_satu);
		$check_1 = $nik_check1[1];
		
		$check_dua = $sheetData[$i]['16'];
		$nik_check2 = explode("-" , $check_dua);
		$check_2 = $nik_check2[1];
		 
		$approvsatu = $sheetData[$i]['17']; 
		$exp_app1 = explode("-" , $approvsatu);
		$approv1 = $exp_app1[1];
		 
		$approvdua = $sheetData[$i]['18']; 
		$exp_app2 = explode("-" , $approvdua);
		$approv2 = $exp_app2[1];
		  
		$status_aktif = '1';		
		// generate username 
	
		$sub_nik = substr($p_nik,6);
 
		$datanama = explode(" " , $nama_lengkap);
		$namadepan = $datanama[0];
		$lowercasename = strtolower($namadepan);
		$mixuser_generate = "$lowercasename$sub_nik";  
 
		$token = md5($mixuser_generate);
 
//PAYROLL_ID	NAME	BIRTH DATE	HIRE DATE	TITLE	SECTION	LEVEL	DEPT	LOCATION	TB	NUMBER	PREPARE BY	CHECK BY 1	CHECK BY 1	APPROVE BY 1	APPROVE BY 2

/* 		echo"1. Nik : $p_nik -<br>
		2.nama $nama_lengkap -<br>
		3.tanggal lahir $birth_date - <br>
		4.join date $hire_date - <br> 
		5.title $title - <br>
		6.section $section -	<br>
		7.level $level - <br>
		8.dept $dept - <br>
		9.location $location <br>
		10.kode dep $tb -<br>
        11.number $number- <br>
		12.pengaju $prepare -<br>
		17.email 1 $email -<br>
        18.email 2 $email2 -<br>
		13.cek1 $check_1 -<br>
		14.or cek2 $check_2 -<br>
		15.appv 1$approv1 -<br>
		16.or appv 2$approv2 - <br>"; */

/*  //echo "$kode_dep<br>";
 $kami = mysqli_query($koneksi,"insert into user_master (id_user,nama_lengkap,nik,hire_date) values 
 (NULL,'$nama_lengkap','$nik','$hire_date')");
    `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, 
   `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `tag_level`, `level_akses`, 
   `tl_checker`, `check_1`, `check_2`, `approve_1`, `approve_2`, `token`, `exp_token`, 
   `status_aktif`, `ket`, `ket2` FROM `user_master` */ 

 $sql = "INSERT INTO `user` 
   ( `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, 
   `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`,   `level_akses`, 
    `token`, `exp_token`, 
   `status_aktif`, `ket`, `ket2`) 
		 VALUES
(NULL, '$nama_lengkap', '$p_nik', '$hire_date', '$email1', '$email2',  '$mixuser_generate', '45ab9db141b155f2eace3145162a9584',
 '$location', '$dept','$section','$title', '$level',   'user',  '$token', curdate(), 
   '$status_aktif', '$ket', '$ket2')";
 				// pass generate =Bml5678#
 //echo "$sql<br>";			
         if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data New User Succesfully');
     </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}   
$sql_approval = "INSERT INTO `app_level` 
	( `id_app`, `nik`, `tl_checker`, `check_1`, `check_2`, `approve_1`, `approve_2`) 
	 VALUES
	(NULL,  '$p_nik','$tl_checker',  '$check_1', '$check_2', '$approv1', '$approv2')";
 				// pass generate =Bml123#
 //echo "$sql_approval<br>";			
        if ($conn->query($sql_approval) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data New Approval User Sukses');
    window.location.href='upload.php';
    </script>");
} else {
  echo "Error: " . $sql_approval . "<br>" . $conn->error;
}     
  }
    //header("Location: ../home.php"); 
}
?>