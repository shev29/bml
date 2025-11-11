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
            <h1>Additional Order</h1>
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
                    <th>Type/Request&nbsp;Date</th>					
                    <th>Nama&nbsp;Courier</th>					
                    <th>Item</th><th>Date&nbsp;Process</th> 
                    <th>From</th>
                     <th>PIC</th> 
                    <th>To</th> 
                    <th>PIC</th> 
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "vendor/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`,datetime_proses, 
                DATE(tgl_log) as mydate, TIME(tgl_log) as mytime,
                (courierm_alamat.dtl_alamat) as alamat_asal, idalamat_asal,idalamat_tujuan,
	 			(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as nama_pasal,
				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as nama_ptujuan,
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif`,
	 			(select no_hp_kurir	 from courierdtl_kurir where courierdtl_kurir.nik=nik_kurir)as nomor_kurir
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat
		LEFT JOIN user ON tr_pengiriman.nik_kurir = user.nik
		WHERE tgl_log  BETWEEN '$nowdate_forexpire 10:00:00' AND '$nowdate_forexpire 23:59:59' 
		ORDER BY no_order DESC";
$result = $conn->query($sql);
  //var_dump($sql); 
if ($result->num_rows > 0) {
  // output data of each row
  $no =0;
  while($row = $result->fetch_assoc()) {
			$no ++;
			$datetime_proses = $row['datetime_proses'];
			$no_order = $row['no_order'];
			$pengirim = $row['pengirim'];
			$penerima = $row['penerima']; 
			$nik_kur = $row['nik_kurir']; 
			$nomor_kurir = $row['nomor_kurir'];
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
			 $mydate = $row['mydate'];
		  $mytime = $row['mytime'];
		  
		  	if(!empty($type_order=="Send")){
				$dari= $pengirim;				
			}
			elseif(!empty($type_order=="Pickup")){
				$dari= $penerima;				
			}

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
 
				echo "<tr><form method='post' action='add_orderpost.php'>
				
                    <td> <input type='hidden' name='resi' value='$no_order'>$no_order</td>
                    <td><span class='badge badge-warning'>$type_order</span><a href='https://api.whatsapp.com/send?text=Hallo Pak $nama_kurir, ada permintaan $type_order dari $dari barang $nama_barang diambil Pada :$datetime_proses di $nama_pasal alamat: $alamat_asal ke: $nama_ptujuan alamat: $alamat_tujuan&phone=%2B$nomor_kurir' target='_blank'><img src='gambar/wa2.png'  width='40' height='40'></a><br>($mydate-$mytime)</td>					
                    <td>";  
                     
                if (!empty($nik_kur)){
					$button ="";
					echo"<button type='button' class='btn btn-block btn-warning btn-sm'>$nama_kurir</button>$tag";
				}  
				else{
					
					$button = "<input type='submit' class='btn btn-block bg-gradient-primary btn-sm' value='Post Kurir'>";
				    echo"<select name='nik_kurir' class='form-control-md-6'>";
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
		 }
                    //`no_order`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nama_barang`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif`
	    
 
  
		 
				echo"</select>$button</form>"; 
 
				echo"     </td>					
                    <td>$nama_barang</td>
                    <td>$datetime_proses</td>
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
