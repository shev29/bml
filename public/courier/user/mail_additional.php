<?php
include "../assets/configure/sesionuser.php"; 
include "../assets/configure/koneksi.php"; 
$no_order = $_GET['resi'];

 
 
 
	$sqlemail = "SELECT  `no_order`, `type_order`, `nama_barang`, `job_refnumber`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`,
	                        `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`, `nik_kurir`,nama_lengkap, `nik_user`, `gambal_ambil`,
	                        (select nama_lengkap from user where nik=nik_user)as nama_user,
	                        (select email from user where nik=nik_user)as email_user,
	                        (select email2 from user where nik=nik_user)as email2_user,
	                        `gambal_kirim`, `status`,   `aktif`, sequence, tr_pengiriman.ket2
	                FROM tr_pengiriman
	                LEFT JOIN user ON tr_pengiriman.nik_kurir = user.nik 
	                WHERE no_order='$no_order'";
			
        $resultemailz = $conn->query($sqlemail);
  //var_dump($sqlemail);
 // echo $namas;
	    
 	  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require_once "../kurir/mailz/library/PHPMailer.php";
require_once "../kurir/mailz/library/Exception.php";
require_once "../kurir/mailz/library/OAuth.php";
require_once "../kurir/mailz/library/POP3.php";
require_once "../kurir/mailz/library/SMTP.php";

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
	$mail->FromName = "BML Courier online System"; //nama pengirim
	
 // Sent to all email ke atasan	
if ($resultemailz->num_rows > 0) {
  // output data of each row 
  while($rowemailz = $resultemailz->fetch_assoc()) {
 
	  $nik_pemohon = $rowemailz['nik_user'];
	  //$nama_kurir = $rowemailz['nama_lengkap'];  
	  $nama_user = $rowemailz['nama_user'];
	  $emaild = $rowemailz['email_user'];
	  $emaild2 = $rowemailz['email2_user']; 
	   $nama_barang = $rowemailz['nama_barang'];
	   $pending_tgl = $rowemailz['datetime_proses'];
	   $tgl_log = $rowemailz['tgl_log'];
	   $ket2 =$rowemailz['ket2'];
 
	  //$nm_kecil = strtolower($nama_pemohon);
	  $mail->addAddress("dudi.ramdani@logisteed.com","");
	  $mail->addAddress("bml-ho-hrd@logisteed.com","");
	 // $mail->addAddress("$emaild2","");
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
	$bodys.="<tr><td colspan='3'>Dear HR/GA Teams, your have Additional Request</td></tr> 
	
			<tr><td>No Order</td><td>:</td><td>$no_order</td></tr>
			<tr><td>Item Name</td><td>:</td><td>$nama_barang</td></tr>
			<tr><td>Request Date</td><td>:</td> <td>$tgl_log</td></tr>
			<tr><td>Process Date</td><td>:</td> <td>$pending_tgl</td></tr>
			<tr><td>Reason</td><td> :</td> <td>$ket2	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
			<tr><td>User Name</td><td>: </td><td>	$nama_user&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>"; 
  
	$bodys .="<tr><td colspan='3'>This message sent by system automatically, please do not reply.<br></td></tr>";
	$bodys .="<tr><td colspan='3'>Please check the receipt by click the link below.</td></tr>";
	$bodys.="<tr><td colspan='3'>http://bml-log.com/courier</td></tr>";
  
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
 
 header('Location:important_pickup.php');

?>
 <!-- End of email -->