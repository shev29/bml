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

 <?php  include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->	<center><h4>FORM PENGAJUAN CUTI TAHUNAN </h4><br></center>
           <div class="row"> 
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method='post' action='update_creq.php'>
                      
                <?php
						//echo $nikso;
						include "assets/configure/koneksi.php"; 
						error_reporting(0);
						$get_id = $_GET['id'];
						
						
                     $sqledit = "SELECT `id_trcuti`, tr_cuti.nik,nama_lengkap, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, 
                     `detail_tanggal`,   `total_hari`, `doc_pendukung`, `cuti_tahun`, `alasan`
                     FROM `tr_cuti` 
                     INNER JOIN user ON tr_cuti.nik=user.nik
                     WHERE id_trcuti='$get_id'";
                    $resultedit = $conn->query($sqledit);
                    //var_dump($sqledit);
                    if ($resultedit->num_rows > 0) {
                      // output data of each row
                      while($rowedit = $resultedit->fetch_assoc()) {
                        $id_trcuti = $rowedit["id_trcuti"];
                        $cuti_tahun = $rowedit["cuti_tahun"];
                        $kode_jcuti = $rowedit["kode_jcuti"];
                        $nama_lengkap = $rowedit["nama_lengkap"];
                        $tgl_pengajuan = $rowedit["tgl_pengajuan"];
                        $nikedit = $rowedit["nik"];
                        $detail_tanggal = $rowedit["detail_tanggal"];
                         $total_hari = $rowedit["total_hari"];
                          $alasan = $rowedit["alasan"];
                      }
                    }
						 	  
					  ?>
                                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label"> &nbsp;&nbsp;&nbsp;No&nbsp;Ref&nbsp;</label>
                      <div class="col-sm-7">
                        <input type="text" name='id_trcuti' value='<?php  echo  $id_trcuti;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
 
				  <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Cuti Tahun </label>
                      <div class="col-sm-9">

			 
			 
					  <input type='text' class='form-control' name='cuti_tahun'  value='<?php echo $cuti_tahun?>'>
  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label> &nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-7">
                        <input type="text" name='tgl_pengajuan' value='<?php  echo $tgl_pengajuan;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
				  <hr> 		
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
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Jenis Cuti</label>
                      <div class="col-sm-9">
                          
              <select name='kode_jcuti' class="js-example-basic-multiple w-100">                    			 
 
					<?php 
					$sqlold = "SELECT kode_jcuti, nama_cuti FROM `jenis_cuti` where kode_jcuti='$kode_jcuti'";
					$resultold = $conn->query($sqlold);
 //var_dump($sqlold);
					if ($resultold->num_rows > 0) {
					  // output data of each row
					  while($rows = $resultold->fetch_assoc()) {
						  $kode_jcutis = $rows["kode_jcuti"];
						  $nama_cutis = $rows["nama_cuti"];
						  
				  echo "<option value='$kode_jcutis'>$nama_cutis</option> ";
					    
					 
					  }
					} else {
					  echo "0 results";
					}
				  
					 $sql = "SELECT kode_jcuti, nama_cuti FROM `jenis_cuti` where kode_jcuti!='$kode_jcuti'";
					$result = $conn->query($sql);
//var_dump($sql);
					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $oldkode_jcuti = $row["kode_jcuti"];
						  $oldnama_cuti = $row["nama_cuti"];
						  
				  echo "<option value='$oldkode_jcuti'>$oldnama_cuti</option> ";
					    
					 
					  }
					} else {
					  echo "0 results";
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
 
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" name='nm_lengkap' value='<?php  echo $nama_lengkap;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">NIK</label>
                      <div class="col-sm-9">
                        <input type="text" name='niks' value='<?php  echo $nikedit;?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
				
 
                     
				 
				<div class="form-group">
				<p class="card-description">
				Cuti Tanggal
				</p> 

				<div class="container">

				<input type="text" name='detail_tanggal' value='<?php echo $detail_tanggal; ?>' class="form-control date" placeholder="Pick single or multiple dates">

				</div><br>
				<label for="exampleTextarea1">Total</label>  <input type='text' name='total_hari' size='5' value='<?php echo $total_hari; ?>' id='total'>  <label for="exampleTextarea1">Hari</label>

				<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
				<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
				<script  src="dist/script.js"></script>

				<div class="input-group"> <br>Alasan : <?php echo $alasan; ?>
				</div>
				</div>	
                     <div class="form-group row">
                       
                      <div class="col-sm-9">
                          
					    <input type="reset"  class="btn btn-inverse-info btn-fw" Value='Reset'> 
                        <input type="submit" name='upload' class="btn btn-primary mr-2" Value='Update'> 
                      </div>
                    </div>
 
                 
                </div>
              </div>
            </div>
 
 
 
 
 
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