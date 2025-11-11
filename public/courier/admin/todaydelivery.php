<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
?>
<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
<?php include"../assets/vendor/menu_admin/head.php"; ?>

<div class="wrapper">
 
  <!-- Navbar -->
<?php include "../assets/vendor/menu_admin/navbar.php";?>
  <!-- /.navbar -->
 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
	<?php include "../assets/vendor/menu_admin/logo.php";?>
 
     <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gambar/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

 

      <!-- Sidebar Menu -->
<?php include "../assets/vendor/menu_admin/sidebar.php"; ?>
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
            <h1>ALL Delivery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <script>

    function setZoom100() {
        document.body.style.zoom = '100%';
    };

    function setZoom70() {
        document.body.style.zoom = '70%';
    };

    function setZoom90() {
        document.body.style.zoom = '80%';
    };

    function setZoom() {
        document.body.style.zoom = '90%';
    };
    function setZoomout() {
        document.body.style.zoom = '150%';
    };

  </script>
   
 
              <li class="breadcrumb-item active" >Zoom
			  <input type="button" value="150 %" onclick="setZoomout()"> 			  
			  <input type="button" value="100%" onclick="setZoom100()">
			  <input type="button" value="90 %" onclick="setZoom()">
			  <input type="button" value="80%" onclick="setZoom80()">
			  <input type="button" value="70%" onclick="setZoom70()">
			  
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
			  
				  <form method='post' action='post_order.php'> 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Resi</th>
                    <th>Type</th>					
                    <th>Nama&nbsp;Courier</th>					
                    <th>Trf</th>					
                    <th>Item</th>
                      <th>Input&nbsp;&&nbsp;Req&nbsp;Date</th>
                    <th>From</th>
                     <th>PIC 1</th>
                    <th>To</th>
                     <th>PIC 2</th>
                    <th>Ref&nbsp;No</th> 
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");

$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, nama_perusahaan,
                idalamat_tujuan,
                	(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as nama_pasal,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as nama_ptujuan, 
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap,gambal_ambil,gambal_kirim, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat 
		INNER JOIN user ON tr_pengiriman.nik_kurir = user.nik 
		ORDER BY no_order DESC Limit 0,200";
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
			$datetime_proses = $row['datetime_proses'];
			$nama_ptujuan = $row['nama_ptujuan'];
			$nama_pasal = $row['nama_pasal'];
			$gambal_ambil = $row['gambal_ambil'];
			$gambal_kirim = $row['gambal_kirim'];
			$ket1 = $row['ket1'];
			$ket2 = $row['ket2'];
			$tgl_log = $row['tgl_log'];
			
			if(!empty($status=="Waiting Courier")){
				$tag="<span class='badge badge-secondary'>$status</span>";				
			}
			
			elseif(!empty($status=="Requested")){
				
				$tag="<span class='badge badge-warning'>$status</span>";
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
                			 if(!empty($gambal_ambil) ){
                			    
                            			    $show_imagine1="<img src='gambar/c.png' width='25' height='25'>";
                            		    	}
                                 else{
                             			    $show_imagine1="<img src='gambar/x.png' width='25' height='25'>";
                                             }
                			    if(!empty($gambal_kirim) ){
                			    
                            			    $show_imagine2="<img src='gambar/c.png' width='25' height='25'>";
                            		    	}
                                 else{
                             			    $show_imagine2="<img src='gambar/x.png' width='25' height='25'>";
                                             }
 
				echo "<tr>
                    <td><input type='hidden' name='resi[]' value='$no_order'>$no_order</td>
                    <td>$type_order	
                        <a href='../doc_pendukung/$gambal_ambil'>$show_imagine1</a> <a href='../doc_pendukung/'>$show_imagine2</a>
                    </td>					
                    <td>$nama_lengkap </td>
					<td><a href='transfer_kurir.php?notrf=$no_order'><img src='gambar/change.png' width='20' height='20'></a></td>					
                    <td>$nama_barang</td>
                    <td>$tgl_log - $datetime_proses</td>
                    <td><span class='badge badge-warning'> $nama_pasal</span> $alamat_asal</span> </td>
                    <td>$pengirim</td>
                    <td><span class='badge badge-warning'>$nama_ptujuan</span> $alamat_tujuan </td>
                    <td>$penerima</td> 
                    <td>$job_refnumber</td> 
                    <td> $tag <span class='badge badge-danger'>$ket1</span></td>
                  </tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>                  
                </form> 
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
		"order": [[0, 'desc']],
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
