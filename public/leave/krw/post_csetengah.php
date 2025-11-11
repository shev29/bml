<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/head.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
<?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
		<?php			  
		include "assets/configure/koneksi.php";  
		error_reporting(0); 
/*   `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, 
  `detail_tanggal`, `total_hari`, `doc_pendukung`, `cuti_tahun`, `alasan`,
*/

		$niks = $_POST['niks'];
		$kode_jcuti = $_POST['kode_jcuti'];
		$tgl_pengajuan = $_POST['tgl_pengajuan'];  
		$newtgl_pengajuan = date("Y-m-d", strtotime($tgl_pengajuan)); 
		$detail_tanggal = $_POST['detail_tanggal'];
		$cuti_tahun = $_POST['cuti_tahun'];
		$total_hari = strlen($detail_tanggal);
		$alasan = $_POST['alasan']; 
		$newtgl_awalc =  $_POST['detail_tanggal'];
		$newtgl_akhir =  $_POST['detail_tanggal'];

		if ($newtgl_akhir >= '2025-02-16') {
			echo "Pengajuan baru Cuti, Izin dan Sakit untuk tanggal cuti 16 Feb 2025 sampai dengan tanggal saat ini silahkan menggunakan aplikasi Workplaze.<br>";
			exit();
		}

		$total_cutis =  $_POST['total_hari'];
		$id_cutirplcmn =  $_POST['id_cutirplcmn'];
