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
///`id_section`, `kode_section`, `ket`, `ket2` 
$id_section = $_POST['id_section']; 
$kode_section = $_POST['kode_section']; 
$ket2 = $_POST['ket2']; 
$ket = $_POST['ket']; 

$sql = "UPDATE section SET kode_section='$kode_section',
							ket='$ket',  
							ket2='$ket2'  
							WHERE id_section='$id_section'";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update Data Section Succesfully');
    window.location.href='view_section.php';
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

