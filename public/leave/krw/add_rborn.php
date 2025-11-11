 <?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$nama = $_SESSION['nama'];	
	
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/headform.php"; ?>


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
 <?php include "assets/configure/koneksi.php"; ?>
  <!-- form -->
 
 <!-- End of form -->
 <!-- Aprroval Cuti -->
           <div class="row">
 
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Tambah Cuti Replacement dari Cuti Melahirkan</p>
                  <div class="table-responsive">
                     <table id="dynamic-table"  border="1" style='border: 1px solid #fff; font-family: sans-serif; color: #232323;  border-collapse: collapse;
					} '> 
                        <thead>
                        <tr style='background: #35A9DB;color:#fff;font-weight:normal;'>
                          <th>&nbsp;No&nbsp;&nbsp;</th>
                          <th>&nbsp;Nama&nbsp;</th>						  
                          <th>&nbsp;Jenis&nbsp;Cuti&nbsp;</th>
                          <th>&nbsp;Ubah&nbsp;Tanggal&nbsp;</th>
                          <th>&nbsp;Req&nbsp;Tanggal</th>
                          <th>&nbsp;Shift&nbsp;Leader&nbsp;</th>
                          <th>&nbsp;Spv&nbsp;</th>
                          <th>&nbsp;Manager&nbsp;</th>
                          <th>&nbsp;Staff&nbsp;GA&nbsp;</th>
                          <th>&nbsp;Spv&nbsp;GA&nbsp;</th>
                          <th>&nbsp;Manager&nbsp;GA&nbsp;</th>
                        </tr>  
                      </thead>
                      <tbody>
<?php
 $sql = "SELECT `id_trcuti`, tr_cuti.nik, nama_lengkap, jenis_cuti.nama_cuti,
 `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`,
 `total_hari`, `cuti_tahun`, `alasan`, `approve_sleader`, `tgl_appsleader`,
 `approve_spv`, `tgl_appspv`, `app_manager`, `tgl_appmanager`, `app_hrgas`,
 `tgl_apphrgas`, `app_hrgaspv`, `tgl_apphrgaspv`, `app_hrgamng`, `tgl_apphrgamng`,
 tr_cuti.ket, tr_cuti.ket2, user.kode_loc, user.kode_section FROM `tr_cuti` 
 INNER JOIN user ON tr_cuti.nik = user.nik 
 INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti 
 WHERE tr_cuti.kode_jcuti='CM90'
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
	  $nm_kecil = strtolower($nama_lengkap);
	  $nmt_new = ucwords($nm_kecil);
	  $nama_cuti = $row['nama_cuti'];
 
		$nm_depan = explode(" ", $nmt_new);
		$nama_depan = $nm_depan[0]; // piece1 
	  
	  //$nm_lengkap = ucwords($nama_lengkap);

	  $total_hari = $row['total_hari'];
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
	  if ($approve_sleader=='1')
		  $app_sleader="<div class='badge badge-success'>Approved</div>";
	  else $app_sleader="<div class='badge badge-warning'>Approve</div>"; 
	  
	  $tgl_appsleader = $row['tgl_appsleader'];
	  $approve_spv = $row['approve_spv'];
	  	// Approve  SPV
	  if ($approve_spv=='1')
		  $app_spv="<div class='badge badge-success'>Approved</div>";
	  else $app_spv="<div class='badge badge-warning'>Approve</div>";
	  
	  $tgl_appmanager = $row['tgl_appmanager'];
	  $app_manager = $row['app_manager'];
	  	// Approve  SPV
	  if ($app_manager=='1')
		  $approve_manager="<div class='badge badge-success'>Approved</div>";
	  else $approve_manager="<div class='badge badge-warning'>Approve</div>";
	  
	  $tgl_appspv = $row['tgl_apphrgas'];
	  $app_hrgas = $row['app_hrgas'];
	  // Approve HRGA Spv
	  	  if ($app_hrgas=='1')
		  $approve_hrgas="<div class='badge badge-success'>Approved</div>";
	  else $approve_hrgas="<div class='badge badge-warning'>Approve</div>";
	  
	  $tgl_apphrgaspv = $row['tgl_apphrgaspv'];
	  $app_hrgaspv = $row['app_hrgaspv'];
	  // Approve HRGA Spv
	  	  if ($app_hrgaspv=='1')
		  $approve_hrgaspv="<div class='badge badge-success'>Approved</div>";
	  else $approve_hrgaspv="<div class='badge badge-warning'>Approve</div>";
	  
	  
	  $app_hrgamng = $row['app_hrgamng'];
	  $tgl_apphrgamng = $row['tgl_apphrgamng'];
	  if ($app_hrgamng=='1')
		  $approve_hrgamng="<div class='badge badge-success'>Approved</div>";
	  else $approve_hrgamng="<div class='badge badge-warning'>Approve</div>";
	  
	  
	echo "<tr bgcolor='$warna'>
			<td>$no</td>
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
                        <a class='dropdown-item' href='edit_rborn.php?id=$id_trcuti'>Lama : $newtgl_awalc s/d $newtgl_akhir  <button type='button' class='btn btn-primary btn-sm'>Edit</button></a> 
						<div class='dropdown-divider'>	</div>                        
                        <a class='dropdown-item' href='#'>Jenis : $nama_cuti Total $total_hari Hari</a>
						<div class='dropdown-divider'>	</div>                        
                        <a class='dropdown-item' href='#'>Alasan/Keperluan : $alasan</a>    
                      </div>
                    </div>
 
 
 
			</td>
			
			<td>$tgl_ajuan</td> 
			<td>$app_sleader</td> 
			<td>$app_spv</td>
			<td>$approve_manager</td>
			<td>$approve_hrgas</td>
			<td>$approve_hrgaspv</td>
			<td>$approve_hrgamng</td>
 
            
		</tr>"; 
		$no++;
  }
} else {
  echo "0 results";
}
           /*  <td class='font-weight-medium'><div class='badge badge-success'>Approved</div></td>
						  <td class='font-weight-medium'><div class='badge badge-warning'><a href='#' onclick='myFunction()' style='cursor: pointer;'>Approv</a></div></td> 
						  <td class='font-weight-medium'><div class='badge badge-warning'>Approv</div></td> 
						  <td class='font-weight-medium'><div class='badge badge-warning'>Approv</div></td> 
						  <td class='font-weight-medium'><div class='badge badge-warning'>Approv</div></td> 
						  <td class='font-weight-medium'><div class='badge badge-warning'>Approv</div></td>  */
