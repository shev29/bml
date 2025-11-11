<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>E-Courier BML</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
 <center>
<img src='img/loginlogo.png' width='150'height='150'>
  <h3>BML E-Courier</h3> 
 </center>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Click Me</div>
  </div>
  <div class="form">

    <h2>Login</h2>  			
	<form action="cek_login.php" id="login" name="login" method="post">
  				<div class="form-group has-feedback">
  					<input type="text"  name="username" class="form-control" autocomplete="off" placeholder="Username">
  					<span class="glyphicon glyphicon-user form-control-feedback"></span>
  				</div>
  				<div class="form-group has-feedback">
  					<input type="password" id="password" name="password" class="form-control" autocomplete="off" placeholder="Password" required="password">
  					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
  				</div>
  				<div class="row">
  					<div class="col-xs-12">
  						<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
  					</div><!-- /.col -->
  				</div>
  			</form>
  </div>
  <div class="form">
    <h2>Register Hubungi Admin GA</h2>
    <form>
     <!-- <input type="text" placeholder="Username"/>
      <input type="password" placeholder="Password"/>
      <input type="email" placeholder="Email Address"/>
      <input type="tel" placeholder="Phone Number"/>
      <button>Register</button> -->
    </form>
  </div>
  <div class="cta"><a href="http://andytran.me">E-Kurir sistem BML @2023</a></div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://codepen.io/andytran/pen/vLmRVp.js'></script><script  src="./script.js"></script>

</body>
</html>
