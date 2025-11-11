
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
 
              <div class="card-body p-0">
 
 
                <div class="table-responsive"><center> 
                    <?php
                    include "../assets/configure/koneksi.php";  
                   $resi =  $_POST["resi"];
                    $nikkurir = $_POST["nik_kurir"];
                     if(isset($_POST['Submit']))
                    {
                    	$count=count($_POST["resi"]);
                    	
                    for($i=0;$i<$count;$i++){
                     $sql1 = "UPDATE `tr_pengiriman` SET `nik_kurir` = '" . $_POST['nik_kurir'][$i] . "' WHERE  no_order='" . $_POST['resi'][$i] . "'";
 
                   if ($conn->query($sql1) === TRUE) {
                       echo ("<script LANGUAGE='JavaScript'>
                       
                           window.alert('Data Kurir berhasil ditambahkan'); 
    
    window.location.href='manage_kurir.php';
    </script>"); 
                    }
                    }
                    }
                   // echo $count;
                    ?>
                    						
						</div> 
						</div> 
 
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
