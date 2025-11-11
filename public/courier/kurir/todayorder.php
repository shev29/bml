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
<?php //include "vendor/menu/dashboard.php";?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) --> 
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)--> 
            <!-- TO DO List -->
            <div class="card">
			  

            </div>
            <!-- /.card -->
			            <div class="card">
              <div class="card-header border-transparent"> 
				
				

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                   <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>-->
                </div>
				<button type="button" class="btn btn-block bg-gradient-danger">
				<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">List Order - Pickup (<?php echo $nama_kurir;?>)</font></font></button>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
 
 
                <div class="table-responsive"> 
				   
                <table id="example1" border='0'class="table m-0">
                  <thead>
                  <tr>
					<th>Action</th>
                    <th>Resi(Item)</th>
                    <th>Pengambilan&nbsp;&nbsp;&nbsp;Dari&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tujuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> 
                   
                  </tr>
                  </thead>
                   <tbody>
                     <?php
                    // echo "$nikkur";
                    include "../assets/configure/koneksi.php";  
                    date_default_timezone_set("Asia/Bangkok");                    
                    $nowdate_forexpire = date('Y-m-d');
                    $tgl_kemarin1    = date('Y-m-d', strtotime('-3 day', strtotime($nowdate_forexpire)));
                    $sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal,  
                    				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as pt_tujuan,
                    				(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as pt_asal,
                    				(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
                    				
                    				`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
                    				`nik_kurir`, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
                    		FROM `tr_pengiriman` 
                    		INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat
                    		WHERE nik_kurir='$nikkur'  AND type_order='pickup'
                    		
                    		
                    			AND datetime_proses BETWEEN '$tgl_kemarin1 00:00:00' and '$nowdate_forexpire 23:59:59'
                    		
                    		
                    		ORDER BY no_order DESC";
                    		
                    		
                    		
                    		//AND type_order='Pickup' AND status='Waiting Courier'
                    $result = $conn->query($sql);
                    $jml_row = mysqli_num_rows($result);
                     //var_dump($sql);
                    if ($result->num_rows > 0) {
                      // output data of each row
                      $no =0;
                      while($row = $result->fetch_assoc()) {
                    			
                    			$no ++;
                    			$no_order = $row['no_order'];
                    			$pt_tujuan = $row['pt_tujuan'];
                    			$pt_asal = $row['pt_asal'];
                    			$pengirim = $row['pengirim'];
                    			$penerima = $row['penerima']; 
                    			$nik_kur = $row['nik_kurir']; 
                    			$type_order = $row['type_order'];
                    			
                    			if($type_order=="Pickup"){
                    				$show_type="<button type='submit' class='btn btn-block btn-success btn-sm'> 
                                      Pickup
                                    </button>";
                    			}
                    			elseif($type_order=="Send"){
                    				$show_type="<button type='submit' class='btn btn-block btn-info btn-sm'> 
                                        Send
                                    </button>";
                    			} 
                    			$alamat_asal = $row['alamat_asal'];
                    			$alamat_tujuan = $row['alamat_tujuan'];
                    			$nama_barang = $row['nama_barang'];
                    			//$idalamat_asal = $row['idalamat_asal'];
                    			//$idalamat_tujuan = $row['idalamat_tujuan'];
                    			$job_refnumber = $row['job_refnumber'];
                    			//$nama_perusahaan = $row['nama_perusahaan'];
                    			$status = $row['status'];
                    			$ket1 = $row['ket1'];
                    			$ket2 = $row['ket2'];
                    			if(!empty($status==="Waiting Courier")){
                    				$tag="<span class='badge badge-secondary'>Mng Kurir</span>";				
                    			}
                    			elseif(!empty($status==="On Delivery")){
                    				
                    				$tag="<span class='badge badge-warning'>$status</span>";
                    				$tag_move=" <a href='finish_pickup.php?resi=$no_order'> <button type='submit' class='btn btn-block btn-success btn-sm'> 
                                      Selesai [Pickup]
                                    </button></a>";
                    				$tag_cancel="<a href='cancel_pickup.php?resi=$no_order'> <button type='submit' class='btn btn-block btn-danger btn-sm'> 
                                      Cancel / Pending
                                    </button></a>";
                    			}
                    			elseif(!empty($status=="Pending")){
                    				                    				$tag_move=" <a href='finish_pickup.php?resi=$no_order'> <button type='submit' class='btn btn-block btn-success btn-sm'> 
                                      Selesai [Pickup]
                                    </button></a>";
                    				$tag_cancel="<a href='cancel_pickup.php?resi=$no_order'> <button type='submit' class='btn btn-block btn-danger btn-sm'> 
                                      Cancel / Pending
                                    </button></a>";
                    				$tag="<span class='badge badge-info'>$status</span>";
                    			}
                    			elseif(!empty($status=="Delivered")){
                    				$tag_move="<a href='nyusul_upload.php?resi=$no_order'><img src='../img/nyusulcam.jpg' width='40' heigth='40'></a>";
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
                                        <td> 
                    					<input type='hidden' name='resi' value='$no_order'>  
                    					$tag_move
                    					$tag_cancel
                                    	 
                    					 </td>
                    					 <td>  
                     
                    						<div class='widget-main'> 
                    					 <p style='font-size:70%;'>($no_order)$nama_barang</p>						
                    							$tag
                    						</div> 
                    					 </td>
                                        <td> 
                    					 <div class='btn-group'><p style='font-size:70%;'> $pt_asal ($pengirim )  </p>  
                                              <button type='button'  data-toggle='dropdown'>+ 
                                              <div class='dropdown-menu'>
                                                <p style='font-size:70%;'>&nbsp;&nbsp;&nbsp;$alamat_asal</p> 
                                              </div>
                                            </div>
                                          </div>	
                    					
                    					
                    					</td>
                                        <td> 
                    					 <div class='btn-group'><p style='font-size:70%;'> $pt_tujuan ($penerima )  </p>  
                                              <button type='button'  data-toggle='dropdown'> +
                                              <div class='dropdown-menu'><p style='font-size:70%;'>&nbsp;&nbsp;&nbsp;$alamat_tujuan</p>  
                                              </div>
                                            </div>
                                          </div>
                    					</td> 
                                         
                                      </tr>"; //$alamat_asal $alamat_tujuan
                      }
                    }  
                     
                     
                    ?>                  
                                   
                                      </tfoot>
                                    </table>
                    				<hr> 
                    				</div>		 
                    						
                    						</div> 
                    						</div> 
                    								<div class="card">
                                  <div class="card-header border-transparent"> 
                                    <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                      </button>
                                       
                                    </div>
                    				<button type="button" class="btn btn-block bg-gradient-info">
                    				<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">List Order - Send (<?php echo $nama_kurir;?>)</font></font></button>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body p-0">
                     
                     
                                    <div class="table-responsive">
                    			    <table id="example1" border='0'class="table m-0">
                                      <thead>
                                      <tr>
                    					<th>Action</th>
                                        <th>Resi(Item)</th>
                                        <th>Pengambilan&nbsp;&nbsp;&nbsp;Dari&nbsp;&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tujuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> 
                                       
                                      </tr>
                                      </thead>
                    						  <tbody>
                    		 <?php
                    		// echo "$nikkur";
                    		include "../assets/configure/koneksi.php";  
                    		date_default_timezone_set("Asia/Bangkok");
                    		$nowdate_forexpire = date('Y-m-d');
                    		$sql = "SELECT `no_order`, `type_order`, `nama_barang`, `job_refnumber`, (courierm_alamat.dtl_alamat) as alamat_asal,  
                    						(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_tujuan)as pt_tujuan,
                    						(select nama_perusahaan from courierm_alamat where id_alamat=idalamat_asal)as pt_asal,
                    						(select dtl_alamat from courierm_alamat where id_alamat=idalamat_tujuan)as alamat_tujuan,
                    						
                    						`tgl_log`, `datetime_proses`, `pengirim`, `dept_pengirim`, `penerima`, `dept_penerima`,
                    						`nik_kurir`, `status`, tr_pengiriman.ket1, tr_pengiriman.ket2, `aktif` 
                    				FROM `tr_pengiriman` 
                    				INNER JOIN courierm_alamat ON tr_pengiriman.idalamat_asal = courierm_alamat.id_alamat
                    				WHERE nik_kurir='$nikkur'  AND type_order='send'
                    				AND datetime_proses like '%$nowdate_forexpire%'
                    				
                    				
                    				ORDER BY no_order DESC";
                    				
                    				//AND type_order='Pickup' AND status='Waiting Courier'
                    		$result = $conn->query($sql);
                    		$jml_row = mysqli_num_rows($result);
                    		 //var_dump($sql);
                    		if ($result->num_rows > 0) {
                    		  // output data of each row
                    		  $no =0;
                    		  while($row = $result->fetch_assoc()) {
                    					
                    					$no ++;
                    					$no_order = $row['no_order'];
                    					$pt_tujuan = $row['pt_tujuan'];
                    					$pt_asal = $row['pt_asal'];
                    					$pengirim = $row['pengirim'];
                    					$penerima = $row['penerima']; 
                    					$nik_kur = $row['nik_kurir']; 
                    					$type_order = $row['type_order'];
                    					
                    					if($type_order=="Pickup"){
                    						$show_type="<button type='submit' class='btn btn-block btn-success btn-sm'> 
                    						    Pickup
                    						</button>";
                    					}
                    					elseif($type_order=="Send"){
                    						$show_type="<button type='submit' class='btn btn-block btn-info btn-sm'> 
                    						   Send
                    						</button>";
                    					} 
                    					$alamat_asal = $row['alamat_asal'];
                    					$alamat_tujuan = $row['alamat_tujuan'];
                    					$nama_barang = $row['nama_barang'];
                    					//$idalamat_asal = $row['idalamat_asal'];
                    					//$idalamat_tujuan = $row['idalamat_tujuan'];
                    					$job_refnumber = $row['job_refnumber'];
                    					//$nama_perusahaan = $row['nama_perusahaan'];
                    					$status = $row['status'];
                    					$ket1 = $row['ket1'];
                    					$ket2 = $row['ket2'];
                    					if(!empty($status==="Waiting Courier")){
                    						$tag="<span class='badge badge-secondary'>Mng Kurir</span>";				
                    					}
                    					elseif(!empty($status==="On Delivery")){
                    						
                    					$tag="<span class='badge badge-warning'>$status</span>";
                    					 $tag_move="<a href='finish_send.php?resi=$no_order'><button type='submit' class='btn btn-block btn-success btn-sm'> 
                    						   Selesai [Send]
                    						</button></a>";
                    				    $tag_cancel="<a href='cancel_send.php?resi=$no_order'> <button type='submit' class='btn btn-block btn-danger btn-sm'> 
                                      Cancel / Pending
                                    </button></a>";
                    					}
                    					elseif(!empty($status=="Pending")){
                    						
                    						$tag="<span class='badge badge-info'>$status</span>";
                    					}
                    					elseif(!empty($status=="Delivered")){
                    						
                    						$tag="<span class='badge badge-success'>$status</span>";
                    							$tag_move="<a href='nyusul_upload.php?resi=$no_order'><img src='../img/nyusulcam.jpg' width='40' heigth='40'></a>";
                    			
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
                    							<td> 
                    							<input type='hidden' name='resi' value='$no_order'>  
                    					 $tag_move
                    					$tag_cancel
                    						 
                    							 </td>
                    							 <td>
                    								<div class='widget-main'>    
                    							 <p style='font-size:70%;'>($no_order)$nama_barang</p>  
                    									$tag
                    								</div> 
                    							 </td>
                    							<td> 
                    							 <div class='btn-group'><p style='font-size:70%;'> $pt_asal ($pengirim )  </p>  
                    								  <button type='button'  data-toggle='dropdown'>+ 
                    								  <div class='dropdown-menu'>
                    									<p style='font-size:70%;'>&nbsp;&nbsp;&nbsp;$alamat_asal</p> 
                    								  </div>
                    								</div>
                    							  </div>	
                    							
                    							
                    							</td>
                    							<td> 
                    							 <div class='btn-group'><p style='font-size:70%;'> $pt_tujuan ($penerima )  </p>  
                    								  <button type='button'  data-toggle='dropdown'> +
                    								  <div class='dropdown-menu'><p style='font-size:70%;'>&nbsp;&nbsp;&nbsp;$alamat_tujuan ss</p>  
                    								  </div>
                    								</div>
                    							  </div>
                    							</td> 
                    							 
                    						  </tr>"; //$alamat_asal $alamat_tujuan
                    		  }
                    		}  
                      
                    		?>                  
					   
						  </tfoot>
						</table>
						<hr> 
						</div>
		<link rel="stylesheet" href="../assetsaceassets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assetsaceassets/font-awesome/4.5.0/css/font-awesome.min.css" /> 
 
		<link rel="stylesheet" href="../assetsaceassets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../assetsaceassets/css/bootstrap-colorpicker.min.css" /> 
		<link rel="stylesheet" href="../assetsaceassets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" /> 
		<link rel="stylesheet" href="../assetsaceassets/css/ace-skins.min.css" /> 
 
		<script src="assets/js/ace-extra.min.js"></script> 
		<script src="../assetsace/js/jquery-2.1.4.min.js"></script> 
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assetsace/js/bootstrap.min.js"></script> 
		<script src="../assetsace/js/spinbox.min.js"></script> 
		<script src="../assetsace/js/ace-elements.min.js"></script>
		<script src="../assetsace/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
 
			
				$('#spinner1333').ace_spinner({value:1,min:1,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				 $('#spinner1').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner2').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner3').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner4').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner5').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner6').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner7').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner8').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner9').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner10').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner11').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner12').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner13').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner14').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner15').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner16').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner17').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner18').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 $('#spinner19').ace_spinner({value:1,min:1,max:20,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				 			
			});
		</script>
        
            </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
 
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">BML Indonesia</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
