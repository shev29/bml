<?php
include "../assets/configure/sesionkurir.php"; 
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
if($_POST['upload']){
			$ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	
			$now_resi = $_POST['now_resi'];	
			$datetime_proses = $_POST['datetime_proses'];	
			$status = "Pending";
			$alasan = $_POST['alasan'];	
 		
					move_uploaded_file($file_tmp, '../doc_pendukung/'.$nama);
					$sql = "UPDATE `tr_pengiriman` SET `gambal_ambil` = '$nama', status='$status', datetime_proses='$datetime_proses', ket2='$alasan'  WHERE `tr_pengiriman`.`no_order` = $now_resi";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
 		   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Kirim email pemberitahuan pending');
    window.location.href='mail_cancel.php?no_order=$now_resi&alasan=$alasan&$datetime_proses=datetime_proses';
    </script>"); 
					 
			}
		}

		?>