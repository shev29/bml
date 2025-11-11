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

 <?php   include "assets/configure/koneksi.php";
$getid_user = $_GET['id_user']; 
$sql = " SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, 
		 location.kode_loc,alias,location.nama_loc,  user.kode_dep,department.nama_dep, user.kode_section, `level`, `level_akses`, `atasan_nik`, `token`, `exp_token`, `status_aktif`
		FROM `user` 
		INNER JOIN location	ON user.kode_loc = location.alias
		INNER JOIN department ON user.kode_dep = department.kode_dep
		INNER JOIN section ON user.kode_section = section.kode_section
		WHERE id_user='$getid_user'
		AND status_aktif='1' ORDER BY id_user DESC
		";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $id_user = $row['id_user'];
	  $nama_lengkap = $row['nama_lengkap'];	  
	  $kode_dep = $row['kode_dep'];
	  $nama_dep = $row['nama_dep'];
	  $nik = $row['nik'];
	  $hire_date = $row['hire_date'];
	  $level = $row['level'];
	  $level_akses = $row['level_akses'];
	  $email = $row['email'];
	  $email2 = $row['email2'];
	  $kode_loc = $row['kode_loc'];
	  $nama_loc = $row['nama_loc'];
	  $alias = $row['alias'];
	  $username = $row['username'];
	  $kode_section = $row['kode_section'];
	  ?>
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Register New User</h4>
 
                  <form class="forms-sample" method='post' action='update_user.php'>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="hidden" name='id_user' value='<?php echo $id_user;?>'>
                        <input type="text" name='nama' value='<?php echo $nama_lengkap;?>' class="form-control" id="exampleInputUsername2" placeholder="Nama Lengkap">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name='nik' value='<?php echo $nik;?>' id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Hire Date</label>
                      <div class="col-sm-9">
                        <input type="date" name='hire_date' value='<?php echo $hire_date;?>' class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
										
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Location</label>
                      <div class="col-sm-9">
                      <select name='kode_loc' class="js-example-basic-multiple w-100">
						<option value='<?php echo $alias;?>'><?php echo"[$alias] $nama_loc";?></option>
					<?php   
					
					 $esql = "SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` 
								FROM `location` 
								WHERE alias!='$alias'";
					
					$eresult = $conn->query($esql);

					if ($eresult->num_rows > 0) {
					  // output data of each row
					  while($erow = $eresult->fetch_assoc()) {
						  $ekode_loc = $erow["kode_loc"];
						  $enama_loc = $erow["nama_loc"]; 
						  $ealias = $row["alias"]; 
					  echo "<option value='$ealias'>[$ealias] $enama_loc </option>";
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
					<option value='<?php echo $kode_dep;?>'><?php echo $nama_dep;?></option>
					<?php
					include "assets/configure/koneksi.php";  
					 $edepsql = "SELECT id_dep, kode_dep, nama_dep, ket
							FROM department	
							WHERE kode_dep!='$kode_dep'  
							ORDER BY id_dep";
					$edepresult = $conn->query($edepsql);

					if ($edepresult->num_rows > 0) {
					  // output data of each row
					  while($rowedep = $edepresult->fetch_assoc()) {
						  $eid_dep = $rowedep["id_dep"];
						  $enama_dep = $rowedep["nama_dep"];
						  $ekode_dep = $rowedep["kode_dep"];
						  $eket = $rowedep["ket"];						 
						  $enm_kecil = strtolower($enama_dep);
						  $nmt_new = ucwords($enm_kecil);			 
						  $eket_kecil = strtolower($eket);
						  $ket_new = ucwords($eket_kecil);
					  echo "<option value='$ekode_dep'>$nmt_new [$ket_new]</option>";
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
					<option value='<?php echo $kode_section;?>'><?php echo $kode_section;?></option>
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT  `id_section`, `kode_section`, `ket`, `ket2` 
							 FROM section
							 WHERE kode_section!='$kode_section'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $ekode_section = $row["kode_section"];
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
                        <input type="text" name='username' value='<?php echo $username;?>'  class="form-control" > 
                        <!--<input type="checkbox" class="form-check-input"> Generate--> 
                      </div>
                    </div>
 
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" name='password' readonly value='Bml5678#'  class="form-control"   >
                      </div>
                    </div>
                 <!--   <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                      <div class="col-sm-9">
                        <input type="password" name='repassword'  class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                      </div>
                    </div>-->
						<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label" >Level</label>
                      <div class="col-sm-9">
                        <select name='level'  class="form-control"  id="exampleFormControlSelect3">
						<option value='<?php echo $level;?>'><?php echo $level;?></option> 
                     					<?php
 					include "assets/configure/koneksi.php";  
					 $sql = "SELECT `id_level`, `kode_level`, `nama_level`, `ket`  FROM `level`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_level = $row["kode_level"];
						  $nama_level = $row["nama_level"]; 
					  
					  echo "<option value='$kode_level'>$nama_level</option>";
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
					 <label for="exampleInputPassword2" class="col-sm-3 col-form-label" >Level Akses</label> 
                      <div class="col-sm-9">
                        <select name='level_akses' class="form-control" id="exampleFormControlSelect3">
						<option value='<?php echo $level_akses;?>'><?php echo $level_akses;?></option>
						<option value='admin'>Admin</option>
						<option value='user'>User</option>
 
				</select>
                      </div>
                    </div>
				
					 <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email 1</label>
                      <div class="col-sm-9">
                        <input type="email" name='email' value='<?php echo $email;?>' class="form-control" id="exampleInputEmail2" placeholder="Email 1">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email 2</label>
                      <div class="col-sm-9">
                        <input type="email" name='email2' value='<?php echo $email2;?>'class="form-control" id="exampleInputEmail2" placeholder="Email 2">
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
 
<?php }}?>
 
 
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

