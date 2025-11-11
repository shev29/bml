 <?php
include "assets/configure/sesionadmin.php"; 	
	
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php  include "assets/template/head.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php"; ?>
    <!-- partial -->
	
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
  <?php include "assets/template/wrapper.php"; ?>
 
      <!-- partial:partials/_sidebar.html -->
      <?php include "assets/template/sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->
           <div class="row"> 
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" /> 

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
 
<button type="button" class="btn btn-primary btn-sm">btn-sm</button>
<table id="example" class="table table-striped table-bordered" style="width:100%">
                   
						<thead>
                         <tr style='background: #35A9DB;color:#fff;font-weight:normal;'> 
                          <th>&nbsp;Nama&nbsp;</th>						  
                          <th>&nbsp;Jenis&nbsp;Cuti&nbsp;</th>
                          <th>&nbsp;Detail&nbsp;</th>
                          <th>&nbsp;Req&nbsp;Tanggal</th> 
                          <th>&nbsp;Staff&nbsp;HRGA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                          <th>&nbsp;Spv&nbsp;HRGA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                          <th>&nbsp;Manager&nbsp;HRGA&nbsp;</th>
                        </tr> 
                      </thead>
                      <tbody>
<?php   include "assets/configure/koneksi.php"; 
 
 $sql = "SELECT `id_trcuti`, tr_cuti.nik, nama_lengkap, jenis_cuti.nama_cuti, 
 `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`, `total_hari`, 
 `cuti_tahun`, `alasan`, `approve_sleader`, `tgl_appsleader`, `approve_spv`, 
 `tgl_appspv`, `app_manager`, `tgl_appmanager`, `app_hrgas`, `tgl_apphrgas`,
 `app_hrgaspv`, `tgl_apphrgaspv`, `app_hrgamng`, `tgl_apphrgamng`, tr_cuti.ket,
 tr_cuti.ket2, user.kode_loc, user.kode_section FROM `tr_cuti` 
 INNER JOIN user ON tr_cuti.nik = user.nik 
 INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti 
 WHERE app_manager='1'
 GROUP BY id_trcuti order by id_trcuti DESC";
$result = $conn->query($sql);

 

