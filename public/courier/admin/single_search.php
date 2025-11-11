<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
?>
 
<!DOCTYPE html>
<html lang="en">
<?php include"../assets/vendor/menu_admin/head.php"; ?>
<body class="hold-transition sidebar-mini">
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
        <h2 class="text-center display-4"><img src='../img/logo2.jpg' width='60' height='40'>Search</h2>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
					<form action="#" method="post">
					<div class="input-group input-group-lg">
					<input type="search" class="form-control form-control-lg" name='cari' placeholder="Input Resi number here..." value="">
					<div class="input-group-append">
					<button type="submit" class="btn btn-lg btn-default">
					<i class="fa fa-search"></i>
					</button>
					</div>
					</div>
                    </form>
                </div>
            </div>
           <div class="row mt-3">			 
				<?php 
				error_reporting(0);  
				$cari = $_POST['cari'];
				if (!empty($cari)){
					 
include "../assets/vendor/configure/koneksi.php";
$tgl_log = date("Y-m-d"); 
$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, nama_perusahaan,
				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				`tgl_log`, `datetime_proses`,gambal_ambil,gambal_kirim, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`,nama_lengkap, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif`,gambar 
		FROM `tr_pengiriman` 
		LEFT JOIN courierdtl_kurir ON tr_pengiriman.nik_kurir = courierdtl_kurir.nik 		
		LEFT JOIN user ON tr_pengiriman.nik_kurir = user.nik 		
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat 		
		WHERE no_order='$cari'
		ORDER BY no_order DESC
		LIMIT 0,100";
		//var_dump($sql);
		//datetime_proses like '%$tgl_log%'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
			$no_order = $row['no_order'];
			$pengirim = $row['pengirim'];
			$penerima = $row['penerima']; 
			$nik_kurir = $row['nik_kurir']; 
			$nama_lengkap = $row['nama_lengkap']; 
			$gambar = $row['gambar']; 
			$tgl_log = $row['tgl_log']; 
			$type_order = $row['type_order'];
			$alamat_asal = $row['alamat_asal'];
			$alamat_tujuan = $row['alamat_tujuan'];
			$nama_barang = $row['nama_barang'];
			$gambal_ambil = $row['gambal_ambil'];
			$gambal_kirim = $row['gambal_kirim'];
			//$idalamat_asal = $row['idalamat_asal'];
			//$idalamat_tujuan = $row['idalamat_tujuan'];
			$job_refnumber = $row['job_refnumber'];
			$nama_perusahaan = $row['nama_perusahaan'];
			$datetime_proses = $row['datetime_proses'];
			$status = $row['status'];
			$ket1 = $row['ket1'];
			$ket2 = $row['ket2'];
			
			if(!empty($status=="Requested")){
				$tag1="<span class='badge badge-secondary'>$status</span>";				
			}
			if(!empty($status=="Waiting Courier")){
				$tag1="<span class='badge badge-secondary'>$status</span>";				
			}
			elseif(!empty($status=="On Delivery")){
				
				$tag1="<span class='badge badge-warning'>$status</span>";
			}
			elseif(!empty($status=="Pending")){
				
				$tag1="<span class='badge badge-info'>$status</span>";
			}
			elseif(!empty($status=="Delivered")){
				
				$tag1="<span class='badge badge-success'>$status</span>";
			}
			elseif(!empty($status=="Cancel")){
				
				$tag1="<span class='badge badge-danger'>$status</span>";
			}
			elseif(!empty($status=="Return")){
				
				$tag1="<span class='badge badge-danger'>$status</span>";
			}
			
			
			elseif(!empty($status=="Transfer")){
				
				$tag1="<span class='badge badge-primary'>$status</span>";
			}
 
			
			
/* 			
				echo "<tr>
                    <td>$no_order</td>
                    <td>$type_order</td>					
                    <td>$nama_barang <br><font size='1' style='background-color:#FFD700';  ><i>$ket1</i></font></td>
                    <td>$nama_perusahaan ($pengirim)</td>
                    <td>$alamat_tujuan ($penerima )</td> 
                    <td>$job_refnumber</td> 
                    <td> $tag <span class='badge badge-danger'>$ket2</span> </td>
                    <td>  <button type='button' class='btn btn-block btn-outline-primary btn-sm'>Detail</button>
					
					</td>
                  </tr>"; */
  }
} else {
  echo "0 results";
}
$conn->close();
					?>
					<div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col px-4">
                                    <div>
                                        <div class="float-right"><?php echo $datetime_proses; ?></div>
                                        <h3><?php echo $type_order; ?></h3>
										<div class="color-palette-set">
										<div class="bg-warning color-palette"><span><h5>From:&nbsp;<?php echo $nama_perusahaan; ?></h5></span></div>
										<div class="bg-warning disabled color-palette"><span><p class="mb-0"><?php echo $alamat_asal ?></p></span></div>
										</div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col px-4">
                                    <div>
				 <div class="color-palette-set">
                  <div class="bg-warning color-palette"><span><h5>To:&nbsp;<?php echo $alamat_tujuan; ?></h5></span></div>
                  <div class="bg-warning disabled color-palette"><span><p class="mb-0"><?php echo $alamat_tujuan ?></p></span></div>
                </div>
				<div class="float-right"><?php //echo $datetime_proses; ?></div> 
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row">
							<tr><td><div class="col-auto">
                                    <img class="img-fluid" src="../img/<?php echo $gambar; ?>" alt="Photo" style="max-height: 160px;">
                                </div></td>
								<td>
								    <div class="col px-4">
								<button type="button" class="btn btn-block btn-primary"><?php echo $nama_lengkap; ?></button>
								
                                    <div>
								</td>
							</tr>


                <table id="example1" class="table table-bordered table-striped" border='1'>
										<tr> 
											<td><b>Status</b> (No Resi <?php echo $no_order; ?>)</td> <td><div class="float-right"><b>Timestamp</b></div></td> 
										</tr>
