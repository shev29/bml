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
        
        $id_app = $_POST['id_app'];
        $nikuser = $_POST['nikuser']; 
        $check_1 = $_POST['check_1'];
        $check_2 = $_POST['check_2'];
        $approve_1 = $_POST['approve_1'];
        $approve_2 = $_POST['approve_2'];
        
        
        /* `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`,
         `kode_dep`, `kode_section`, `level`, `level_akses`, `atasan_nik`, `atasan2_nik`, `token`, `exp_token`,
         `status_aktif`, `ket`, `ket2` */
     
        $sql = "UPDATE `app_level` SET `check_1` = '$check_1', `check_2` = '$check_2', `approve_1` = '$approve_1', `approve_2` = '$approve_2' WHERE id_app = $id_app";
        //var_dump($sql);
         if ($conn->query($sql) === TRUE) {
          echo ("<script LANGUAGE='JavaScript'>
            window.alert('Update Data Mastr Approval Berhasil');
            window.location.href='app_level.php';
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

