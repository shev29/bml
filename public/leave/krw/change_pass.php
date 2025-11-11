<!DOCTYPE html>
<html lang="en">

<head>

<?php include "assets/template/headform.php";  
error_reporting(0);
include "assets/configure/sesionadmin.php"; 
include "assets/configure/koneksi.php"; 
?>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php// include "assets/template/rowwelcome.php"; ?>

 <?php   include "assets/configure/koneksi.php"; ?>
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<form action='new_pass.php' method='post'>
                  <h4 class="card-title">Ganti Password</h4>
					<div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-9 col-form-label">Masukan Password Lama</label>
                      <div class="col-sm-9">
                        <input type="hidden" name='id_user' value='<?php echo $username;?>'>
                        <input type="password" name='old_pass' value='' class="form-control" id="exampleInputUsername2" placeholder="Password Lama">
						<input type='submit' class="btn btn-inverse-success btn-fw" value='Proses'>
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

