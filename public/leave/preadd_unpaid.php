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

 <?php include "assets/template/rowwelcome.php"; ?>

 
          <div class="row">
 <!-- form -->	<center><h4>FORM UNPAID</h4><br></center>
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

 
                  <form class="forms-sample" method='post' action='post_ctahunan.php'>
                     <div class="form-group row">
					 <div class="col-sm-9">
					 <label>Potong Cuti Tahun</label>
                     	 <select name="cuti_tahun"> 
						 <?php
							$now=date('Y');
							$add_oneyear = date('Y', strtotime('+1 year'));
						
							for ($a=$now;$a<=$add_oneyear;$a++)
							{
								 echo "<option value='$a'>$a</option>";
							}
							?>	
							  </select> 
                    </div>
                    </div>
                    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-7">
                        <input type="text" name='tgl_pengajuan' value='<?php  echo date("d-m-Y");?>' Readonly class="form-control" id="exampleInputUsername2" >
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
                        <input type="text" name='nm_lengkap' value='<?php  echo $nama_lengkap;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input type="text" name='niks' value='<?php  echo $nik;?>' Readonly class="form-control" id="exampleInputUsername2" >
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
               <!--  <select name='kode_dep' class="js-example-basic-multiple w-100">  -->                   			 
 
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT id_dep, kode_dep, nama_dep, ket
							FROM department		where kode_dep='$kode_depo'				 
							
							ORDER BY id_dep limit 0,1";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_dep = $row["id_dep"];
						  $kode_dep = $row["kode_dep"];
						  $nama_dep = $row["nama_dep"];
						  $ket = $row["ket"];						 
						  $nm_kecil = strtolower($nama_dep);
						  $nmt_new = ucwords($nm_kecil);			 
						  $ket_kecil = strtolower($ket);
						  $ket_new = ucwords($ket_kecil);
					 // echo "<option value='$id_dep'>$nmt_new [$ket]</option>";
					   echo "<input type='hidden' name='kode_loc' value='$id_dep'>
					   <input type='text' class='form-control' readonly value='$nmt_new [$kode_dep]'>";
					 
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
                      <!--<select name='kode_loc' class="js-example-basic-multiple w-100">-->
        
					<?php
	  
					 $sql = "	SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` FROM `location` where alias='$kode_loca'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $kode_loc = $row["kode_loc"];
						  $nama_loc = $row["nama_loc"]; 
						  $alias = $row["alias"]; 
					  //echo "<option value='$kode_loc'>[$alias] $nama_loc </option>";
					  echo "<input type='hidden' name='kode_loc' value='$kode_loc'><input type='text' class='form-control' readonly value='[$alias] $nama_loc'>";
					  }
					} else {
					  echo "0 results";
					}
					$conn->close();
					?>
				<!--</select>-->
                      </div>
                    </div>
				

                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tanggal Join PT. BML </label>
                      <div class="col-sm-5">
                        <input type="text" name='hire_date' value='<?php  echo $hire_date;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div> 
                    </div>
					
 
                 
                </div>
              </div>
            </div>
 <!-- satu colom form -->
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">  
                  <div class="form-group">
				    <p class="card-description">
                   Alpha Tanggal
                  </p> 
 
<div class="container">
 
	<input type="text" name='detail_tanggal' value='' class="form-control date" placeholder="Pick single or multiple dates">
	 
</div><br>
 <label for="exampleTextarea1">Total Alpha</label>  <input type='text' name='total_hari' size='5' value='' id='total'>  <label for="exampleTextarea1">Hari</label>
 
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
<script  src="dist/script.js"></script>

                    <div class="input-group">  
                    </div>
                  </div>
				     <div class="form-group row">
                    <p class="card-description">
                    Dengan ini mengatakan Alpha karena:
                  </p> 
 
                    </div>
					 <div class="form-group">
                      <label for="exampleTextarea1">Alasan / Keperluan</label>
                      <textarea class="form-control" id="exampleTextarea1" name='alasan'rows="4"></textarea>
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

