<?php 
include "../assets/configure/sesionkurir.php"; 
$nama_kurir = $_SESSION['nama'];
$nikkur = $_SESSION['nik'];
//echo $nikul;
?>
<?php
include "vendor/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
if($_POST['upload']){
			$ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	
			$now_resi = $_POST['now_resi'];	
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, '../doc_pendukung/'.$nama);
					$sql = "UPDATE `tr_pengiriman` SET `gambal_kirim = '$nama',`status` = 'On Delivery' WHERE `tr_pengiriman`.`no_order` = $now_resi";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
 
						echo 'FILE BERHASIL DI UPLOAD';
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
					}
				}else{
					echo 'UKURAN FILE TERLALU BESAR';
				}
			}else{
				echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
			}
		}
		   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data Pick Up berhasil ditambahkan');
    window.location.href='home.php';
    </script>"); 
		?>