if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
$warnaGenap = "#CCCCCC";   // warna abu-abu
$warnaGanjil = "#FFFFFF";  // warna putih
$warnaHeading = "#FF0000";

  while($row = $result->fetch_assoc()) {
	    if ($no % 2 == 0)
		$warna = $warnaGenap;
	else $warna = $warnaGanjil;
		$id_trcuti = $row['id_trcuti'];
		$nik = $row['nik'];
		$nama_lengkap = $row['nama_lengkap'];
		$total_hari = $row['total_hari'];
		$nm_kecil = strtolower($nama_lengkap);
		$nmt_new = ucwords($nm_kecil);
		$nm_cuti = $row['nama_cuti'];	   
		$partnama_cuti = explode(" ", $nm_cuti); 
		$nama_cuti = $partnama_cuti[1]; 
		$nm_depan = explode(" ", $nmt_new);
		$nama_depan = $nm_depan[0]; // piece1 
	  
	  //$nm_lengkap = ucwords($nama_lengkap);

	  $alasan = $row['alasan'];
	 
	  $tgl_pengajuan = $row['tgl_pengajuan'];
	  $tgl_ajuan = date('d M Y', strtotime($tgl_pengajuan));
	  $tgl_awalc = $row['tgl_awalc'];
	  $newtgl_awalc = date('d M Y', strtotime($tgl_awalc));
	  $tgl_akhir = $row['tgl_akhir'];	 
	  $newtgl_akhir = date('d M Y', strtotime($tgl_akhir));

	  $approve_sleader = $row['approve_sleader'];
	  $kode_loc = $row['kode_loc'];
	  //approve Shift Leader 
	  $tgl_appsleader = $row['tgl_appsleader'];
	  
	  	// Approve  SPV 		
	  $tgl_appspv = $row['tgl_appspv'];
	  $approve_spv = $row['approve_spv']; 

	  	// Approve  Manager
		$tgl_appmanager = $row['tgl_appmanager'];
		$app_manager = $row['app_manager']; 

	  // Approve HRGA staff
		$tgl_apphrgas= $row['tgl_apphrgas'];
		$app_hrgas = $row['app_hrgas'];
	   
	  
	  // Approve HRGA Spv
	  		$app_hrgaspv = $row['app_hrgaspv']; 
			$tgl_apphrgaspv = $row['tgl_apphrgaspv']; 
	   
// manager
	  $app_hrgamng = $row['app_hrgamng']; 
	  $tgl_apphrgamng = $row['tgl_apphrgamng'];
	  
	echo "<tr bgcolor='$warna'> 
			<td>$nama_depan</td>
			<td>$nama_cuti </td> 
			<td>
				<div class='dropdown'>
                      <button title='Detail' class='btn btn-success btn-sm dropdown-toggle' type='button' 
					  id='dropdownMenuSizeButton2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                
                      </button>
                      <div class='dropdown-menu' aria-labelledby='dropdownMenuSizeButton2'>
                        <a class='dropdown-item' href='#'>Nama : $nmt_new</a>
						<div class='dropdown-divider'>	</div> 
                        <a class='dropdown-item' href='#'>NIK : $nik</a>
						<div class='dropdown-divider'>	</div> 
                        <a class='dropdown-item' href='#'>Loc : $kode_loc</a> 
                        <div class='dropdown-divider'>	</div>                        
                        <a class='dropdown-item' href='#'>Lama : $newtgl_awalc s/d $newtgl_akhir ($total_hari) Hari</a> 
						<div class='dropdown-divider'>	</div>                        
                        <a class='dropdown-item' href='#'>Jenis : $nama_cuti</a>
						<div class='dropdown-divider'>	</div>                        
                        <a class='dropdown-item' href='#'>Alasan/Keperluan : $alasan</a>    
                      </div>
                    </div>
 
 
 
			</td>
			
			<td>$tgl_ajuan</td> "; 
	if ($app_hrgas=='1'){
	  ?> <td>
		 <div class='badge badge-success'>Approved</div> 
			 <br><font style="font-size:10px"><?php  echo $tgl_apphrgas; ?></font>		 
		 </td>
		<?php }
	else {?>
		<td><a href="rejectc_hrgas.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-danger'>Reject</div></a>
			<a href="approve_hrgas.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-warning'>Approve</div></a>
			
		</td> 
	<?php }  
	if ($app_hrgaspv=='1'){
	  ?> <td>
		 <div class='badge badge-success'>Approved</div>  
		  <br><font style="font-size:10px"><?php  echo $tgl_apphrgaspv; ?></font>
		 </td>
		<?php }
	else {?>
		<td><a href="rejectc_hrgaspv.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-danger'>Reject</div></a>
			<a href="approve_hrgaspv.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-warning'>Approve</div></a>
			
		</td> 
	<?php } 
	if ($app_hrgamng=='1'){
	  ?> <td>
		 <div class='badge badge-success'>Approved</div>  
		  <p style="font-size:10px"><?php  echo $tgl_appmanager; ?></p> 
		 </td>
		<?php }
	else {?>
		<td><a href="rejectc_hrgamng.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-danger'>Reject</div></a>
			<a href="approve_hrgamng.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-warning'>Approve</div></a>
		 
		</td> 
	<?php } ?>  
 
        <?php    
		echo "</tr>"; 
		$no++;
  }
} else {
  echo "0 results";
}
 
 
$conn->close();
?> 
                      </tbody>
                    </table>
														
  
 
		<script type="text/javascript">
		$(document).ready(function () {
    $('#example').DataTable({
        pagingType: 'full_numbers',
    });
});
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [ 
					  null, null,null, null, null, null,null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>


<!--End of Table -->
 
          </div>
 <!-- End of form -->
 
 
 
 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include"assets/template/footer.php";?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
 <?php include"assets/template/footerjstable.php";?>

</body>

</html>

