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
	
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/headform.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
 
      <?php include "assets/template/wrapper.php"; ?>
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php //include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Data Cuti Karyawan</h4>
					<!-- `id_dep`, `kode_dep`, `nama_dep`, `ket` -->
					
					<?php 
						include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$get_id = $_GET['id'];
						$result6 = mysqli_query($conn, "SELECT    nama_lengkap,  
				`jumlah` , cuti_lahir.nik, tahun
		        FROM `cuti_lahir`
		        INNER JOIN jenis_cuti ON cuti_lahir.kode_jcuti=jenis_cuti.kode_jcuti
		      INNER JOIN user ON cuti_lahir.nik=user.nik	WHERE id_ctahunan='$get_id'
														");
					// var_dump($get_idloc);
						// tampilkan query
						 $row6=mysqli_fetch_row($result6);
							$namakar=$row6[0];
						     $jml=$row6[1];
						      $niku=$row6[2];
						      $tahun=$row6[3];
							 if(!empty($row6)){ 
							
							?>
                   <form class="forms-sample" method='post' action='update_jmlcuti.php'>
                        <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
					   <input type="text" name='nik' value='<?php echo $niku; ?>' class="form-control" id="exampleInputUsername2"  >
                      
                       </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Karyawan</label>
                      <div class="col-sm-9">
					   <input type="hidden" name='id_ctahunan' value='<?php echo $get_id; ?>' class="form-control" id="exampleInputUsername2"  >
                      
                        <input type="text" name='nama_lengkap' value='<?php echo $namakar;?>' class="form-control" id="exampleInputUsername2" placeholder='(TB8...)' >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jumlah Cuti</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name='jumlah' value='<?php echo $jml;?>' id="exampleInputUsername2"  >
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tahun</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name='tahun' readonly value='<?php echo $tahun;?>' id="exampleInputUsername2"  >
                      </div>
                    </div>
                    
					<input type="reset"  class="btn btn-primary mr-2" Value='Reset'>              
					<input type="submit" name='upload' class="btn btn-primary mr-2" Value='Update'>  
                  </form>
				  <?php
							 }				  
				  ?>
                </div>
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

