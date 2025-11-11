<?php 
include "../assets/sesion/sesionuser.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
?>
<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
<?php include"../assets/vendor/menu_user/head.php"; ?>

<div class="wrapper">
 
  <!-- Navbar -->
<?php include "../assets/vendor/menu_user/navbar.php";?>
  <!-- /.navbar -->
 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
	<?php include "../assets/vendor/menu_user/logo.php";?>
 
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
<?php include "../assets/vendor/menu_user/sidebar.php"; ?>
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
            <h1>Multiple Report</h1>
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

    function setZoom80() {
        document.body.style.zoom = '80%';
    };

    function setZoom90() {
        document.body.style.zoom = '90%';
    };
    

    function setZoom100() {
        document.body.style.zoom = '100%';
    };
    function setZoomout() {
        document.body.style.zoom = '150%';
    };

  </script>
   
 
              <li class="breadcrumb-item active" >Zoom
			  <input type="button" value="150 %" onclick="setZoomout150()"> 			  
			  <input type="button" value="100%" onclick="setZoom100()">
			  <input type="button" value="90 %" onclick="setZoom90()">
			  <input type="button" value="80%" onclick="setZoom80()">
			  <input type="button" value="70%" onclick="setZoom70()">
			  
			  </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Content Wrapper. Contains page content -->
 
            <form method='Post' action="#">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Result Type:</label>
                                    <select class="select2" name='type_order' data-placeholder="Any" style="width: 100%;">
                                        
                                        <option value=''>All</option>
                                        <option value='Send'>Send</option>
                                        <option value='Pickup'>Pickup</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Date From</label>
                                   
                 <input type="date" name="date1" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>To:</label> 
                                    
                            <input type="date" name="date2" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <input  class="btn btn-primary" type="submit" value="Tampilkan">
                        </div>
                    </div>
                </div>
            </form> 
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
                    <th>Item</th>
                    <th>Date</t>
                    <th>From</th>
                    <th>Address</th>
                    <th>Kota&nbsp;Asal</th>
                     <th>PIC</th>
                    <th>Dest.&nbsp;Company</th>
                    <th>Address&nbsp;Company</th>
                    <th>Kota&nbsp;Tujuan</th> 
                     <th>PIC</th>
                    <th>Ref&nbsp;No</th> 
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$search_type = $_POST['type_order'];
if (empty($search_type)) {
  $s1="WHERE 1";
}
else
$s1="WHERE type_order='$search_type'";
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if (empty($date1)) {
  $date = "";

}
else
$date = "AND (datetime_proses BETWEEN '$date1 00:00:00' AND '$date2 23:59:59')";


$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, nama_perusahaan,
                idalamat_tujuan,idalamat_asal,
                	(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as nama_pasal,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as nama_ptujuan, 
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat 
		INNER JOIN user ON tr_pengiriman.nik_kurir = user.nik 
		$s1
		$date
		ORDER BY no_order DESC
    LIMIT 500";
$result = $conn->query($sql);
//var_dump($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $no =0;
  while($row = $result->fetch_assoc()) {
			$no ++;
			$no_order = $row['no_order'];
			$nama_lengkap = $row['nama_lengkap'];
			$nik_kurir = $row['nik_kurir'];
			$datetime_proses = $row['datetime_proses'];
			$pengirim = $row['pengirim'];
			$penerima = $row['penerima']; 
			$type_order = $row['type_order']; 
			$alamat_asal = $row['alamat_asal'];
			$alamat_tujuan = $row['alamat_tujuan'];
			$nama_barang = $row['nama_barang'];
		    $idalamat_asal = $row['idalamat_asal'];
			$idalamat_tujuan = $row['idalamat_tujuan'];
			$job_refnumber = $row['job_refnumber'];
			$nama_perusahaan = $row['nama_perusahaan'];
			$status = $row['status'];
			$nama_ptujuan = $row['nama_ptujuan'];
			$nama_pasal = $row['nama_pasal'];
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
 
				echo "<tr>
                    <td><input type='hidden' name='resi[]' value='$no_order'>$no_order</td>
                    <td>$type_order</td>					
                    <td>$nama_lengkap </td>
				  <td>$nama_barang</td>
				  <td>$datetime_proses</td>
                    <td><span class='badge badge-warning'> $nama_pasal</span> </td>
                    <td> $alamat_asal </td>";
                    
        $sqlb = "SELECT`nama_kota`,nama_provinsi
        FROM `courierm_alamat` 
        LEFT JOIN courierm_kota ON courierm_alamat.kota = courierm_kota.id_kota 
        LEFT JOIN courierm_provinsi ON courierm_alamat.provinsi = courierm_provinsi.id_prov
        WHERE id_alamat='$idalamat_asal'
		ORDER BY id_alamat ASC";
$resultb = $conn->query($sqlb);
//var_dump($sqlb);

  // output data of each row
  
  while($rowb = $resultb->fetch_assoc()) {
      $kotas = $rowb['nama_kota'];
  echo "<td>$kotas </td>";
  }
                    echo "<td>$pengirim</td>
                    <td><span class='badge badge-warning'>$nama_ptujuan</span></td>
                    <td>$alamat_tujuan</td>";
                        $sqlb = "SELECT`nama_kota`,nama_provinsi
        FROM `courierm_alamat` 
        LEFT JOIN courierm_kota ON courierm_alamat.kota = courierm_kota.id_kota 
        LEFT JOIN courierm_provinsi ON courierm_alamat.provinsi = courierm_provinsi.id_prov
        WHERE id_alamat='$idalamat_tujuan'
		ORDER BY id_alamat ASC";
$resultb = $conn->query($sqlb);
//var_dump($sqlb);

  // output data of each row
  
  while($rowb = $resultb->fetch_assoc()) {
      $kotat = $rowb['nama_kota'];
      $provt = $rowb['nama_provinsi'];

  }
  echo "<td>$kotat - $provt</td>";
                     echo"<td>$penerima</td> 
                    <td>$job_refnumber</td> 
                    <td> $tag <span class='badge badge-danger'>$ket2</span></td>
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
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
 
 
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
