 <?php
include "assets/configure/sesionadmin.php";
include "assets/configure/koneksi.php";
$getid = $_GET['id_b'];
// Email Notification
	$sqlemail = "SELECT tr_cutimail.id_trcuti, nama_lengkap, user.nik, email, email2, tr_cutimail.status_notif, nama_cuti,
	tr_cutimail.total_hari, tr_cutimail.alasan, check_1, check_2, approve_1, approve_2, tr_cuti.detail_tanggal, 
	(select nama_lengkap from user where nik=approve_1)as nm_check1, 
    (select email from user where nik=approve_1)as email_c1, 
	(select email2 from user where nik=approve_1)as email_c12,
    (select username from user where nik=approve_1)as username_c1,
	(select token from user where nik=approve_1)as token_c1 
    FROM `tr_cutimail` INNER JOIN user ON tr_cutimail.nik = user.nik 
	INNER JOIN jenis_cuti ON tr_cutimail.kode_jcuti = jenis_cuti.kode_jcuti 
	INNER JOIN app_level ON tr_cutimail.nik = app_level.nik 
	INNER JOIN tr_cuti ON tr_cutimail.id_trcuti = tr_cuti.id_trcuti
 WHERE tr_cuti.id_trcuti='$getid' 

 ";
// AND   tr_cutimail.status_notif='0' 			
$resultemailz = $conn->query($sqlemail);
     //var_dump($sqlemail);
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
	$mail->Host = "ssl://mail.bml-log.com"; //host mail server
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = "leave@bml-log.com";   //nama-email smtp          
	$mail->Password = "=hqN4T8OnOc&";           //password email smtp
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "ssl";                           
	//Set TCP port to connect to 
	$mail->Port = 465;                                   
 
	$mail->From = "leave@bml-log.com"; //email pengirim
	$mail->FromName = "BML Leave System Karawang"; //nama pengirim
	
 // Sent to all email ke atasan	
if ($resultemailz->num_rows > 0) {
  // output data of each row 
  while($rowemailz = $resultemailz->fetch_assoc()) {
 
	  $id_trcuti = $rowemailz['id_trcuti'];
	  $nik_pemohon = $rowemailz['nik'];
	  $nama_pemohon = $rowemailz['nama_lengkap']; 
	  $nama_cuti = $rowemailz['nama_cuti'];
	  $total_hari = $rowemailz['total_hari'];
	  $detail_tanggal = $rowemailz['detail_tanggal'];
	  $alasan = $rowemailz['alasan'];
	  $emaild = $rowemailz['email'];
	  $emaild2 = $rowemailz['email2'];
	  $nm_check1 = $rowemailz['nm_check1']; 
	  $nik_atasan = $rowemailz['approve_1']; 
	  $email_c1 = $rowemailz['email_c1'];
	  $email_c12 = $rowemailz['email_c12']; 
	  $username_c1 = $rowemailz['username_c1']; 
	  $token_c1 = $rowemailz['token_c1']; 
	  $nm_kecil = strtolower($nama_pemohon);
	   //$mail->addAddress("dudi.ramdani@logisteed.com","");
	  $mail->addAddress("$email_c1","");
	   $mail->addAddress("$email_c12","");
	   //var_dump($email_c1);
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
	$bodys.="<tr><td colspan='3'>Dear $nm_check1 as Approver 2</td></tr> 
			<tr><td colspan='3'>You receive leave request from $nama_pemohon<br>
			Anda mendapatkan request approval cuti dari</td></tr>
			<tr><td>Name / Nama </td><td>: $nama_pemohon</td><td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td></tr> 
			<tr><td>NIK </td><td>: $nik_pemohon</td><td></td></tr> 
			<tr><td>Leave Type / Jenis Cuti </td><td>: $nama_cuti</td><td></td></tr> 
			<tr><td>Total </td><td>: $total_hari Days / Hari</td><td></td></tr> 
			<tr><td>Detail Tanggal </td><td>: $detail_tanggal </td><td></td></tr>
			<tr><td>Reason / Alasan </td><td>: $alasan</td><td></td></tr>
			<tr><td colspan='3'>Please approve leave request by click the link below.<br>
			Silahkan approve request cuti dengan klik link dibawah ini:</td></tr>"; 
    $bodys.="<tr><td colspan='3'>http://bml-log.com/krw/verify2.php?id_trcuti=$id_trcuti&&user=$username_c1&nikp=$nik_atasan&&token=$token_c1</td></tr>";
	$bodys.="<tr><td colspan='3'><br>For more detail</td></tr>";
    $bodys.="<tr><td colspan='3'>Silahkan Login untuk akses penuh / Please Login for full access https://bml-log.com/krw</td></tr>";
	$bodys .="<tr><td colspan='3'>This message sent by system automatically, please do not reply.<br>
	            Pesan ini dikirim secara otomatis dari system, mohon untuk tidak dibalas.<br></td></tr>";
	$bodys .="<tr><td colspan='3'>&nbsp;<br></td></tr>";
	$bodys .="<tr><td colspan='3'>&nbsp;<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Thank you.<br>Terima kasih<br></td></tr>";
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
 //update token
  		date_default_timezone_set("Asia/Bangkok");
		$dtime_now = date('Y-m-d h:i:s'); 
		//UPDATE `user` SET `exp_token` = NOW() WHERE `user`.`id_user` = 1;
		//DATE_ADD(NOW(), INTERVAL 1 DAY)
 $sql = "UPDATE `user` SET `exp_token` = DATE_ADD(NOW(), INTERVAL 7 DAY) WHERE nik='$nik_atasan'";
 //var_dump($sql);
   if ($conn->query($sql) === TRUE) {
 
} 
$sql_updatenotif = "UPDATE `tr_cutimail` SET `status_notif` = '1' WHERE id_trcuti='$id_trcuti'";
 
   if ($conn->query($sql_updatenotif) === TRUE) {
 //getmail_lev1b.php?id_b=$getid
} 
// notif email
 echo ("<script LANGUAGE='JavaScript'>
    window.alert('Email already send');
    window.location.href='view_app.php';
    </script>");  

?>