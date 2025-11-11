<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Courier Online System</title> 
<meta name="title" content="Onboarding Screens">
<meta name="description" content="">

<meta property="og:type" content="website">
<meta property="og:url" content="https://codepen.io/jebbles/pen/MKoYya">
<meta property="og:title" content="Onboarding Screens">
<meta property="og:description" content="">
<meta property="og:image" content="https://assets.codepen.io/167555/onboarding-walkthrough-screens.PNG">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://codepen.io/jebbles/pen/MKoYya">
<meta property="twitter:title" content="Onboarding Screens">
<meta property="twitter:description" content="">
<meta property="twitter:image" content="https://assets.codepen.io/167555/onboarding-walkthrough-screens.PNG"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:700,300'>
<link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body> <a href='home.php'><img src='gambar/main.png' width='70'height='70'> </a><br>
 
<!-- partial:index.partial.html -->
<!-- / A set of walkthrough screens in HTML/CSS/JS. A personal experiment with layering images, CSS3 transitions, & flexbox. -->
<button class='open-walkthrough'>Start</button>
<div class='walkthrough show reveal'>
  <div class='walkthrough-pagination'>
<?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");

$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, nama_perusahaan,
				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat 
		INNER JOIN user ON tr_pengiriman.nik_kurir = user.nik 
		WHERE nik_kurir='112000016'
		ORDER BY no_order DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $no =0;
  while($row = $result->fetch_assoc()) {
			$no ++;
			$no_order = $row['no_order'];
			$nama_lengkap = $row['nama_lengkap'];
			$nik_kurir = $row['nik_kurir'];
			$pengirim = $row['pengirim'];
			$penerima = $row['penerima']; 
			$type_order = $row['type_order'];
			$alamat_asal = $row['alamat_asal'];
			$alamat_tujuan = $row['alamat_tujuan'];
			$nama_barang = $row['nama_barang'];
			//$idalamat_asal = $row['idalamat_asal'];
			//$idalamat_tujuan = $row['idalamat_tujuan'];
			$job_refnumber = $row['job_refnumber'];
			$nama_perusahaan = $row['nama_perusahaan'];
			$status = $row['status'];
			$ket1 = $row['ket1'];
			$ket2 = $row['ket2'];
			if(!empty($status=="Waiting Courier")){
				$tag="<span class='badge badge-secondary'>$status</span>";				
			}
			elseif(!empty($status=="On Delivery")){
				
				$tag="<span class='badge badge-warning'>$status</span>";
			}
			elseif(!empty($status=="Pending")){
				
				$tag="<span class='badge badge-info'>$status</span>";
			}
			elseif(!empty($status=="Delivered")){
				
				$tag="<span class='badge badge-success'>$status</span>";
			}
			elseif(!empty($status=="Cancel")){
				
				$tag="<span class='badge badge-danger'>$status</span>";
			}
			elseif(!empty($status=="Return")){
				
				$tag="<span class='badge badge-danger'>$status</span>";
			}
						
			elseif(!empty($status=="Transfer")){
				
				$tag="<span class='badge badge-primary'>$status</span>";
			}
 
				echo "    <a class='dot'></a> ";
  }
}  
?>   
  
 
  </div>
  <div class='walkthrough-body'>
    
	
	<ul class='screens animate'>
      <li class='screen active'>
        <div class='media logo'>
		<a href="testp.php"><img src='gambar/add.png' height='40' width='40'></a>
          <img class='logo' src='gambar/juki.png'>
		  
	
        </div>
        <h3>Tarjuki 
        </h3>
		<p>

		PT Testi Nusantara <br>
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		PT Osaka Airport,<br>  
		veniam, quis nostrud exercitation ullamco laboris.</p>
	  </li>
	  
      <li class='screen'>
        <div class='media books'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/book_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/book_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/book_icon_3.png'>
        </div>
        <h3>
          Data and File
          <br>Management</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
	  <a href="#"></a>
      <li class='screen'>
        <div class='media bars'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/bar_icon_axis.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/bar_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/bar_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/bar_icon_1.png'>
        </div>
        <h3>
          Analytics
          <br>and Metrics</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media files'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png'>
        </div>
        <h3>
          Reporting
          <br>and Insights</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media files'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png'>
        </div>
        <h3>
          Reporting
          <br>and Insights</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media files'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png'>
        </div>
        <h3>
          Reporting
          <br>and Insights</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media files'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png'>
        </div>
        <h3>
          Reporting
          <br>and Insights</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media files'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png'>
        </div>
        <h3>
          Reporting
          <br>and Insights</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
      </li>
      <li class='screen'>
        <div class='media comm'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/comm_icon_1.png'>
          <img class='icon' src='https://s3.amazonaws.com/jebbles-codepen/comm_icon_2.png'>
        </div>
        <h3>
          Communications
          <br>Tools</br>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
		Ut enim ad minim veniam, quis nostrud  

		</p>

	  </li>
    </ul>
    <button class='prev-screen'>
      <i class='icon-angle-left'></i>
    </button>
    <button class='next-screen'>
      <i class='icon-angle-right'></i>
    </button>
  </div>
  <div class='walkthrough-footer'>
    <button class='button next-screen'>Next</button>
    <button class='button finish close' disabled='true'>Finish</button>
  </div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script><script  src="./script.js"></script>

</body>
</html>
