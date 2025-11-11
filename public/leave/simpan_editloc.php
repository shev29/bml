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

$id_loc = $_POST['id_loc']; 
$kode_loc = $_POST['kode_loc']; 
$nama_loc = $_POST['nama_loc']; 
$alias = $_POST['alias']; 
$alamat = $_POST['alamat']; 
$ket = $_POST['ket']; 

$sql = "UPDATE Location SET kode_loc='$kode_loc',
							nama_loc='$nama_loc',
							ket='$ket',
							alamat='$alamat',
							alias='$alias' 
							WHERE id_loc='$id_loc'";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update Data Location Succesfully');
    window.location.href='view_dloc.php';
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

