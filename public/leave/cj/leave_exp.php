<meta http-equiv='refresh' content='60' />
<?php
$servername = "localhost";
$userdb = "u7195330_bmladmin";
$password = "BML@P@ssww0rd@MySQL";
$dbname = "u7195330_bmlleave";


// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set("Asia/Jakarta");
    $nowdate = date("Y");
    $minusnowdate = $nowdate-1;
    $nowymd = date("Y-m-d");
    $final = date("d M Y", strtotime("+6 month"));
    $fulldate = date("-m-d");
    
    
     
$sqlexp = "SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `group_email`, `username`,
	`password`, `kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `level_akses`, `token`, `exp_token`,
	`status_aktif`, `ket`, `ket2`, `courier_akses` FROM `user`
WHERE hire_date like'%$fulldate%'";
$resultexp = $conn->query($sqlexp);

 		
  	  
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
	$mail->FromName = "BML Leave online System"; //nama pengirim
 
if ($resultexp->num_rows > 0) {
    // output data of each row
    while($rowexp = $resultexp->fetch_assoc()) {
        if($rowexp["email"] != '' && $rowexp["email"] != null){
            $nama_lengkap = $rowexp["nama_lengkap"];
            $email = $rowexp["email"]; 
            //echo " $nama_lengkap $email<br>";
            $mail->addAddress("$email","");
            
            $bodys ="<table border='0'>";
        	$bodys.="<tr><td colspan='3'>Dear $nama_lengkap </td></tr> 
        			<tr><td colspan='3'>Cuti  anda akan expired di $final</td></tr>   
        			<tr><td colspan='3'>Silahkan mengajukan/melakukan check balance cuti di:</td><td></td><td></td></tr>";
        	$bodys.="<tr><td colspan='3'>http://bml-log.com</td></tr>";
        
        	$bodys .="<tr><td colspan='3'>Pesan ini otomatis dari system, mohon untuk tidak dibalas.<br></td></tr>";
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
        }
    }
}
	  
	 
	
 
 
 
 

?>
 