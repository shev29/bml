 <?php
include "assets/configure/sesionadmin.php";
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
 <?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php  include "assets/template/rowwelcome.php"; ?>

 <div class="row">
 <!-- form -->	<center><h4>FORM PENGAJUAN CUTI MELAHIRKAN</h4><br></center>
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <form class="forms-sample" enctype="multipart/form-data"  method='post' action='post_ctmlr.php'> 
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
					 `kode_dep`, `level`,  
					 `token`, `exp_token` FROM `user` where username='$username'";
					 
					 //var_dump($sql);
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
									<div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Department</label>
                      <div class="col-sm-9">
               <!--  <select name='kode_dep' class="js-example-basic-multiple w-100">  -->                   			 
 
					<?php
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT id_dep, kode_dep, nama_dep, ket
							FROM department		where 	  ket like '%$HR%'		 
							
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
	  
					 $sql = "	SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` FROM `location` where alias like '%karawang%'";
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



					 
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
				   <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Join&nbsp;PT.&nbsp;BML</label>
                      <div class="col-sm-5">
                       <label> <input type="text" name='hire_date' value='<?php  echo $hire_date;?>' Readonly class="form-control" id="exampleInputUsername2" >
                     </label> </div> 
					  
                    </div>

<?php			
 include "assets/configure/koneksi.php"; 
$sql_appz = "SELECT `id_app`, user.nik, (nama_lengkap)as nama_pemohon, `check_1`,tl_checker, (select nama_lengkap from user where nik=tl_checker) as nama_tlchecker, 
(select nama_lengkap from user where nik=check_1) as nama_check1,
`check_2`, (select nama_lengkap from user where nik=check_2) as nama_check2, 
`approve_1`, (select nama_lengkap from user where nik=approve_1) as nama_approve1, 
`approve_2`,(select nama_lengkap from user where nik=approve_2) as nama_approve2, 
`hrga_staff1`,(select nama_lengkap from user where nik=hrga_staff1) as nmhrga_staff1, 
`hrga_staff2`,(select nama_lengkap from user where nik=hrga_staff2) as nmhrga_staff2, 
`hrga_spv`,(select nama_lengkap from user where nik=hrga_spv) as nmhrga_spv, 
`hrga_mng`,(select nama_lengkap from user where nik=hrga_mng) as nmhrga_mng 
FROM `app_level` INNER JOIN user ON app_level.nik=user.nik WHERE app_level.nik='$nikso'";
		  //var_dump($sql_appz);
$result_appz = $conn->query($sql_appz);

if ($result_appz->num_rows > 0) {
  // output data of each row
  while($rowappz = $result_appz->fetch_assoc()) {
     $nik_appz = $rowappz["nik"];
     $nama_pemohon = $rowappz["nama_pemohon"];
     $nama_tlchecker = $rowappz["nama_tlchecker"];
     $tl_checker = $rowappz["tl_checker"];
     $check_1 = $rowappz["check_1"];
     $nama_check1 = $rowappz["nama_check1"];
     $check_2 = $rowappz["check_2"];
     $nama_check2 = $rowappz["nama_check2"];
     $approve_1 = $rowappz["approve_1"];
     $nama_approve1 = $rowappz["nama_approve1"];
     $approve_2 = $rowappz["approve_2"];
	 $nama_approve2 = $rowappz["nama_approve2"];
	 $hrga_staff1 = $rowappz["hrga_staff1"];
	 $hrga_staff2 = $rowappz["hrga_staff2"];
	 $hrga_spv = $rowappz["hrga_spv"];
	 $hrga_mng = $rowappz["hrga_mng"];
	 //var_dump($check_1);
  }
} else {
  echo "0 results";
}
 ?>

				<div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Shift Leader</label>
                      <div class="col-sm-9"> 
        
		
					 <input type='nama_tlchecker' name='nama' class='form-control' readonly value='<?php echo $nama_tlchecker;?>'> 
					 <input type='hidden' name='tl_checker' class='form-control' readonly value='<?php echo $tl_checker;?>'> 
  
                      </div>
                    </div>
				<div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Check By</label>
                      <div class="col-sm-9"> 
        
		
					 <input type='text' class='form-control' readonly value='<?php echo $nama_check1;?> / <?php echo $nama_check2;?>'> 
					 <input type='hidden' name='check_1'class='form-control' readonly value='<?php echo $check_1;?>'> 
					 <input type='hidden' name='check_2'class='form-control' readonly value='<?php echo $check_2;?>'> 
  
                      </div>
                    </div>
				<div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Approve By</label>
                      <div class="col-sm-9"> 
        
	 
					 <input type='text' class='form-control' readonly value='<?php echo $nama_approve1;?> / <?php echo $nama_approve2;?>'> 
					 <input name='approve_1' type='hidden' class='form-control' readonly value='<?php echo $approve_1;?>'>  
					 <input name='approve_2' type='hidden' class='form-control' readonly value='<?php echo $approve_2;?>'> 
  
                      </div>
                    </div>
				
				<input type='hidden' name='hrga_staff1' value='<?php echo $hrga_staff1;?>'>
				<input type='hidden' name='hrga_staff2' value='<?php echo $hrga_staff2;?>'>
				<input type='hidden' name='hrga_spv' value='<?php echo $hrga_spv;?>'>
				<input type='hidden' name='hrga_mng' value='<?php echo $hrga_mng;?>'>
		 
					
 			<div class="form-group row">
			 <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tanggal</label><br>
			 <label for="exampleInputMobile" class="col-sm-3 col-form-label">Awal<br><br>Akhir</label>
			  <div class="col-sm-5">
				<input type="date" name='tgl_awal' value=''   class="form-control" id="exampleInputUsername2" >
				<input type="date" name='tgl_akhir' value=''   class="form-control" id="exampleInputUsername2" >
			  </div>
			</div>	
                 
                </div>
              </div>
            </div>
 <!-- satu colom form -->
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				
			  	 <div class="form-group row">
				  <label>&nbsp;&nbsp;&nbsp;Surat&nbsp;HPL/Doc Pendukung Lainnya</label>
				  <div class="col-sm-7"> 
					<input type="file" name="file" id="fileToUpload"> </div>
				</div>
				     <div class="form-group row">
                    <p class="card-description">
                    Dengan ini mohon untuk tidak masuk kerja karena:
                  </p> 
 
                    </div>
					 <div class="form-group">
                      <label for="exampleTextarea1">Alasan / Keperluan</label></center>
					  <input type='text' value='Melahirkan' name='alasan'  class="form-control" id="exampleInputUsername2" readonly>
 
                    </div>
                    <input type="submit"  name='upload' class="btn btn-primary mr-2" value='Submit'> 
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

