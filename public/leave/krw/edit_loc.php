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
                  <h4 class="card-title">Edit Data Location</h4>
					<!-- `id_dep`, `kode_dep`, `nama_dep`, `ket` -->
					
					<?php 
						include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$get_idloc = $_GET['id_loc'];
						$result6 = mysqli_query($conn, "SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`,
														`ket` FROM `location` where id_loc='$get_idloc'
														");
					// var_dump($get_idloc);
						// tampilkan query
						 $row6=mysqli_fetch_row($result6);
							$id_loc=$row6[0];
							$kode_loc=$row6[1];
							$nama_loc=$row6[2];
							$alias=$row6[3];
							$alamat=$row6[4];
							$ket=$row6[5]; 
							 if(!empty($row6)){ 
							
							?>
                  <form class="forms-sample" method='post' action='simpan_editloc.php'>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kode Loc</label>
                      <div class="col-sm-9">
                        <input type="hidden" name='id_loc' value='<?php echo $get_idloc; ?>' class="form-control" id="exampleInputUsername2"  >
                        <input type="text" name='kode_loc' value='<?php echo $kode_loc; ?>' class="form-control" id="exampleInputUsername2"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Loc</label>
                      <div class="col-sm-9">
                        <input type="text" value='<?php echo $nama_loc; ?>' class="form-control" name='nama_loc' id="exampleInputUsername2"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Alias</label>
                      <div class="col-sm-9">
                        <input type="text" name='alias'  value='<?php echo $alias; ?>' class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
										
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                       
                        <input type="text" name='alamat' value='<?php echo $alamat; ?>' class="form-control" id="exampleInputMobile" > 
                        <!--<input type="checkbox" class="form-check-input"> Generate--> 
                      </div>
                    </div>
 
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Ket</label>
                      <div class="col-sm-9">
                        <input type="text" name='ket' value='<?php echo $ket; ?>' class="form-control" id="exampleInputPassword2"  >
                      </div>
                    </div>    
					<input type="submit" name='upload' class="btn btn-primary mr-2" Value='Simpan'> 
                    <button class="btn btn-light">Cancel</button>
					
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

