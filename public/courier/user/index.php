<?php 
include"../assets/sesion/sesionuser.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="../assets/image/png" href="../assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100"><center><h4><img src="gambar/logos.png" alt="IMG" width='80' height='60'> BML Courier System </h4>
			<div class="wrap-login100">
			<center>
			 <span class="login100-form-title">
						Pickup
					</span>
			 <br>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="gambar/pickup.jpg" alt="IMG" width='160' height='160'  style='cursor:pointer;'>
					 
				</div>
				 <div class="container-login100-form-btn">
				 
					<a href='pickup.php?pickup=1'> 
							<button  class="login100-form-btn">Pick Up
						</button></a>
					</div>
					 <div class="text-center p-t-12">
						<span class="txt1">
							Pengambilan 
						</span>
						<a class="txt2" href="#">
							Barang 
						</a>
					</div>
			</center>
				<form class="login100-form validate-form" action='send.php?send=1' method='post'> 
					<span class="login100-form-title">
						Send
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
				<center>
 
			 <br>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="gambar/send.png" alt="IMG" width='160' height='150'  style='cursor:pointer;'>
					
				</div>
			</center>
					</div>

					 
					
					<div class="container-login100-form-btn">
					<a href='send.php?send=1'>	<button class="login100-form-btn">
							 Send
						</button></a>
					</div>
				

					<div class="text-center p-t-12">
						<span class="txt1">
							Pengiriman 
						</span>
						<a class="txt2" href="#">
							Barang 
						</a>
					</div>


				</form><center>
					 <div class="text-center p-t-136">						
					 <p>Main&nbsp;Page</p>
 <a href='home.php?home=1'><img src="gambar/main.png" alt="IMG" width='50' height='50'  style='cursor:pointer;'></a>
					</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendor/bootstrap/js/popper.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../assets/js/main.js"></script>

</body>
</html> 