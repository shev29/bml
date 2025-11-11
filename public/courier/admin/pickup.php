<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
?>
<?php 
include"../assets/configure/sesionadmin.php"; 
?><!DOCTYPE html>
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
	
	
    <!-- SMART SEARCH ADDRESS -->
         <script src='../assets/combo.js' type='text/javascript'></script>
        <script src='../assets/select2/dist/js/select2.min.js' type='text/javascript'></script>
		
		
       <!-- END SMART SEARCH ADDRESS -->
  <form method='post' action='post_pickup.php'>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
          <!-- left column -->
          <div class="col-md-12">
		  

   
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">PICK UP FORM </h3>
              </div> 
			  
			  <div class="card-body">
			 <div class="form-group">
				<label for="exampleInputEmail1">Order From (Recipient)</label><br>
				<div class="alert alert-warning alert-dismissible">
				
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
				  <table>
					<tr>
						<td><b> Name</b>   </td><td>:</td><td><?php echo "$namas"; ?></td>
					</tr>
					<tr>
						<td><b> Email </b>   </td><td>:</td><td><?php echo  $emails_ses;  ?></td>
					</tr>
					<tr>
						<td><b> Dept</b>   </td><td>:</td><td><?php echo  $kode_section;  ?></td> 
					</tr>
				  </table>
				  
                 
                </div>
			</div>
			
			
			
			 <div class="form-group">
				<label for="exampleInputEmail1">Name Of Document / Item </label><br>
				<div class="alert alert-warning alert-dismissible"> 

				  <table>
					<tr>
						<td> 		
						
							<div class="form-check"> 
							 <input class="form-check-input" type="hidden" name="nikso" value="<?php echo $nikso?>">
							 <input class="form-check-input" type="checkbox" name="nama_barang1" value="Original Document, ">
							 <label class="form-check-label">Original Document</label> 
							</div>
						</td>
						<td>&nbsp;&nbsp;&nbsp;
						</td>
						<td><div class="form-check">
							 <input class="form-check-input" type="checkbox" name="nama_barang2" value="Document, ">
							  <label class="form-check-label">Document</label>
							</div>
						</td>
					</tr>
					<tr>
						<td><div class="form-check">
							 <input class="form-check-input" type="checkbox" name="nama_barang3" value="Invoice, ">
							  <label class="form-check-label">Invoice</label>
							</div>
						</td>
							<td>:</td>
						<td>
						<div class="form-check">
							 <input class="form-check-input" type="checkbox" name="nama_barang4" value="Surat Kuasa (SK), ">
							  <label class="form-check-label">Surat Kuasa (SK)</label>
							</div>						
						</td>
					</tr>
					<tr>
						<td><div class="form-check">
							 <input class="form-check-input" type="checkbox" name="nama_barang5" value="Lainnya :">
							  <label class="form-check-label">Other</label>
							</div>	
						</td>
						<td>:</td><td></td> 
					</tr>
				  </table>
				  
                 <input type="text" name="nama_barang5" class="form-control" placeholder="">
                </div>
			</div>	
			
			 <div class="form-group">
				<label for="exampleInputEmail1">JOB / REFF Number </label><br>
				<div class="alert alert-warning alert-dismissible"> 
			 
				<textarea name='job_refnumber' class="form-control" rows="3" placeholder=" ..."></textarea> 
                </div>
			</div>
			 <div class="form-group">
				<label for="exampleInputEmail1">Date Time Process Document / Item </label><br>
				<div class="alert alert-warning alert-dismissible"> 
 
				  
                 <input type="datetime-local" name="datetime_proses" maxlength='26' size='4' class="form-control" placeholder=" ...">
                </div>
			</div>
			
 			 <div class="form-group">
				<label for="exampleInputEmail1">PIC / Pickup Point </label><br>
				<div class="alert alert-warning alert-dismissible">  
                 <input type="text" name="pengirim" class="form-control" placeholder="PIC/Tempat pengambilan ...">
                </div>
			</div>	
			  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pick Up Address</label> <br>
	 <select id='selUser' class="form-control form-control-lg" name='idalamat_asal'  style='width: 800px;'>  
	 <option class="form-control">---- Choose Address----</option>
 <?php 
 //`no_order`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nama_barang`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif`
	    
 include "../assets/configure/koneksi.php"; 
		$sql = "SELECT  `id_alamat`, `nama_perusahaan`, `dtl_alamat`FROM `courierm_alamat` ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) { 
		  $id_alamat = $row['id_alamat'];
		  $nama_peru = $row['nama_perusahaan'];
		  $dtl_alamat = $row['dtl_alamat'];

		  ?>
				<option  class="form-control" value='<?php echo $id_alamat;?>'><?php echo "$nama_peru,&nbsp;&nbsp;$dtl_alamat"; ?></option>  
<?php
		  }
		} else {
		  echo "0 results";
		}
		
		
	
		$conn->close();
		?> 
	<input type='button' name='idalamat_asal' value='Show Detail' id='but_read'>
		</select>    
        <br/><br/> 
		<div id='result' class="alert alert-warning alert-dismissible">
          </div>

        <!-- Script -->
        <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#selUser").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("Detail : " + username);
            });
        });
        </script>
                      
     </div>
  
				 <br> 
		 
		<div class="form-group">
			<label for="exampleInputEmail1">Destination</label><br>
			 <!-- Dropdown -->       

			<select id='selUser2' class="form-control form-control-lg" name='idalamat_tujuan'  style='width: 800px;'>   
	 <option class="form-control">---- Choose Address----</option>
		<?php 
		//`no_order`, `idalamat_asal`, `idalamat_tujuan`, `tgl_log`, `datetime_proses`, `pengirim`, `penerima`, `nama_barang`, `nik_kurir`, `status`, `ket1`, `ket2`, `aktif`
	    include "../assets/vendor/configure/koneksi.php"; 
		$sql = "SELECT  `id_alamat`, `nama_perusahaan`, `dtl_alamat`FROM `courierm_alamat` ORDER BY id_alamat DESC";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) { 
		  $id_alamat = $row['id_alamat'];
		  $nama_peru = $row['nama_perusahaan'];
		  $dtl_alamat = $row['dtl_alamat'];
		  ?>
				<option  class="form-control" value='<?php echo $id_alamat;?>'><?php echo "$nama_peru,&nbsp;&nbsp;$dtl_alamat"; ?></option> 
		<?php
		  }
		} else {
		  echo "0 results";
		}
		$conn->close();
		?>
		</select>   

		<input type='button' value='Show Detail' id='but_read2'>
		<br> <br> 
		<div class="alert alert-warning alert-dismissible" id='result2'></div>

		<!-- Script -->
		<script>
		$(document).ready(function(){

		// Initialize select2
		$("#selUser2").select2();

		// Read selected option
		$('#but_read2').click(function(){
		var username = $('#selUser2 option:selected').text();
		var userid = $('#selUser2').val();

		$('#result2').html("Detail : " + username);
		});
		});
		</script>
		</div>
 
                <div class="card-footer">
 
				  <input type="reset" class="btn btn-secondary" Value='Reset'> 
                  <input type="submit" class="btn btn-primary" Value='Submit'> 
                </div>
              </form>
       
 
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  <!-- /.content-wrapper -->
  
  
  
<?php include "../assets/vendor/menu_admin/footer.php";?>

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
<!-- bs-custom-file-input -->
<script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
<script src='../assets/combo.js' type='text/javascript'></script>
<script src='../assets/select2/dist/js/select2.min.js' type='text/javascript'></script>

<link href='../assets/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>