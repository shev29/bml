
 <?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level'];
	$nama = $_SESSION['nama']	
	
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php  include "assets/template/head.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
 <?php  include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" /> 

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
 

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                        <tr style='background: #35A9DB;color:#fff;font-weight:normal;'>
                          <th>Nama </th>
                          <th>NIK</th>
                          <th>Hire&nbsp;Date</th>
                          <th>Level</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Location</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
<?php   include "assets/configure/koneksi.php"; 
$sql = " SELECT  `id_user`, `nama_lengkap`, `nik`, `hire_date`, `email`, `email2`, `username`, `password`, 
		`kode_loc`, `kode_dep`, `kode_section`, `level`, `level_akses`, `atasan_nik`, `token`, `exp_token`, `status_aktif`
		FROM `user` 
		WHERE id_user>'2'
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $nama_lengkap = $row['nama_lengkap'];
	  $nik = $row['nik'];
	  $hire_date = $row['hire_date'];
	  $level = $row['level'];
	  $email = $row['email'];
	  $kode_loc = $row['kode_loc'];
	  $kode_dep = $row['kode_dep'];
	  $username = $row['username'];
	  $kode_section = $row['kode_section'];
     
  ?>
						<tr>
                          <td> <?php echo $nama_lengkap ?></td>
                          <td> <?php echo $nik ?></td>
                          <td> <?php echo $hire_date ?></td>
                          <td> <?php echo $level ?></td>
                          <td> <?php echo $username ?></td>
                          <td> <?php echo $email ?></td>

                          <td> <?php echo $kode_loc ?></td>
                          <td> <?php echo $kode_dep ?></td> 
                          <td> Edit|Delete</td>

 
                        </tr>
                         
<?php						
	}
} else {
  echo "0 results";
}
$conn->close();
?> 
                      </tbody>
                    </table>
	
<script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>
 
 
                
<?php include"assets/template/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


</body>

</html>
