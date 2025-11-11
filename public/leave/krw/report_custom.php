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
	$kode_loca = $_SESSION['kode_loc'];
	$kode_depo = $_SESSION['kode_dep'];
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
 
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php //include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->	<center><h4>REPORT CUTI</h4><br></center>
<button type="button" class="btn btn-inverse-success btn-fw">Single Report</button>
           <div class="row"> 			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

 
                  <form class="forms-sample" method='post' enctype="multipart/form-data"  action='action_report.php'>
 
                    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <div class="col-sm-7">
                        <input type="date" name='tgl_awal' value='<?php  echo date("d-m-Y");?>'  class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <div class="col-sm-7">
                        <input type="date" name='tgl_akhir' value='<?php  echo date("d-m-Y");?>'  class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
								 <div class="form-group row">
			 <label for="exampleInputMobile" class="col-sm-3 col-form-label">Jenis Cuti</label>
			  <div class="col-sm-9">
			 
				<select name='jenis_cuti'class="js-example-basic-multiple w-100">
				<option value='all'>All</option>
								
			  <?php
	  
					 $sql = " SELECT  `id_jcuti`, `kode_jcuti`, `nama_cuti`, `keterangan` FROM `jenis_cuti`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_jcuti = $row["kode_jcuti"];
						  $nama_cuti = $row["nama_cuti"];  
					   echo "<option value='$kode_jcuti'> $nama_cuti </option>";
					   }
					} else {
					  echo "0 results";
					}
					 
					?>
					</select>
			  </div>
			</div>
				  <hr>

                    <div class="form-group row">
					  <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
					  <select class="js-example-basic-multiple w-100" name='nik'> 
					  <option value='all'>All</option>
					 <?php
					  
					 $sql = "SELECT `id_user`, `nama_lengkap`, 
					 `nik` FROM `user`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_u  = $row["id_user"];
						  $nama_lengkap = $row["nama_lengkap"];
						  $nik = $row["nik"]; 
						 echo "<option value='$nik'>$nama_lengkap</option>";
					  }
					}  
					 
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
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Location</label>
                      <div class="col-sm-9">
                      <select name='kode_loc' class="js-example-basic-multiple w-100">
					<option value='all'>All Location</option>
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
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
                 <select name='kode_dep' class="js-example-basic-multiple w-100">                     			 
					<option value='all'>All Department</option>
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
					$conn->close();
					?>
				</select>
                      </div>
                    </div>
					
 					<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Section</label>
                      <div class="col-sm-9"> 
 
				<select name="kode_section" id="provinsi" class="js-example-basic-multiple w-100">
					<option value='all'>All Section</option>
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

                    <div class="form-group row">
                     
                      <div class="col-sm-9">  
					<input type="reset" name='upload' class="btn btn-secondary" Value='Reset'>    
					<input type="submit" name='upload' class="btn btn-success" Value='Export Excel'>  
					  </div> 
                    </div>
					
 
                 
                </div>
              </div>
            </div> 
                  </form>
         
 
 
          </div>
		  
 <!-- End of form -->
 
 
 
 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
 
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

