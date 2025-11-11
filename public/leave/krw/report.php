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
           <div class="row">
 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-primary">Monthly Report</button> 
                  <div class="form-group">
                        <form class="forms-sample" method='post' enctype="multipart/form-data"  action='report_monthly.php'> 
  

                     <label for="exampleInputMobile" class="col-sm-15 col-form-label">Choose&nbsp;Month and Year:</label> 
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $nowyear = date('Y');
            $lastyear = $nowyear-1;
            $lastcoupleyear = $lastyear-1;
            
            ?>  
               <select name='bulan' class="js-example-basic-multiple w-100">
					<option value='01'>Jan</option> 
					<option value='02'>Feb</option> 
					<option value='03'>Mar</option> 
					<option value='04'>Apr</option> 
					<option value='05'>May</option> 
					<option value='06'>Jun</option>  
					<option value='07'>Jul</option> 
					<option value='08'>Aug</option> 
					<option value='09'>Sep</option> 
					<option value='10'>Oct</option> 
					<option value='11'>Nov</option> 
					<option value='12'>Dec</option> 
				</select>
                  </div>
                  <div class="form-group">
                    <select name='tahun' class="js-example-basic-multiple w-100">
					<option value='<?php echo $nowyear;?>'><?php echo $nowyear;?></option>
                    <option value='<?php echo $lastyear;?>'><?php echo $lastyear;?></option>
                    <option value='<?php echo $lastcoupleyear;?>'><?php echo $lastcoupleyear;?></option>
				</select>
                  </div>
                  
			 <input type="submit" name='upload' class="btn btn-success" Value='Export Excel'>  
 
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-primary">Yearly Report</button> 
                  <div class="form-group">
                        <form class="forms-sample" method='post' enctype="multipart/form-data"  action='report_yearly.php'> 
  

                     <label for="exampleInputMobile" class="col-sm-15 col-form-label">Choose Year:</label> 
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $nowyear = date('Y');
            $lastyear = $nowyear-1;
            $lastcoupleyear = $lastyear-1;
            
            ?>  
                <select name='tahun' class="js-example-basic-multiple w-100">
					<option value='<?php echo $nowyear;?>'><?php echo $nowyear;?></option>
                    <option value='<?php echo $lastyear;?>'><?php echo $lastyear;?></option>
                    <option value='<?php echo $lastcoupleyear;?>'><?php echo $lastcoupleyear;?></option>
				</select>
                  </div>
 
                  
			 <input type="submit" name='upload' class="btn btn-success" Value='Export Excel'>  
 
                  </form>
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

