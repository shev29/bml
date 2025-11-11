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
<?php include "assets/template/headform.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php";
     
include "assets/configure/koneksi.php";  

					?>
 
		 
 	
					
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php //include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->	<center><h4>FORM PENGAJUAN CUTI</h4><br></center>
           <div class="row"> 
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

 
                  <form class="forms-sample" method='post' action='post_user.php'>
                    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-7">
                        <input type="text" name='hire_date' value='<?php  echo date("d-m-Y");?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
				  <hr>

                    <div class="form-group row">
					 <?php
					  
					 $sql = "SELECT `id_user`, `nama_lengkap`, 
					 `nik`, `hire_date`, `email`, `email2`, 
					 `username`, `password`, `kode_loc`, 
					 `kode_dep`, `level`, `atasan_nik`, 
					 `token`, `exp_token` FROM `user` where username='$username'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_u  = $row["id_user"];
						  $nama_lengkap = $row["nama_lengkap"];
						  $nik = $row["nik"];
						  $hire_date = $row["hire_date"];
						 
					  }
					}  
					 
					 ?>
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" name='hire_date' value='<?php  echo $nama_lengkap;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input type="text" name='hire_date' value='<?php  echo $nik;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
										
 

					 
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				
									<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                 <select name='kode_dep' class="js-example-basic-multiple w-100">                     			 
					<option value=''>Department</option>
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT id_dep, kode_dep, nama_dep, ket
							FROM department						 
							
							ORDER BY id_dep";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_dep = $row["id_dep"];
						  $nama_dep = $row["nama_dep"];
						  $ket = $row["ket"];						 
						  $nm_kecil = strtolower($nama_dep);
						  $nmt_new = ucwords($nm_kecil);			 
						  $ket_kecil = strtolower($ket);
						  $ket_new = ucwords($ket_kecil);
					  echo "<option value='$id_dep'>$nmt_new [$ket]</option>";
					  }
					} else {
					  echo "0 results";
					}
				 
					?>
				</select>
                      </div>
                    </div>
					
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Posisi</label>
                      <div class="col-sm-9">
                      <select name='kode_loc' class="js-example-basic-multiple w-100">
        
					<?php
	  
					 $sql = "	SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` FROM `location`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_loc = $row["kode_loc"];
						  $nama_loc = $row["nama_loc"]; 
						  $alias = $row["alias"]; 
					  echo "<option value='$kode_loc'>[$alias] $nama_loc </option>";
					  }
					} else {
					  echo "0 results";
					}
					$conn->close();
					?>
				</select>
                      </div>
                    </div>
				

                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tanggal Join </label>
                      <div class="col-sm-5">
                        <input type="text" name='hire_date' value='<?php  echo $hire_date;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div><label for="exampleInputMobile" class="col-sm-3 col-form-label">PT. BML </label>
                    </div>
					
 
                  </form>
                </div>
              </div>
            </div>
 <!-- satu colom form -->
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <p class="card-description">
                    Dengan ini mohon untuk tidak masuk kerja karena:
                  </p> 
                        <div class="form-group">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                              Cuti Tahunan
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Cuti Melahirkan atau Keguguran
                            </label>
                          </div>
						  <hr>
						   <p class="card-description">
							Cuti Normatif
							</p> 
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Karyawan Menikah
                            </label>
                         </div>
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Penikahan anak karyawan
                            </label>
                          </div>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Khitanan/Baptis anak karaywan
                            </label>
                         </div>
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Penikahan Anak Karyawan
                            </label>
                          </div>
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                              Istri karyawan melahirkan atau keguguran
                            </label>
                          </div>
 
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                             Suami/Istri/Orang Tua/Mertua/Anak/Menantu meninggal dunia
                            </label>
                          </div>
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                             Anggota keluarga dalam satu rumah meninggal dunia
                            </label>
                          </div>
						<div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked>
                             Anggota keluarga dalam satu rumah meninggal dunia
                            </label>
                          </div>
 
                        </div>
                  <div class="form-group">
				    <p class="card-description">
                   Tanggal Mulai
                  </p>
 
                    <div class="input-group"> 
                       

                       
                    </div>
                  </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
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

