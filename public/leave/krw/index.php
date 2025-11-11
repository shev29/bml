<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Leave System Karawang</title>
  </head>
  <body>
    <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <div class="form-03-main"> 
			  
                <div class="form-group nm_lk"><p> <img src="assets/images/plogo.png" ></p></div>
          <!--      <div class="logo">			
                  <img src="assets/images/user.png" width='100' height='50'>
                </div>-->
				
                <div class="form-group">
		<form method='post' action='cek_login.php' ><center>
				<font size='5' color='#FFF' style="background-color:#C24641; border-radius: 20px;">
				<h3 style="background-color:#FF0000; border-radius: 20px;">&nbsp;&nbsp;Leave System Karawang&nbsp;
				<br>&nbsp;Login</h4></font>
				 
                  <input type="text" name="username" class="form-control _ge_de_ol"   placeholder="Enter Username" required="" aria-required="true">
                </div>

                <div class="form-group">
                  <input type="password" name="password" class="form-control _ge_de_ol"   placeholder="Enter Password" required="" aria-required="true">
                </div>

              <!--  <div class="checkbox form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="">
                    <label class="form-check-label" for="">
                      Remember me
                    </label>
                  </div>
                  <a href="#">Forgot Password</a>
                </div> -->

                <div class="form-group">
                  <div class="_btn_04">
				  <input type='submit' value='&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;'>
                   
                  </div>
                </div>
<?php  
error_reporting(0);
$pesan = $_GET['Pesan'];
echo "<font color='red'> $pesan</font>";
?>
</form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>