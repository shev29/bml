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
      <!-- partial:partials/_settings-panel.html -->
	<?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Data Section</h4>
				  <?php
				  	include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$get_id_section = $_GET['id_section'];
						$result6 = mysqli_query($conn, "SELECT  `id_section`, `kode_section`, `ket`, `ket2` FROM `section`
						where id_section='$get_id_section'
														");
					// var_dump($get_idloc);
						// tampilkan query
						 $row6=mysqli_fetch_row($result6);
							$id_section=$row6[0];
							$kode_section=$row6[1];
							$ket=$row6[2]; 
							$ket2=$row6[3];
							?>
					<!-- `id_section`, `kode_section`, `ket`, `ket2` -->
                  <form class="forms-sample" method='post' action='update_sec.php'>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-5 col-form-label">Nama&nbsp;Section</label>
                      <div class="col-sm-7">
                        <input type="hidden" name='id_section' value='<?php echo $id_section; ?>' class="form-control" id="exampleInputUsername2" >
                        <input type="text" name='kode_section' value='<?php echo $kode_section; ?>' class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ket</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name='ket' value='<?php echo $ket; ?>' id="exampleInputUsername2"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ket2</label>
                      <div class="col-sm-9">
                        <input type="text" name='ket2' value='<?php echo $ket2; ?>' class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
					<input type="submit" name='upload' class="btn btn-primary mr-2" Value='Update'> 
                    <button class="btn btn-light">Cancel</button>					
                       
                  </form>
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

