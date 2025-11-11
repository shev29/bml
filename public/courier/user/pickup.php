<meta http-equiv='refresh' content='300' >
<?php 
 
include"../assets/sesion/sesionuser.php"; 
?><!DOCTYPE html>
<html lang="en">
<?php include"../assets/vendor/menu_user/head.php"; ?>
<body class="hold-transition sidebar-mini">
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
                			      <?php 
                date_default_timezone_set("Asia/Bangkok");
                $nowdate_forexpire = date('Y-m-d');
                $hour = date('H');
                //echo $hour;
                if ($hour >= 10) {
                 
                  echo "<center>For requests after 10 am, please select the additional Pickup/Send order at sidebar menu<br>
                  <img src='images/additonal.png'></center>";
                }
                else {
                    ?>
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
			<option></option>
	<!--  -->
		</select>
		<input type='button' name='idalamat_asal' value='Show Detail' id='but_read'>
        <br/><br/> 
		<div id='result' class="alert alert-warning alert-dismissible">
          </div>

        <!-- Script -->
        <script>
        $(document).ready(function(){
            
            // Initialize select2


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
	 			<option></option>
			</select>

		<input type='button' value='Show Detail' id='but_read2'>
		<br> <br> 
		<div class="alert alert-warning alert-dismissible" id='result2'></div>

		<!-- Script -->
		<script>
		$(document).ready(function(){

		function formatResultRemote(data) {
			console.log(data);
			if (data.loading) return data.text;
			if (!data.description1 && !data.description2) return data.text;
			return $(`<div class="select2-result">
						<div class="select2-result__title">${data.text}</div>
						<div class="select2-result__description">
							<div class="description-line">${data.description1 || ''}</div>
							<div class="description-line">${data.description2 || ''}</div>
						</div>
					</div>`);
		}

		// Initialize select2
		$('#selUser').select2({
            minimumInputLength: 3,
            allowClear: false,
            placeholder: '-- Select --',
            ajax: {
                url : `get_address.php`,
                type: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Referer': window.location.href
                },
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term,
                        page: params.page || 1
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.map(row => ({
                            id: row.id,
                            text: row.text,
                        })),
                        pagination: {
                            more: (params.page * 10) < data.count_filtered
                        }
                    }
                }
            }
        });

		$('#selUser2').select2({
            minimumInputLength: 3,
            allowClear: false,
            placeholder: '-- Select --',
            ajax: {
                url : `get_address.php`,
                type: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Referer': window.location.href
                },
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term,
                        page: params.page || 1
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.map(row => ({
                            id: row.id,
                            text: row.text,
                        })),
                        pagination: {
                            more: (params.page * 10) < data.count_filtered
                        }
                    }
                }
            }
        });

		// Read selected option
		$('#but_read2').click(function(){
		var username = $('#selUser2 option:selected').text();
		var userid = $('#selUser2').val();

		$('#result2').html("Detail : " + username);
		});
		});
		</script>
		</div>
  			 <div class="form-group">
				<label for="exampleInputEmail1">Note</label><br>
				<div class="alert alert-warning alert-dismissible">  
                 <input type="hidden" name="ket" class="form-control" value="" placeholder="Input Reason">
                 <input type="hidden" name="ket2" class="form-control" value="" >
                </div>
			</div>	
			
                <div class="card-footer">
 
				  <input type="reset" class="btn btn-secondary" Value='Reset'> 
                  <input type="submit" class="btn btn-primary" Value='Submit'> 
                </div>
              </form>
       <?php
}
       ?>
 
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
  
  
  
<?php include "../assets/vendor/menu_user/footer.php";?>

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

<!-- <script>
$(function () {
  bsCustomFileInput.init();
});
</script> -->
</body>
<script src='../assets/combo.js' type='text/javascript'></script>
<script src='../assets/select2/dist/js/select2.min.js' type='text/javascript'></script>

<link href='../assets/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>