?>


 

<script>
function myFunction() {
  let text = "Anda yakin approve cuti??";
  if (confirm(text) == true) {
    text = "You pressed OK!";
  } else {
    text = "You canceled!";
  }
  document.getElementById("demo").innerHTML = text;
}
</script>
                      <!--  <tr>
                          <td>Dudi Ramdani</td>
                           <td><div class="dropdown"> <span class="font-weight-bold mr-2">Izin </span>(6 Day) 
									<button class="btn btn-primary btn-sm" type="button" id="dropdownMenuSizeButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="mdi mdi-account-search" style='cursor: pointer;' title='Click for detail reason'></i>
									</button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
									 Mengurus perpulangan anak dari<br>sekolah pada tanggal 24 Desember<br> Terimakasih
								  </div>
								</div>					 
							</td>
                          <td>21 Sep 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td>  
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td>  
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td> 
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td> 
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td> 
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td> 
                        </tr>
                        <tr>
                          <td>Kim Jong Un</td>
                             <td><div class="dropdown"> <span class="font-weight-bold mr-2">Izin </span>(6 Day) 
									<button class="btn btn-primary btn-sm" type="button" id="dropdownMenuSizeButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="mdi mdi-account-search" style='cursor: pointer;' title='Click for detail reason'></i>
									</button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
									 Mengurus perpulangan anak dari<br>sekolah pada tanggal 24 Desember<br> Terimakasih
								  </div>
								</div>					 
							</td>
                          <td>13 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td>
                          <td class="font-weight-medium"><div class="badge badge-success">Approved</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Jo Biden</td>
                              <td><div class="dropdown"> <span class="font-weight-bold mr-2">Izin </span>(6 Day) 
									<button class="btn btn-primary btn-sm" type="button" id="dropdownMenuSizeButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="mdi mdi-account-search" style='cursor: pointer;' title='Click for detail reason'></i>
									</button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
									 Mengurus perpulangan anak dari<br>sekolah pada tanggal 24 Desember<br> Terimakasih
								  </div>
								</div>					 
							</td>
                          <td>Vladimir Putin</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Joko Widodo</td>
                          <td class="font-weight-bold">Sakit</td>
                          <td>30 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Lim Bis Kit</td>
                          <td class="font-weight-bold">Izin</td>
                          <td>01 Nov 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-danger">Cancelled</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Rafael Martinez</td>
                          <td class="font-weight-bold">Alpa</td>
                          <td>20 Mar 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Juan La Porta</td>
                          <td class="font-weight-bold">$897</td>
                          <td>26 Oct 2018</td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
						  <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>-->
                      </tbody>
                    </table>
														
 
		<script src="csstable/js/jquery-2.1.4.min.js"></script>  
		<script src="csstable/js/jquery.dataTables.min.js"></script>
		<script src="csstable/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="csstable/js/dataTables.buttons.min.js"></script> 
		<script src="csstable/js/dataTables.select.min.js"></script>
 
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, { "bSortable": false },null, { "bSortable": false }, { "bSortable": false },{ "bSortable": false },
					  { "bSortable": false },{ "bSortable": false },{ "bSortable": false },
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
                </div>
              </div>
            </div>
 
          </div>
 <!-- End of Aprroval Cuti -->
 
 
 
 
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
<?php include"assets/template/footerjs.php";?>

</body>

</html>

