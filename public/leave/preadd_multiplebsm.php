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
 <!-- form -->	 <B>FORM PENGAJUAN CUTI BERSAMA (Multiple)</B><br> 
 <a href='preadd_cutibsm.php'><button type="button" class="btn btn-inverse-info btn-fw">Single</button></a><br><br>
			
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
              
                  <form class="forms-sample" method='post' action='multiple_cbersama.php'> 
                    <table border='2'>
 
                        <input type="hidden" name='tgl_pengajuan' value='<?php  echo date("d-m-Y");?>' Readonly class="form-control" id="exampleInputUsername2" >
  
					   <div class="form-group row">
                     <label for="exampleInputMobile" class="col-sm-3 col-form-label">Location:</label>
                      <div class="col-sm-7"> 
					  <div class="form-group" data-select2-id="7"> 
                    <select name="kode_loc" class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <?php
					  include "assets/configure/koneksi.php"; 
					 $sql = "SELECT   `kode_loc` FROM `user` GROUP BY kode_loc";
					 //var_dump($sql);
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) { 
						  $kode_loc = $row["kode_loc"]; 
						  echo "<option value='$kode_loc'>$kode_loc </option>";
                     
					  }
					}  					 
					 ?> 
                    </select>
					</div>
                     	 

                       </div>            
  
				<div class="form-group row">
					 
					 <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuti&nbsp;Bersama&nbsp;Tahun:</label>
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
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal cuti bersama/Lebaran:
                  </p> 
 
		<div class="container">
		 
			<input type="text" name='detail_tanggal' size='100' value='' class="form-control date" placeholder="Pick single or multiple dates">
			 
		</div><br>
				<label for="exampleTextarea1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Estimasi Cuti Bersama:</label>  
				<input type='text' name='total_hari' size='5' value='' id='total'>  
				<label for="exampleTextarea1">Hari</label>
 
				<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
				<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
				<script  src="dist/script.js"></script>
<br><br>
		<div class="container">
 <label for="exampleTextarea1">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reason/Keterangan
                  </label> 
			&nbsp;&nbsp;&nbsp;<input type='text' value='' name='reason' class="form-control date" placeholder="Cuti bersama .... ">
		</div>					
	 
<br> 

		<div class="input-group">
			&nbsp;&nbsp;&nbsp;<input type='reset' value='Reset' class="btn btn-light"> 					
			<button type="submit" class="btn btn-primary mr-2">Submit</button>
							
		</div>
                  </div>
			</div>	
                </div>
              </div>
            </div>
 
 
 
                    
                 </table>
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

