<?php 
include "../assets/configure/sesionkurir.php"; 
$nama_kurir = $_SESSION['nama'];
$nikkur = $_SESSION['nik'];
//echo $nikul;
?>
<!DOCTYPE html>
<html lang="en">
<?php include"../assets/vendor/menu_kurir/head.php"; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="gambar/user.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
<?php include "../assets/vendor/menu_kurir/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
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
          <a href="#" class="d-block"><?php echo $nama_kurir; ?></a>
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
            <h1>Today Order <?php date_default_timezone_set("Asia/Bangkok");  $nowdate_forexpire = date('Y-m-d'); echo $nowdate_forexpire ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <script>

    function setZoom100() {
        document.body.style.zoom = '100%';
    };

    function setZoom60() {
        document.body.style.zoom = '60%';
    };

    function setZoom70() {
        document.body.style.zoom = '70%';
    };

    function setZoom80() {
        document.body.style.zoom = '80%';
    };

    function setZoom90() {
        document.body.style.zoom = '90%';
    };
    function setZoomout() {
        document.body.style.zoom = '150%';
    };

  </script>
   
 
              <li class="breadcrumb-item active" >Zoom
			  <input type="button" value="150 %" onclick="setZoomout()"> 			  
			  <input type="button" value="100%" onclick="setZoom100()">
			  <input type="button" value="90 %" onclick="setZoom90()">
			  <input type="button" value="80%" onclick="setZoom80()">
			  <input type="button" value="70%" onclick="setZoom70()">
			  <input type="button" value="60%" onclick="setZoom60()">
			  
			  </li>
            </ol>
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
			  
				 <!-- <form method='post' action='post_order.php'>  
				  <input type='submit' class="btn btn-primary" name='submit' value='Submit'> -->
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Resi</th>
                    <th>Type - Req. Date</th>					
                    <th>Nama&nbsp;Courier</th>					
                    <th>Item</th>
                    <th>From</th>
                     <th>PIC</th> 
                    <th>To</th> 
                    <th>PIC</th> 
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, idalamat_asal,idalamat_tujuan, 
				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as nama_pasal,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as nama_ptujuan,
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat
		LEFT JOIN user ON tr_pengiriman.nik_kurir = user.nik
		WHERE    datetime_proses like'%$nowdate_forexpire%'  
		ORDER BY nik_kurir DESC";
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
			$datetime_proses = $row['datetime_proses'];
		 
			if(!empty($status=="Waiting Courier")){
				$tag="<span class='badge badge-secondary'>$status</span>";				
			}
			if(!empty($status=="Requested")){
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
 
				echo "<tr><form method='post' action='single_post.php'>
				
                    <td> <input type='hidden' name='resi' value='$no_order'>$no_order</td>
                    <td>$type_order &nbsp;<label class='badge badge-warning'>$datetime_proses</label> <br><span class='badge badge-danger'>$ket1</span></td>					
                    <td>";  
                     
                if (!empty($nik_kur)){
					$button ="";
					echo"<button type='button' class='btn btn-block btn-warning btn-sm'>$nama_kurir</button>$tag";
				}  
				else{
					
					$button = "Z-Kurir Belum dipilih";
				   

 
		 }
                    //`no_order`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nama_barang`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif`
	    
 
  
		 
				echo" $button ";
 
  
		 
				echo"     </td>					
                    <td>$nama_barang</td>
                    <td><span class='badge badge-warning'>$nama_pasal</span> - $alamat_asal</td>
                    <td>($pengirim) </td>
                    <td><span class='badge badge-warning'>$nama_ptujuan</span> - $alamat_tujuan </td>
                    <td>($penerima ) </td>               
                  </tr>";
  
}   
}
?>                  
                <!-- </form> -->
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
 <?php include "vendor/menu/footer.php";?>

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
		"order": [[2, 'desc']],
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