// Approval Post
		$nik_sleader = $_POST['tl_checker'];
		$status_sleader = "0";
		$tgl_appsleader = "0000-00-00";
		// Checked by
		$nik_check1 = $_POST['check_1'];
		$status_check1 = "0";
		$tgl_check1 = "0000-00-00";
		$nik_check2 = $_POST['check_2'];
		$status_check2 = "0";
		$tgl_check2 = "0000-00-00";
		//Approve by
		$nik_approve1 = $_POST['approve_1'];
		$status_approve1 = "0";
		$tgl_approve1 = "0000-00-00";
		
		$nik_approve2 = $_POST['approve_2'];
		$status_approve2 = "0";
		$tgl_approve2 = "0000-00-00";
		//hrga approval
		$nik_hrgas = $_POST['hrga_staff1'];
		$nik_hrgas2 = $_POST['hrga_staff2'];
		$app_hrgas = "0";
		$tgl_apphrgas = "0000-00-00";
		$nik_hrgaspv = $_POST['hrga_spv'];
		$app_hrgaspv = "0";
		$tgl_apphrgaspv = "0000-00-00";
		$nik_hrgamng = $_POST['hrga_mng'];
		$app_hrgamng = "0";
		$tgl_apphrgamng = "0000-00-00";
		$ket = $_POST['ket'];
		$ket2 = $_POST['ket2']; 
 
					date_default_timezone_set("Asia/Bangkok");
					$nowdate_forexpire = date('Y-m-d');
  
				 
		 
		//Post NIK GM
		
  //echo "`  `$nik`, `$kode_jcuti`, `$tgl_pengajuan`, $nm_lengkap, $detail_tanggal ";
  //`nik_gm`, `stt_appgm`, `tgl_appgm`, `nik_pdir`, `stt_apppdir`, `tgl_apppdir`
   $sql = "INSERT INTO tr_cuti 
					( `id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`,
					`tgl_akhir`, `detail_tanggal`, `total_hari`,  `cuti_tahun`, 
					`alasan`, `nik_sleader`, `status_sleader`, `tgl_appsleader`, `nik_check1`,
					`status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`,
					`nik_approve1`, `status_approve1`, `tgl_approve1`, `nik_approve2`, 
					`status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`, `tgl_apphrgas`,
					`nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`, 
					`tgl_apphrgamng`,  `ket`, `ket2`)
			VALUES (NULL, '$niks', '$kode_jcuti', '$newtgl_pengajuan', '$newtgl_awalc', 
					'$newtgl_akhir', '$detail_tanggal', '$total_cutis','$cuti_tahun',
					'$alasan','$nik_sleader','$status_sleader','$tgl_appsleader', '$nik_check1',
					'$status_check1',  '$tgl_check1',  '$nik_check2',  '$status_check2', '$tgl_check2',
					'$nik_approve1',  '$status_approve1',  '$tgl_approve1',  '$nik_approve2',
					'$status_approve2','$tgl_approve2','$nik_hrgas', '$app_hrgas', '$tgl_apphrgas', 
					'$nik_hrgaspv', '$app_hrgaspv','$tgl_apphrgaspv', '$nik_hrgamng', 
					'$app_hrgamng', '$tgl_apphrgamng',  '$ket', '$ket2')";
 //var_dump($sql);
   
    if ($conn->query($sql) === TRUE) {
   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data cuti setengah berhasil ditambahkan'); 
	  window.location.href='view_his.php';
    </script>");  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}    

$sqlupdate = "UPDATE cuti_lahir SET tag ='0' WHERE id_ctahunan ='$id_cutirplcmn'";
//var_dump($sql);
 //echo $sqlupdate;
   if ($conn->query($sqlupdate) === TRUE) {
    /*  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data Leave Succesfully -u');
    window.location.href='preadd_cutithn.php';
    </script>");    */
}  else {
  echo "Error: " . $sqlupdate . "<br>" . $conn->error;
}        
  
 
//$conn->close();
?>
          </div>
          </div>
          </div>
 <!-- End of form -->
 <!-- Email -->
 
<?php
// Email Notification
	$sqlemail = "SELECT    nama_lengkap, nik, email, email2 
			FROM user 
			WHERE 
			nik='$niks' OR
			nik='$nik_sleader'OR 
			nik='$nik_spv' OR 
			nik='$nik_manager' OR 
			nik='$nik_hrgas' OR 
			nik='$nik_hrgaspv' OR 
			nik='$nik_hrgamng'			
			";
			
$resultemailz = $conn->query($sqlemail);
   // var_dump($sqlemail);
 // echo $namas;
	    
 	  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require_once "../mailz/library/PHPMailer.php";
require_once "../mailz/library/Exception.php";
require_once "../mailz/library/OAuth.php";
require_once "../mailz/library/POP3.php";
require_once "../mailz/library/SMTP.php";

	$mail = new PHPMailer;
 
	//Enable SMTP debugging. 
	$mail->SMTPDebug = 3;                               
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = "ssl://mail.bml-log.site"; //host mail server
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = "leave@bml-log.site";   //nama-email smtp          
	$mail->Password = "=hqN4T8OnOc&";           //password email smtp
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "ssl";                           
	//Set TCP port to connect to 
	$mail->Port = 465;                                   
 
	$mail->From = "leave@bml-log.site"; //email pengirim
	$mail->FromName = "Approval Request for Leave"; //nama pengirim
	
// Sent to all email ke atasan	
if ($resultemailz->num_rows > 0) {
  // output data of each row 
  while($rowemailz = $resultemailz->fetch_assoc()) {
 
	  $id_trcuti = $rowemail['id_trcuti'];
	  $nik = $rowemail['nik'];
	  $nama_lengkap = $rowemailz['nama_lengkap'];
	  $emaild = $rowemailz['email'];
	  $emaild2 = $rowemailz['email'];
	  $nm_kecil = strtolower($nama_lengkap);
	  
	 // $mail->addAddress("$emaild","");
	   //var_dump($emaild);
}
}
/* 	$mail->addAddress("jhonridejourney@gmail.com",""); //email penerima Team Leader
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email SPV 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email Manager 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA Staff 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA SPV 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA MNG  */
	$mail->isHTML(true);
	$bodys="Dear 2 Target";
	$subjek="Approvals Leave Request 2 Target";
	$mail->Subject = $subjek; //subject
    $mail->Body    = $bodys; //isi email
        $mail->AltBody = "PHP mailer"; //body email (optional)
 
	if(!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	    echo "Message has been sent successfully";
	}
 
?>
 <!-- End of email -->
 
 
 
 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include"assets/template/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<?php include"assets/template/footerjs.php";?>

</body>

</html>

