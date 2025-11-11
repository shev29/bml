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
                  <h4 class="card-title">Register New User</h4>
 
                  <form class="forms-sample" method='post' action='post_user.php'>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" name='nama' class="form-control" id="exampleInputUsername2" placeholder="Nama Lengkap">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name='nik' id="exampleInputUsername2" placeholder="NIK Karyawan">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Hire Date</label>
                      <div class="col-sm-9">
                        <input type="date" name='hire_date' class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
										
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Location</label>
                      <div class="col-sm-9">
                      <select name='kode_loc' class="js-example-basic-multiple w-100">
        
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "	SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` FROM `location`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_loc = $row["kode_loc"];
						  $nama_loc = $row["nama_loc"]; 
						  $alias = $row["alias"]; 
					  echo "<option value='$alias'>[$alias] $nama_loc </option>";
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
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                 <select name='kode_dep' class="js-example-basic-multiple w-100">        
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
						  $kode_dep = $row["kode_dep"];
						  $ket = $row["ket"];						 
						  $nm_kecil = strtolower($nama_dep);
						  $nmt_new = ucwords($nm_kecil);			 
						  $ket_kecil = strtolower($ket);
						  $ket_new = ucwords($ket_kecil);
					  echo "<option value='$kode_dep'>$nmt_new [$ket]</option>";
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
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Section</label>
                      <div class="col-sm-9"> 
 
				<select name="kode_section" id="provinsi" class="js-example-basic-multiple w-100">
				 
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT  `id_section`, `kode_section`, `ket`, `ket2` FROM section";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_section = $row["kode_section"];
						echo "<option value='$kode_section'>" . $row["kode_section"]. "</option>";
					  }
					} else {
					  echo "0 results";
					}
					$conn->close();
					?>
				</select>
 
                      </div>
                    </div>

					 
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
 
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" name='username' class="form-control" id="exampleInputMobile" placeholder="Username"> 
                        <!--<input type="checkbox" class="form-check-input"> Generate--> 
                      </div>
                    </div>
 
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="text" name='password' readonly value='Bml5678#' class="form-control" id="exampleInputPassword2" placeholder="Password">
                      </div>
                    </div>
                 <!--   <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                      <div class="col-sm-9">
                        <input type="password" name='repassword'  class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                      </div>
                    </div>-->
						<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Level</label>
                      <div class="col-sm-9">
                        <select name='level' class="form-control form-control-sm" id="exampleFormControlSelect3">
						<option>Choose Level</option> 
                     					<?php
 					include "assets/configure/koneksi.php";  
					 $sql = "SELECT `id_level`, `kode_level`, `nama_level`, `ket`  FROM `level`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_level = $row["kode_level"];
						  $nama_level = $row["nama_level"]; 
					  
					  echo "<option value='$nama_level'>$nama_level</option>";
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
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Level Akses</label>
                      <div class="col-sm-9">
                        <select name='level_akses' class="form-control form-control-sm" id="exampleFormControlSelect3">
						<option>Choose Level User</option>
						<option value='admin'>Admin</option>
						<option value='user'>User</option>
 
				</select>
                      </div>
                    </div>
				
					 <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email 1</label>
                      <div class="col-sm-9">
                        <input type="email" name='email' class="form-control" id="exampleInputEmail2" placeholder="Email 1">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email 2</label>
                      <div class="col-sm-9">
                        <input type="email" name='email2' class="form-control" id="exampleInputEmail2" placeholder="Email 2">
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                    <button class="btn btn-light">Cancel</button><button type="submit" class="btn btn-primary mr-2">Submit</button>
                      </div>
                    </div> 
 

                    
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

