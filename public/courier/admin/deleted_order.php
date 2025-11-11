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
            <h1>Deleted History</h1>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>No</th>
                    <th>Resi</th> 				
                    <th>Nama&nbsp;User</th>					
                    <th>Action</th>					
                    <th>Deleted by</th>
                      <th>Reason</th> 
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");

$sql = "SELECT  `id_log`, `id_item`, `action`, `user`, `reason`,  nama_lengkap, 
        (select nama_lengkap from user where nik=user) as nama_penghapus
        FROM `courier_genlog` 
        
		LEFT JOIN user ON courier_genlog.ket = user.nik 
		ORDER BY id_log DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $no =0;
  while($row = $result->fetch_assoc()) {
			$no ++;
			$id_item = $row['id_item'];
			$nama_lengkap = $row['nama_lengkap'];
			$action = $row['action'];
			$nama_penghapus = $row['nama_penghapus'];
			$reason = $row['reason']; 
 
				echo "<tr>
                    <td> $no</td>
                    <td>$id_item</td>					
                    <td>$nama_lengkap </td>
					<td>$action </td>					
                    <td>$nama_penghapus</td>
                    <td>$reason</td> 
                  </tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>                </tfoot>
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
