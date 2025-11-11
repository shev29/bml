 <?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$nama = $_SESSION['nama'];	
	$username = $_SESSION['username'];	
	//echo $username;
?> 
 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/head.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
 
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/wrapper.php"; ?>
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
      <?php
 
 //<!-- `id_dep`, `kode_dep`, `nama_dep`, `ket` --> 
include "assets/configure/koneksi.php";  
///`id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`,`ket`
//$id_loc = $_POST['id_loc'];
$kode_loc = $_POST['kode_loc'];
$nama_loc = $_POST['nama_loc'];  
$alias = $_POST['alias'];  
$alamat = $_POST['alamat'];  
$ket = $_POST['ket'];  
 

 

  $sql = "INSERT INTO location 
					( `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`,`ket`)
VALUES (NULL, '$kode_loc', '$nama_loc', '$alias', '$alamat','$ket')";
//var_dump($sql);
 
 if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Insert Data Location Succesfully');
    window.location.href='new_location.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}   
 
//$conn->close();
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

