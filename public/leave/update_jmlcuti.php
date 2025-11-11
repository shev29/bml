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
$id_ctahunan = $_POST['id_ctahunan']; 
$jumlah = $_POST['jumlah']; 
 
$sql = "UPDATE cuti_lahir SET jumlah='$jumlah' 
							  
							WHERE id_ctahunan='$id_ctahunan'";
//var_dump($sql);
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update total successfuly');
    window.location.href='view_cthn.php';
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