<?php	include "../assets/vendor/configure/koneksi.php"; 
		$sql = "SELECT  `id_dtlpengiriman`, `no_order`, `status`, `timestamp`, `ket` FROM `courierdtl_pengiriman`
				WHERE no_order='$no_order'";
		$result = $conn->query($sql);
 //var_dump($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) { 
		  $no_order = $row['no_order'];
		  $status = $row['status'];
		  $timestamp = $row['timestamp'];
		  $ket = $row['ket'];
		  
		  if(!empty($status==="Requested")){
				$tag="<span class='badge badge-secondary'>$status</span>";				
			}
		  elseif(!empty($status=="Waiting Courier")){
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
		  ?>  
			 <tr> 
				<td><?php echo "$tag &nbsp;" ?></td><td>
				<div class="float-right"><?php echo "$timestamp"; ?></div>
				</td>
			</tr>
			 <tr> 

<?php
		  }
		} else {
		  echo "0 results Kurir belum di input admin";
		} 
		?> 

 				<td>Foto :<img src="../doc_pendukung/<?php echo $gambal_ambil;?>" height='100' width='100'></td>
                <td>Foto :<img src="../doc_pendukung/<?php echo $gambal_kirim;?> " height='100' width='100'></td>
			</tr>
									 
									</table>
                                        
                                          </div>
                                </div>
                            </div>
                        </div>
 
                    </div>
                </div>
					
				<?php
				}
				else{?>
				          <div class="col-12"> 
            <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body">
			  <h3>100 Pengiriman/Pickup Barang Terakhir</h3>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Resi</th>
                    <th>Type</th>					
                    <th>Item</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Ref&nbsp;No</th> 
                    <th>Status</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
 <?php
include "../assets/vendor/configure/koneksi.php";
$tgl_log = date("Y-m-d"); 
$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal, nama_perusahaan,
				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
				`nik_kurir`, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
		FROM `tr_pengiriman` 
		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat 		
		ORDER BY no_order DESC
		LIMIT 0,100 ";
		//datetime_proses like '%$tgl_log%'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
			$no_order = $row['no_order'];
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
 
			
			
			
				echo "<tr>
                    <td>$no_order</td>
                    <td>$type_order</td>					
                    <td>$nama_barang <br><font size='1' style='background-color:#FFD700';  ><i>$ket1</i></font></td>
                    <td>$nama_perusahaan ($pengirim)</td>
                    <td>$alamat_tujuan ($penerima )</td> 
                    <td>$job_refnumber</td> 
                    <td> $tag <span class='badge badge-danger'>$ket2</span> </td>
                    <td>  <button type='button' class='btn btn-block btn-outline-primary btn-sm'>Detail</button>
					
					</td>
                  </tr>";
  }
} else {
  echo "0 results Order belum di input user";
}
$conn->close();
?>                  
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>	
					
					
				<?php
				}
				
				
				?>

			
            </div>
        </div>
    </section>
  </div>

  <!-- Main footer -->
  <footer class="main-footer">
 
  </footer>

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
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script> 
<!-- Bootstrap 4 --> 
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
  
<script>
  $(function () {
    $("#example1").DataTable({
		"order": [[0, 'desc']],
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
<!-- AdminLTE for demo purposes 
<script src="dist/js/demo.js"></script>-->
</body>
</html>
