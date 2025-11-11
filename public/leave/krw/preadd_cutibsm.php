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
 
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 <div class="row">
 <!-- form -->	 <h4>FORM PENGAJUAN CUTI BERSAMA</h4><br> 
 <a href='#'><button type="button" class="btn btn-inverse-info btn-fw">Multiple</button></a><br><br>
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <form class="forms-sample" method='post' action='post_cbersama.php'> 
                    <div class="form-group row">
                      <label>&nbsp;&nbsp;&nbsp;Tanggal&nbsp;Pengajuan</label>
                      <div class="col-sm-7">
                        <input type="text" name='tgl_pengajuan' value='<?php  echo date("d-m-Y");?>' Readonly class="form-control" id="exampleInputUsername2" >
                      </div>
                    </div>
					                    <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9"> 
					  <div class="form-group" data-select2-id="7"> 
                    <select name="niks" class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <?php
					  include "assets/configure/koneksi.php"; 
					 $sql = "SELECT `id_user`, `nama_lengkap`, 
					 `nik`  FROM `user` ";
					 //var_dump($sql);
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_u  = $row["id_user"];
						  $nama_lengkap = $row["nama_lengkap"];
						  $nik_row = $row["nik"];
						  $hire_date = $row["hire_date"];
						  echo "<option value='$nik_row'>$nama_lengkap </option>";
                     
					  }
					}  					 
					 ?> 
                    </select>
					</div>
                     	 

                       </div>
                    </div>                    
				  <hr> 
				<div class="form-group row">
					 
					 <label>Cuti&nbsp;Bersama&nbsp;Tahun</label>
                     	 <select name="tahun_cbersama"> 
						 <?php
							$now=date('Y');
							$add_oneyear = date('Y', strtotime('+1 year'));
							$min_oneyear = date('Y', strtotime('-1 year'));
						
							for ($a=$min_oneyear;$a<=$add_oneyear;$a++)
							{
								 echo "<option value='$a'>$a</option>";
							}
							?>	
							  </select> 
										  
                    
                    </div> 
 
					
				 <div class="form-group row">

                  <div class="form-group">
				    <p class="card-description">
                   Detail Tanggal
                  </p> 
 
		<div class="container">
		 
			<input type="text" name='detail_tanggal' size='100' value='' class="form-control date" placeholder="Pick single or multiple dates">
			 
		</div><br>
				<label for="exampleTextarea1">Total</label>  
				<input type='text' name='total_hari' size='5' value='' id='total'>  
				<label for="exampleTextarea1">Hari</label>
 
				<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
				<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
				<script  src="dist/script.js"></script>
<br><br>
		<div class="input-group">
			&nbsp;&nbsp;&nbsp;<input type='reset' value='Reset' class="btn btn-light"> 					
			<button type="submit" class="btn btn-primary mr-2">Submit</button>
							
		</div>
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
                    Cuti hari raya atau cuti bersama
                  </p> 
 
                    </div>
					 <div class="form-group">
                      <label for="exampleTextarea1">Alasan / Keperluan</label></center>
                      <input type text='alasan'  class="form-control" id="exampleTextarea1" 
					  name='alasan'rows="4" value='Cuti bersama tahun:' >
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

