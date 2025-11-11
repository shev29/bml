<?php
$servername = "localhost";
$userdb = "root";
$password = "";
$dbname = "bml_cuti";

// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 
// Email Notification
	$sqlemail = "SELECT  `id_trcuti`,nama_lengkap, user.nik, email, email2, `status_notif`,
check_1, check_2, approve_1, approve_2,  
(select nama_lengkap from user where nik=check_1)as nm_check1,
(select nama_lengkap from user where nik=check_2)as nm_check2,  
(select nama_lengkap from user where nik=approve_1)as nm_app1, 
(select nama_lengkap from user where nik=approve_2)as nm_app2,
(select email from user where nik=check_1)as email_c1,
(select email from user where nik=check_2)as email_c2,
(select email from user where nik=approve_1)as email_app1,
(select email from user where nik=approve_2)as email_app2
FROM `tr_cutimail` 
INNER JOIN user ON tr_cutimail.nik = user.nik
INNER JOIN app_level ON tr_cutimail.nik = app_level.nik 
 WHERE status_notif='0' 
 limit 0,1";
			
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
	$mail->FromName = "BML Leave online System"; //nama pengirim
	
 // Sent to all email ke atasan	
if ($resultemailz->num_rows > 0) {
  // output data of each row 
  while($rowemailz = $resultemailz->fetch_assoc()) {
 
	  $id_trcuti = $rowemailz['id_trcuti'];
	  $nik_approvals = $rowemailz['nik'];
	  $nama_lengkapapproval = $rowemailz['nama_lengkap'];
	  $emaild = $rowemailz['email'];
	  $emaild2 = $rowemailz['email2'];
	  $nm_kecil = strtolower($nama_lengkapapproval);
	  
	  $mail->addAddress("dudi.ramdani@logisteed.com","");
	   //var_dump($emaild);
}
} 
 	//$mail->addAddress("dudi.ramdani@logisteed.com",""); //email penerima Team Leader
/*	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email SPV 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email Manager 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA Staff 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA SPV 
	$mail->addAddress("dudi.ramdani@hts-bml.co.id",""); //email HRGA MNG  */
	$mail->isHTML(true);
	$bodys.="<table border='0'>";
	$bodys.="<tr><td colspan='3'>Dear $nm_kecil </td></tr> 
			<tr><td colspan='3'>Anda mendapatkan request approval cuti</td></tr>
			<tr><td>Nama :</td><td colspan='2'>$namas</td></tr> 
			<tr><td>Total Hari :</td><td colspan='2'>$total_cutis</td></tr>
			<tr><td>Detail Tanggal :</td><td colspan='2'> $newtgl_awalc $newtgl_akhir</td></tr>
			<tr><td>Alasan : </td><td colspan='2'>$alasan</td></tr>
			<tr><td colspan='3'>Silahkan approve request cuti dengan klik link dibawah ini:</td><td></td><td></td></tr>";
	$bodys.="<tr><td colspan='3'>http://bml-log.site/verify.php?id_trcuti=$id_trcuti&&user=$nik_manager&&token=$tokens&&kode_section=$kode_section </td></tr>";

	$bodys .="<tr><td colspan='3'>Pesan ini otomatis dari system, mohon untuk tidak dibalas<br></td></tr>";
	$bodys .="<tr><td colspan='3'>&nbsp;<br></td></tr>";
	$bodys .="<tr><td colspan='3'>&nbsp;<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Terimakasih<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Regards<br></td></tr>";
	$bodys .="<tr><td colspan='3'>BML Leave Notification System\n</td></tr>"; 	
	$bodys .="</table><br><br>";


	$subjek="Leave Notification System";
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