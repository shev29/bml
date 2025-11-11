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

 
 <!-- form -->	<center><h4>CUTI REPLACEMENT DARI CUTI MELAHIRKAN</h4><br></center>
           <div class="row"> 
			<?php 		$id=$_GET['id']; 
						error_reporting(0);
						$result6 = mysqli_query($conn, "SELECT  id_trcuti, tr_cuti.nik, kode_jcuti, 
						tgl_pengajuan, tgl_awalc, tgl_akhir, detail_tanggal,
						total_hari, doc_pendukung, cuti_tahun, nama_lengkap,alasan 
						
						FROM tr_cuti 
						INNER JOIN user ON tr_cuti.nik = user.nik  
						where id_trcuti=$id");
 
						// tampilkan query
							$row6=mysqli_fetch_row($result6);
							$id_trcuti=$row6[0];
							$nik=$row6[1];
							$kode_jcuti=$row6[2];
							$tpengajuan=$row6[3];
							$tgl_awalc=$row6[4];
						   
							$new_tpengajuan = date("d-m-Y", strtotime($tpengajuan)); 
							$newtgl_awal = date("d-m-Y", strtotime($tgl_awalc)); 
							$tgl_akhir=$row6[5];
							
							$detail_tanggal=$row6[6];
							$total_hari=$row6[7];
							$doc_pendukung=$row6[8];
							$cuti_tahun=$row6[8];
							$alasan=$row6[9]; 
							$namas_lengkap=$row6[10]; 
							 if(!empty($row6)){ 
			?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <form class="forms-sample" enctype="multipart/form-data"  method='post' action='post_crepl.php'> 
					<input type='hidden' name='id_trcuti' value='<?php echo $id_trcuti;?>'>
				  <hr> 
                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" name='namaewa' value='<?php echo $namas_lengkap;?>' Readonly class="form-control" id="exampleInputUsername2" >
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
  <hr> 
			    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-8">
                        <input type="text" name='tgl_lahircuti' readonly value='<?php  echo $new_tpengajuan;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                </div>	

 
			<div class="form-group row">
			 <label for="exampleInputMobile" class="col-sm-3 col-form-label">Tanggal</label><br>
			 <label for="exampleInputMobile" class="col-sm-3 col-form-label">Awal<br><br>Akhir</label>
			  <div class="col-sm-5">
			    <input type="hidden" name='tgl_akhir_sebelumnya' value='<?php echo $tgl_akhir;?>'>
				<input type="text" name='tgl_awal' value='<?php echo $newtgl_awal; ?>'  readonly class="form-control" id="exampleInputUsername2" >
				<input type="date" name='tgl_akhir' value='<?php echo $tgl_akhir;?>'   class="form-control" id="exampleInputUsername2" >
			  </div>
			</div>				
			   <div class="form-group row">
                      &nbsp;&nbsp;&nbsp;&nbsp;<label>Alokasi Ke Cuti Replacement&nbsp;</label>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name='over_cuti' size='4'   value=''  id="exampleInputUsername2" >
                       
					  <label>&nbsp;&nbsp;Hari</label><br> 
                 </div>
                 <div class="form-group row">  
					<label>&nbsp;Keterangan&nbsp;</label>				 
                      <div class="col-sm-9">					 
                        <input type="text" name='ket'  value=''  class="form-control" id="exampleInputUsername2" >
                      </div>
                </div>	 
					   
                <hr>
                 <input type="submit"  name='upload' class="btn btn-primary mr-2" value='Update'> 
                    <input type="reset"  name='upload' class="btn btn-primary mr-2" value='Reset'>  
                  </form>
                </div>
              </div>
            </div>

							 <?php }?>
 
        
		  
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

