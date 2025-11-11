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
					<?php 
						include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$get_id_app = $_GET['id_app'];
						//echo $get_id_app;
					 include "assets/configure/koneksi.php"; 
$sql = " SELECT  `id_app`, user.nik,nama_lengkap,kode_loc,kode_section,
        `tl_checker`, `check_1`, `check_2`, `approve_1`, `approve_2`, 
        `hrga_staff1`, `hrga_staff2`, `hrga_spv`, `hrga_mng`,
        (select nama_lengkap from user where nik=check_1) as nm_check1,
        (select nama_lengkap from user where nik=check_2) as nm_check2,
         (select nama_lengkap from user where nik=approve_1) as nm_app1,
        (select nama_lengkap from user where nik=approve_2) as nm_app2
        FROM `app_level`
        INNER join user on app_level.nik=user.nik
		WHERE id_app='$get_id_app'";
		//var_dump($sql);
		
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $id_app = $row['id_app'];
	  $niko = $row['id_app'];
	  $nama_lengkap = $row['nama_lengkap'];
	  	$nml_kecil = strtolower($nama_lengkap);
		$nml_new = ucwords($nml_kecil); 
	  $location = $row['kode_loc'];
	  $kode_section = $row['kode_section'];
	  $tl_checker = $row['tl_checker'];
	  
	 //Approval Checks  1a
	  $check_1 = $row['check_1'];
	  $nm_check1 = $row['nm_check1'];
	  	$nm_kecil = strtolower($nm_check1);
		$nmt_new = ucwords($nm_kecil); 
        $pieces = explode(" ", $nmt_new);
        $nm_depan = $pieces[0]; // piece1
        $nm_belakang = $pieces[1]; // piece2
        $nm = ucwords($nm_depan);
        $nmbelakang_alias = substr($nm_belakang,0,1);
        
    //Approval Checks  1b
      $nm_check2 = $row['nm_check2']; 
	  	$nm_kecil2 = strtolower($nm_check2);
		$nmt_new2 = ucwords($nm_kecil2); 
        $pieces2 = explode(" ", $nmt_new2);
        $nm_depan2 = $pieces2[0]; // piece1
        $nm_belakang2 = $pieces2[1]; // piece2
        $nm2 = ucwords($nm_depan);
        $nmbelakang_alias2 = substr($nm_belakang2,0,1);
        
        
       $check_1 = $row['check_1'];
	  $check_2 = $row['check_2'];
	  $approve_1 = $row['approve_1'];
	  $approve_2 = $row['approve_2'];
	  
	  $nm_app1 = $row['nm_app1'];
	  $nm_app2 = $row['nm_app2'];
 
     
  ?>
                  <form class="forms-sample" method='post' action='update_appmaster.php'>
                      
                      
                     <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="hidden" name='id_app' value='<?php echo $get_id_app; ?>' class="form-control" id="exampleInputUsername2"  >
                        <input type="text" name='nik' value='<?php echo  $nama_lengkap; ?>' class="form-control" id="exampleInputUsername2"  >
                         <input type="hidden" name='nikuser' value='<?php echo  $niko; ?>' class="form-control" id="exampleInputUsername2"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Shift Leader</label>
                      <div class="col-sm-9">
                        <input type="text" value='<?php echo $tl_checker; ?>' class="form-control" name='tl_checker' id="exampleInputUsername2"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Check 1</label>
                      <div class="col-sm-9">
                          
                      <select name='check_1' class="js-example-basic-multiple w-100">  
                      
					<?php
					include "assets/configure/koneksi.php";   
					 
					 echo "<option value='$check_1'> $nm_check1 </option>"; 
					 $sqlc1 = "SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`,
					        `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2` FROM `user` ";
					$resultc1 = $conn->query($sqlc1);

					if ($resultc1->num_rows > 0) {
					  // output data of each row
					  while($rowc1 = $resultc1->fetch_assoc()) {
						  $id_user = $rowc1["id_user"];
						  $nik_c1 = $rowc1["nik"]; 
						  $nama_lengkapc1 = $rowc1["nama_lengkap"]; 
					  echo "<option value='$nik_c1'> $nama_lengkapc1 </option>";
					  }
					  echo "<option value='0'> None </option>";
					}  
					$conn->close();
					 
					?>
				</select>
                       </div>
                    </div>
                    
                <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Check 2</label>
                      <div class="col-sm-9">
                      <select name='check_2' class="js-example-basic-multiple w-100">        
					<?php
					include "assets/configure/koneksi.php";   
					 echo "<option value='$check_2'> $nm_check2 </option>";  
					 $sqlc2 = "SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`,
					        `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2` FROM `user` ";
					$resultc2 = $conn->query($sqlc2);

					if ($resultc2->num_rows > 0) {
					  // output data of each row
					  while($rowc2 = $resultc2->fetch_assoc()) {
						  $id_userc2 = $rowc2["id_user"];
						  $nik_c2 = $rowc2["nik"]; 
						  $nama_lengkapc2 = $rowc2["nama_lengkap"]; 
					  echo "<option  value='$nik_c2'> $nama_lengkapc2 </option>";
					  }
					  echo "<option value='0'> None </option>";
					}  
					$conn->close();
					 
					?>
				</select>
                       </div>
                    </div>
 
                 <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Approval 1</label>
                      <div class="col-sm-9">
                        <select name='approve_1' class="js-example-basic-multiple w-100">
                        <?php
                        include "assets/configure/koneksi.php";
					 echo "<option value='$approve_1'> $nm_app1  </option>"; 
					 $sql = "SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`,
					        `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2` FROM `user`  ";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_user = $row["id_user"];
						  $nik_app2 = $row["nik"]; 
						  $nama_lengkap = $row["nama_lengkap"]; 
					  echo "<option value='$nik_app2'> $nama_lengkap </option>";
					  }
					  echo "<option value='0'> None </option>";
					}  
					$conn->close();
					echo $sql;
					?>
                      
				</select>
                      
                      </div>
                    </div>
               
				<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Approval 2</label>
                      <div class="col-sm-9">
                 <select name='approve_2' class="js-example-basic-multiple w-100">        
					<?php
					include "assets/configure/koneksi.php";   
					 echo "<option value='$approve_2'> $nm_app2 </option>"; 
					 $sql = "SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, `kode_loc`, `kode_dep`, `kode_section`,
					        `title`, `level`, `level_akses`, `token`, `exp_token`, `status_aktif`, `ket`, `ket2` FROM `user`  ";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_user = $row["id_user"];
						  $nik_app2 = $row["nik"]; 
						  $nama_lengkap = $row["nama_lengkap"]; 
					  echo "<option value='$nik_app2'> $nama_lengkap </option>";
					  }
					  echo "<option value='0'> None </option>";
					}  
					$conn->close();
					 
					?>
				</select>
                      </div>
                    </div>
					
 				 

                    <input type="Reset"    class="btn btn-inverse-secondary btn-fw" Value='Reset'>
                    <input type="submit" name='upload' class="btn btn-primary mr-2" Value='Simpan'>
                    
					
                  </form>
                  
                  <a href='app_level.php'><img src='images/backaa.png' width='50' height='50'></a>
				  <?php
      
  }
							 }				  
				  ?>

                    
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

 
 
 
