<?php
include "../assets/configure/sesionkurir.php"; 
include "../assets/configure/koneksi.php"; 
$no_order = $_GET['no_order'];
$alasan = $_GET['alasan'];
$datetime_proses = $_GET['datetime_proses'];
// Email Notification
 
 
 
	$sqlemail = "SELECT  `no_order`, `type_order`, `nama_barang`, `job_refnumber`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`,
	                        `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`, `nik_kurir`,nama_lengkap, `nik_user`, `gambal_ambil`,
	                        (select nama_lengkap from user where nik=nik_user)as nama_user,
	                        (select email from user where nik=nik_user)as email_user,
	                        (select email2 from user where nik=nik_user)as email2_user,
	                        `gambal_kirim`, `status`,   `aktif`, `sequence`
	                FROM tr_pengiriman
	                INNER JOIN user ON tr_pengiriman.nik_kurir = user.nik 
	                WHERE no_order='$no_order'";
			
$resultemailz = $conn->query($sqlemail);
     var_dump($sqlemail);
    // var_dump($sqlemail);
 // echo $namas;
	    
 	  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require_once "mailz/library/PHPMailer.php";
require_once "mailz/library/Exception.php";
require_once "mailz/library/OAuth.php";
require_once "mailz/library/POP3.php";
require_once "mailz/library/SMTP.php";

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
	$mail->FromName = "BML Courier online System"; //nama pengirim
	
 // Sent to all email ke atasan	
if ($resultemailz->num_rows > 0) {
  // output data of each row 
  while($rowemailz = $resultemailz->fetch_assoc()) {
 
	  $nik_pemohon = $rowemailz['nik_user'];
	  $nama_kurir = $rowemailz['nama_lengkap'];  
	  $nama_user = $rowemailz['nama_user'];
	  $emaild = $rowemailz['email_user'];
	  $emaild2 = $rowemailz['email2_user']; 
	   $nama_barang = $rowemailz['nama_barang'];
	   $pending_tgl = $rowemailz['datetime_proses'];
 
	  //$nm_kecil = strtolower($nama_pemohon);
	  $mail->addAddress("dudi.ramdani@logisteed.com","");
	  $mail->addAddress("$emaild","");
	  $mail->addAddress("$emaild2","");
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
	$bodys.="<tr><td colspan='3'>Dear $nama_user, your package has been cancelled/pending for the next day</td></tr> 
	
			<tr><td>No Order</td><td>:</td><td>$no_order</td></tr>
			<tr><td>Item Name</td><td>:</td><td>$nama_barang</td></tr>
			<tr><td>Resend Date</td><td>:</td> <td>$pending_tgl</td></tr>
			
			<tr><td>Reason</td><td> :</td> <td>$alasan	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
			<tr><td>Driver Name</td><td>: </td><td>$nama_kurir	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>"; 
  
	$bodys .="<tr><td colspan='3'>This message sent by system automatically, please do not reply.<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Please check the receipt by click the link below.</td></tr>";
	$bodys.="<tr><td colspan='3'>http://bml-log.site/courier</td></tr>";
  
	$bodys .="<tr><td colspan='3'>&nbsp;<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Thank you.</td></tr>";
	$bodys .="<tr><td colspan='3'>Best Regards,<br></td></tr>";
	$bodys .="<tr><td colspan='3'>BML Courier Notification System\n</td></tr>"; 	
	$bodys .="</table><br><br>";


	$subjek="Courier Notification System";
	$mail->Subject = $subjek; //subject
    $mail->Body    = $bodys; //isi email
        $mail->AltBody = "PHP mailer"; //body email (optional)
 
	if(!$mail->send()) 
	{
	   // echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	   // echo "Message has been sent successfully";
	}
 //update token
  		date_default_timezone_set("Asia/Bangkok");
		$dtime_now = date('Y-m-d h:i:s'); 
		//UPDATE `user` SET `exp_token` = NOW() WHERE `user`.`id_user` = 1;
		//DATE_ADD(NOW(), INTERVAL 1 DAY)
 
 header('Location:todayorder.php');

?>
 <!-- End of email -->