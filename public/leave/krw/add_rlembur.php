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
 
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/wrapper.php"; ?>
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
		   
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cuti Replacement dari Lembur</h4>
 
                  <form class="forms-sample" method='post' action='post_rlembur.php'>
				    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tanggal</label>
                      <div class="col-sm-5">
                        <input type="date" name='tgllahir_cuti' class="form-control" id="exampleInputEmail2" placeholder="Total Hari">
                      </div>
                    </div> 
					
				<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Nama&nbsp;Karyawan</label>
                      <div class="col-sm-5">
                 <select name='nik' class="js-example-basic-multiple w-100">                     			 
					<option value=''>Pilih</option>
					<?php
					include "assets/configure/koneksi.php"; 
					
					 $sql = "SELECT `id_user`, `nama_lengkap`, `nik` FROM `user`					 
							
							ORDER BY nama_lengkap ASC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_user = $row["id_user"];
						  $nama_lengkap = $row["nama_lengkap"];
						  $nik = $row["nik"];						 
							$nm_kecil = strtolower($nama_lengkap);
						  $nmt_new = ucwords($nm_kecil);			 
						 /* $ket_kecil = strtolower($ket);
						  $ket_new = ucwords($ket_kecil); */
					  echo "<option value='$nik'>$nmt_new</option>";
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
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Total Hari</label>
                      <div class="col-sm-5">
                        <input type="text" name='total' value='1' class="form-control" id="exampleInputEmail2" readonly >
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Keterangan&nbsp;Lembur</label>
                      <div class="col-sm-5">
                        <input type="text" name='ket'   class="form-control" id="exampleInputEmail2"  >
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

