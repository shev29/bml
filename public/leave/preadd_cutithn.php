<?php 
error_reporting(0);
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

 <?php  include "assets/template/rowwelcome.php";?>


 
 <!-- form -->
           <div class="row">
		   <center><h4>FORM PENGAJUAN CUTI TAHUNAN </h4><br></center>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method='post' action='post_ctahunan.php'>
				  <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Cuti Tahun </label>
                      <div class="col-sm-9">
					  	  <?php
						//echo $nikso;
						include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$result6 = mysqli_query($conn, "SELECT `id_ctahunan`, `kode_jcuti`, `nik`, `tahun`,
																`jumlah`, `lahir_cuti`, `tag`, `ket` 
														FROM 	cuti_lahir 
														WHERE 	kode_jcuti='CTRPL' AND tag='1' 
																AND nik=$nikso order by id_ctahunan 
														ASC 	Limit 0,1
														");
					// var_dump($nikso);
						// tampilkan query
							$row6=mysqli_fetch_row($result6);
							$id_cutirplcmn=$row6[0];
							$kode_jcuti=$row6[1];
							$nik=$row6[2];
							$tahun=$row6[3];
							$jumlah=$row6[4];
							$lahir_cuti=$row6[5];
							$tag=$row6[6];
							
							if(!empty($row6)){
								echo "
							<input type='hidden'   class='form-control'  name='id_cutirplcmn' value='$i'>
							<input type='hidden'   class='form-control'  name='kode_jcuti' value='CTRPL'>
							<input type='text' readonly class='form-control'  name='cuti_tahun' value='$tahun'>
							<br><p style='background-color: #FFB6C1;'>*Cuti ini adalah cuti Replacement yang diambil otomatis 
							karena berlaku prioritas</p>
							";

							}
							else{
								  
					  ?>
				<input type='hidden'   class='form-control'  name='kode_jcuti' value='CT12'>
				<select name='cuti_tahun' class="js-example-basic-multiple w-100"> 
				<?php
					date_default_timezone_set("Asia/Bangkok");
					$nowdate_forexpire = date('Y-m-d');
					
					include "assets/configure/koneksi.php";  
					 $sql = "SELECT `id_ctahunan`,cuti_lahir.kode_jcuti, `nik`,nama_cuti, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`
						FROM cuti_lahir LEFT JOIN jenis_cuti ON cuti_lahir.kode_jcuti=jenis_cuti.kode_jcuti 
						where nik='$nikso'  AND exp_cuti >= '$nowdate_forexpire'	
						Order by jenis_cuti.kode_jcuti ASC limit 0,3";
 					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_ctahunan = $row["id_ctahunan"];
						  $tahun = $row["tahun"];
						  $jumlah = $row["jumlah"];
						  $nama_cuti = $row["nama_cuti"];
						  $kode_jcuti = $row["kode_jcuti"];
			 
 
					  echo "
					  <option value='$tahun'>$tahun</option>";
					  }
					} else {
					  echo "0 results";
					}
				 }
					?>
				</select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label> &nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-7">
                        <input type="text" name='tgl_pengajuan' value='<?php  echo date("d-m-Y");?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
				  <hr>

                    <div class="form-group row">
					 <?php 
					 $sql3 = "SELECT `id_user`, `nama_lengkap`, 
					 `nik`, `hire_date`, `email`, `email2`, 
					 `username`, `password`, `kode_loc`, 
					 `kode_dep`, `level`,  
					 `token`, `exp_token` FROM `user` where username='$username'";
					$result3 = $conn->query($sql3);
					//var_dump($sql3);
					if ($result3->num_rows > 0) {
					  // output data of each row
					  while($row3 = $result3->fetch_assoc()) {
						  $id_u  = $row3["id_user"];
						  $nama_lengkap = $row3["nama_lengkap"];
						  $nik = $row3["nik"];
						  $hire_date = $row3["hire_date"];
						 
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
					 $sql = "SELECT id_dep, kode_dep, nama_dep, ket
							 FROM department		where kode_dep='$kode_depo'				 
							 ORDER BY id_dep limit 0,1";
					$result = $conn->query($sql);
//var_dump($sql);
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
	  
					 $sql = "SELECT  `id_loc`, `kode_loc`, `nama_loc`, `alias`, `alamat`, `ket` 
							 FROM `location` 
							 WHERE alias='$kode_loca'";
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
				<label for="exampleInputMobile" class="col-sm-3 col-form-label">Tanggal Join PT. BML </label>
				<div class="col-sm-5">
				<input type="text" name='hire_date' value='<?php  echo $hire_date;?>' Readonly class="form-control" id="exampleInputUsername2" >
				</div> 
				</div>
 
<?php
$sql_appz = "SELECT `xid_app`, user.nik, (nama_lengkap)as nama_pemohon, `check_1`,tl_checker, (select nama_lengkap from user where nik=tl_checker) as nama_tlchecker, 
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

                     
				 
				<div class="form-group">
				<p class="card-description">
				Cuti Tanggal
				</p> 

				<div class="container">

				<input type="text" name='detail_tanggal' value='' class="form-control date" placeholder="Pick single or multiple dates">

				</div><br>
				<label for="exampleTextarea1">Total</label>  <input type='text' name='total_hari' size='5' Readonly value='' id='total'>  <label for="exampleTextarea1">Hari</label>

				<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
				<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
				<script  src="dist/script.js"></script>

				<div class="input-group">  
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
                    <p class="card-description">
                    Dengan ini mohon untuk tidak masuk kerja karena:
                  </p> 
 
                    </div>

					<!-- <div class="form-check">

						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" name="alasan1" id="optionsRadios2" value="Family Matter" >
							Family Matter
						</label>
						</div>
						<div class="form-check">
						<label class="form-check-label">
						<input type="checkbox" class="form-check-input" name="alasan2" id="optionsRadios2" value="Personal Matter" >
							Personal Matter
						</label>
						</div>
					<div class="form-check">
						<label class="form-check-label">
						<input type="checkbox" id="html" class="form-check-input" id="optionsRadios3" name="alasan3" value="Mudik Pulang Kampung">
							Mudik / Pulang Kampung
						</label>

						</div>
					<div class="form-group">
                      <label for="exampleTextarea1">Other:</label>

                      <textarea class="form-control" id="exampleTextarea1" name='alasan4'rows="4" maxlength='40'> </textarea>
                    </div> -->


					 <div class="form-group">
                      <label for="exampleTextarea1">Alasan / Keperluan</label>
                      <textarea class="form-control" id="exampleTextarea1" maxlength="100" name='alasan'rows="4"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <input type='reset' value='Reset' class="btn btn-light"> 
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