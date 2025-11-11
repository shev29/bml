<?php 

include "../assets/configure/sesionkurir.php"; 
$nama_kurir = $_SESSION['nama'];
$nikkur = $_SESSION['nik'];
//echo $nikul;
?>

<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
<?php include"../assets/vendor/menu_kurir/head.php"; ?>

<div class="wrapper">
 
  <!-- Navbar -->
<?php include "../assets/vendor/menu_kurir/navbar.php";?>
  <!-- /.navbar -->
 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
	<?php include "../assets/vendor/menu_kurir/logo.php";?>
 
     <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gambar/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nama_kurir;?></a>
        </div>
      </div>

 

      <!-- Sidebar Menu -->
<?php include "../assets/vendor/menu_kurir/sidebar.php"; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar --> 
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"> 
            <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body">
			  
	<form method='post' action='kpost_kurir.php'> 
	<table><tr><td><input type='submit' name='Submit' class='btn btn-block bg-gradient-primary btn-sm' value='Update Kurir'></td></tr></table>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr> 				
                    <th>Ganti&nbsp;Courier</th>		
                    <th>From</th>
                    <th>To</th> 
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, 
	 
				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as nama_pasal,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as nama_ptujuan,
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat
		LEFT JOIN user ON tr_pengiriman.nik_kurir = user.nik
		WHERE     
		nik_kurir='' AND
		datetime_proses like'%$nowdate_forexpire%' 
		ORDER BY no_order DESC";
$result = $conn->query($sql);
 //var_dump($sql); 
if ($result->num_rows > 0) {
  // output data of each row
  $no =0;
  while($row = $result->fetch_assoc()) {
			$no ++;
			$no_order = $row['no_order'];
			$pengirim = $row['pengirim'];
			$penerima = $row['penerima']; 
			$nik_kur = $row['nik_kurir']; 
			$nama_kurir = $row['nama_lengkap']; 
			$type_order = $row['type_order'];
			$alamat_asal = $row['alamat_asal'];
			$alamat_tujuan = $row['alamat_tujuan'];
			$nama_barang = $row['nama_barang'];
			//$idalamat_asal = $row['idalamat_asal'];
			//$idalamat_tujuan = $row['idalamat_tujuan'];
			$job_refnumber = $row['job_refnumber'];
			$nama_pasal = $row['nama_pasal'];
			$nama_ptujuan = $row['nama_ptujuan'];
			$status = $row['status'];
			$ket1 = $row['ket1'];
			$ket2 = $row['ket2'];
			if(!empty($status=="Waiting Courier")){
				$tag="<span class='badge badge-secondary'>Menunggu Persetujuan</span>";				
			}
			
			if(!empty($status=="Requested")){
				$tag="<span class='badge badge-secondary'>Menunggu Persetujuan</span>";				
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
 
				echo "<tr>       <td> ";  
 
					
				
				    echo"<select name='nik_kurir[]' class='form-control-md-6'>";
				    echo "<option value=''>&nbsp;&nbsp;&nbsp;-- Belum Dipilih --&nbsp;&nbsp;&nbsp;</option>";
		include "../assets/configure/koneksi.php";
		$sql2 = "SELECT  nik, nama_lengkap FROM `user` WHERE courier_akses='kurir'";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {
		  // output data of each row
		  while($row2 = $result2->fetch_assoc()) { 
		  $nik2 = $row2['nik'];
		  $nama_lengkap2 = $row2['nama_lengkap']; 
		  ?>
				<option  class="form-control" value='<?php echo $nik2;?>'><?php echo $nama_lengkap2; ?></option>  
			<?php
			}
			}
	 
                    //`no_order`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nama_barang`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif`
	    
 
  
		 
				echo"</select> ";
 
  
		 
				echo" <input type='hidden' name='resi[]' value='$no_order'>$no_order $type_order    </td>					
 
                    <td>($pengirim) $nama_pasal - $alamat_asal</td>
                    <td>($penerima ) $nama_ptujuan - $alamat_tujuan </td> 
                     
                  </tr>";
  
}   
}

?>                  

                  <form>  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include "../assets/vendor/menu_kurir/footer.php";?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
 
<script>

  $(function () {
    $("#example1").DataTable({
		"order": [[0, 'desc']],"searching": false,
      "responsive": true, "lengthChange": true, "autoWidth": false
      
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true, 
    });
  });
</script>
</body>
</html>
