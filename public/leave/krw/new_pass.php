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
				 
<?php
  	$username = mysqli_real_escape_string($conn, $_POST['id_user']);
	$password = mysqli_real_escape_string($conn, $_POST['old_pass']);
	$passmd5 = md5($password);
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from user where username='$username' and password='$passmd5'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
	?>
	<form action='update_pass.php' name='myForm' method='post' onsubmit="return(validate());"> 
	<div class="form-group row">
	<label for="exampleInputUsername2" class="col-sm-7 col-form-label">Masukan Password Baru</label><br>
	<div class="col-sm-7">
	  <input type="hidden" name='username' value='<?php echo $username;?>'>
		<input type='password' name='password1' id='password1' class="form-control" value='' placeholder='Password'>
		<input type='password' name='password2' id='password2' class="form-control" value='' placeholder='Confirm Password'> 
		<input type='reset' class="btn btn-inverse-info btn-fw" value='Reset'> 		
		<input type='submit' class="btn btn-inverse-success btn-fw" value='Update'>
	</div>
	</div>  
	</form>

    <script type = "text/javascript">
   <!--
      // Form validation code will come here.
      function validate() {
      
         if( document.myForm.password1.value == "" ) {
            alert( "Password tidak boleh kosong!" );
            document.myForm.password1.focus() ;
            return false;
         } 
         if( document.myForm.password1.value != document.myForm.password2.value ) {
            alert( "Password dan confirm password tidak sama!" );
            document.myForm.password1.focus() ;
            return false;
         } 
         return( true );
      }
   //-->
</script>
  </div>
              </div>
            </div>
 
          </div>
 <!-- End of form -->
	
<?php	
}
else{
	echo"Password lama salah <a href='change_pass.php' ><button class='btn btn-inverse-danger btn-fw'>Coba Lagi</button></a>";
}
?>
 
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

