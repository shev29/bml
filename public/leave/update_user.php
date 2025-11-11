<?php
error_reporting(0);
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$nama_userl = $_SESSION['nama'];	
	$username = $_SESSION['username'];	
	//echo $username;
?> 
 

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
<?php 
include "assets/configure/koneksi.php";  
///`id_dep`, `kode_dep`, `nama_dep`, `ket

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$hire_date = $_POST['hire_date'];
$kode_loc = $_POST['kode_loc'];
$kode_dep = $_POST['kode_dep'];
$kode_section = $_POST['kode_section'];
//$atasan_nik = $_POST['atasan_nik'];
$username = $_POST['username'];
$password = $_POST['password'];
$pass_md5 = md5($password);
$level = $_POST['level'];
$level_akses = $_POST['level_akses'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$token = md5($username);
$exp_token = "2023-04-16";
$status_aktif = "1";
/* `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`,
 `kode_dep`, `kode_section`, `level`, `level_akses`, `atasan_nik`, `atasan2_nik`, `token`, `exp_token`,
 `status_aktif`, `ket`, `ket2` */
$sql = "UPDATE user SET nama_lengkap='$nama',
							nik='$nik',
							hire_date='$hire_date',
							email='$email',
							email2='$email2',
							username='$username',
							kode_loc='$kode_loc',
							kode_dep='$kode_dep',
							kode_section='$kode_section',
							level='$level',
							level_akses='$level_akses'
							WHERE id_user='$id_user'";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update Data User Berhasil');
    window.location.href='data_user.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}  
 //---------------------------- end upload
?>
          </div>
          </div>
          </div>
 <!-- End of form -->
 
 
 
 
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

