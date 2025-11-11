
<!DOCTYPE html>
<html lang="en">

<head>
<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
?>
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

 <?php echo "<h5>View Approval HRGA Department </h5><br>"; ?>

 
 <!-- form -->
           <div class="row"> 
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" /> 

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
<table id="example" class="table table-striped table-bordered" style="width:100%">


 						<thead> 
                         <tr style='background: #35A9DB;color:#fff;font-weight:normal;'> 
                          <th>&nbsp;Ref&nbsp;</th>						  
                          <th>&nbsp;Nama&nbsp;</th>						  
                          <th>&nbsp;Jenis&nbsp;Cuti&nbsp;</th> 
                          <th>Req&nbsp;Tanggal&nbsp;</th>
						  <th>Durasi</th> 
						  <th>&nbsp;Shift&nbsp;Leader&nbsp;</th>
                          <th>&nbsp;Chceked By&nbsp;&nbsp;&nbsp;&nbsp;</th> 
						  <th>&nbsp;Approved By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> 
                        </tr> 
                      </thead>
                      <tbody>
<?php   include "assets/configure/koneksi.php"; 
   //`id_app`, `nik`, `tl_checker`, `app_level.check_1`, `app_level.check_2`, `app_level.approve_1`, `app_level.approve_2`, `hrga_staff1`, `hrga_staff2`, `hrga_spv`, `hrga_mng`  

	 $show_querysection ="tr_cuti.nik!='$nikso' AND   kode_section='$kode_section'
	OR nik_sleader='$nikso'
	OR app_level.check_1='$nikso'
	OR app_level.check_2='$nikso'
	OR app_level.approve_1='$nikso'
	OR app_level.approve_2='$nikso'";

 
 $sql = "SELECT `id_trcuti`, tr_cuti.nik, nama_lengkap,tr_cuti.kode_jcuti, jenis_cuti.nama_cuti, 
 `tgl_pengajuan`,`tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`,
 `total_hari`, `doc_pendukung`, `cuti_tahun`, `alasan`, `nik_sleader`, `status_sleader`,
 `tgl_appsleader`, `nik_check1`,(select nama_lengkap from user where nik=nik_check1)as nm_nikcheck1,
 `status_check1`, `tgl_check1`, `nik_check2`,(select nama_lengkap from user where nik=nik_check2)as nm_nikcheck2,
 `status_check2`, `tgl_check2`, `nik_approve1`,(select nama_lengkap from user where nik=nik_approve1)as nm_nikapprove1,
 `status_approve1`, `tgl_approve1`, `nik_approve2`, `status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`, 
 `tgl_apphrgas`, `nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`, `tgl_apphrgamng`, 
 tr_cuti.ket, tr_cuti.ket2, user.level, user.kode_loc, user.kode_section,
(app_level.check_1) as c1, (app_level.check_2) as c2, (app_level.approve_1) as app1, (app_level.approve_2) as app2 
FROM `tr_cuti` 
INNER JOIN user ON tr_cuti.nik = user.nik 
INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti 
INNER JOIN app_level ON tr_cuti.nik = app_level.nik 
 WHERE $show_querysection
	  
 GROUP BY id_trcuti order by id_trcuti ASC";
   //var_dump($sql);
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
	  $level = $row['level'];
	  $total_hari = $row['total_hari'];
 
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

	  $kode_loc = $row['kode_loc'];
	  //approve Shift Leader 
	  
	  $nik_sleader = $row['nik_sleader'];
	  $approve_sleader = $row['status_sleader'];
	  $tgl_appsleader = $row['tgl_appsleader'];
 
 
		$nik_check1 = $row['nik_check1'];
		$nm_nikcheck1 = $row['nm_nikcheck1'];
		$status_check1 = $row['status_check1'];
		$tgl_check1 = $row['tgl_check1'];
		
		$nik_check2 = $row['nik_check2'];
		$nm_nikapprove1 = $row['nm_nikapprove1'];
		$status_check2 = $row['status_check2'];
		$tgl_check2 = $row['tgl_check2'];
		
		$nik_approve1 = $row['nik_approve1'];
		$status_approve1 = $row['status_approve1'];
		$tgl_approve1 = $row['tgl_approve1'];
		
		
		$nik_approve2 = $row['nik_approve2'];		
		$status_approve2 = $row['status_approve2'];
		$tgl_approve2 = $row['tgl_approve2'];
		
		//inner join app Level
		$c1 = $row['c1'];
		$c2 = $row['c2'];
		$app1 = $row['app1'];
		$app2 = $row['app2'];
 
        $cuti_tahun = $row['cuti_tahun'];
        $kode_jcuti = $row['kode_jcuti'];
        

        
 // hitung jumlah cuti yang diambil dalam tahun yang sama 
  
   $sql_hitung = "SELECT  sum(total_hari)as total_ambil FROM `tr_cuti` 
                WHERE cuti_tahun='$cuti_tahun' AND nik='$nik' AND kode_jcuti='CT12'";
$result_hitung = $conn->query($sql_hitung);
//var_dump($sql_hitung);
if ($result_hitung->num_rows > 0) {
  // output data of each row
  while($row_hitung = $result_hitung->fetch_assoc()) {
      $total_ambil = $row_hitung['total_ambil']; 
    //echo " $jml_ct <br>";
  }
} 
  
 // Hitung jumlah cuti yang dimiliki dalam tahun pengambilan 
  $sql_jmlct = "SELECT  `id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, `ket` 
                FROM `cuti_lahir` 
                WHERE tahun='$cuti_tahun' AND nik='$nik'";
$result_jmlct = $conn->query($sql_jmlct);
//var_dump($sql_jmlct);
if ($result_jmlct->num_rows > 0) {
  // output data of each row
  while($row_jmlct = $result_jmlct->fetch_assoc()) {
      $jml_ct = $row_jmlct['jumlah'];
      $cuti_stahun = $row_jmlct['tahun'];
    //echo " $jml_ct <br>";
  }
} 
$sisa = $jml_ct-$total_ambil;

        		$doc_pendukung = $row['doc_pendukung'];
		
		if(($kode_jcuti=="CTSKT")or($kode_jcuti=="CM90")or($kode_jcuti=="CK45")or($kode_jcuti=="CTN1")){
		
		$doc = "<a href='doc_pendukung/$doc_pendukung'><div class='badge badge-warning'><font style='font-size:10px'>Support Doc</font></div></a>";
			 $hitung_cuti ="Sakit/Melahirkan/Keguguran";
		}
				elseif(($kode_jcuti=="CTIZ")or($kode_jcuti=="ALPHA")){
		     	$hitung_cuti ="Unpaid";
		    $doc="";
		}
	 
		else{
		     	$hitung_cuti ="  $sisa Hari $cuti_stahun";
		    $doc="";
		}
	echo "<tr bgcolor='$warna'> 
			<td>$id_trcuti</td>
			<td> $nm_kecil<br><p style='font-size:10px'><i>$nik</i></p> </td>
			<td>$nama_cuti $doc<br><p style='font-size:10px'><i>Keperluan : $alasan</i></p> </td>  
			<td>$tgl_ajuan</td>
			<td>$newtgl_awalc - $newtgl_akhir 
				<p style='font-size:10px'><i>$total_hari Hari - $hitung_cuti </i></p>
			</td>
			 
			";
// Kondisi untuk menampilkan shift leader karaawang		
			if (($kode_loc=='KARAWANG FC1') or ($kode_loc=='KARAWANG FC2')){
					
			if ($approve_sleader=='1'){	 
				?>
				<td>
				<div class="badge badge-success">Approved sl</div>
				 <p style="font-size:10px"><?php  echo $tgl_appsleader; ?></p>
				</td> 
				<?php } 
			else {
			?>
				 <td>				 
				  <a href="rejectc_tl.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-danger'>Reject sl</div></a>
				 <a href="approve_cuti.php?id=<?php echo $id_trcuti; ?>" ><div class='badge badge-warning'>Approve sl</div></a>
				   
				</td> 
			<?php }
		
			}
			else{
				echo "<td><center>-</center></td>";
			}
//selain dari karawang		
 
				// level 
			
// Kalo Level Manager			
			
			if (($c1==$nikso) or ($c2==$nikso)) {
				if (($status_check1=='1')or($status_check2=='1')){
				   
				echo "<td> <div class='badge badge-success'> $nm_nikcheck1 </div>
						<p style='font-size:10px'>$tgl_check1</p> 	 </td>"; 
				}	
				
			else  {
				echo"<td><a href='rejectc_check.php?id=$id_trcuti'><div class='badge badge-danger'>Reject</div></a> 
				 <a href='approve_check1.php?id=$id_trcuti&&nik_check1=$nik_check1&&nik_pemohon=$nik'><div class='badge badge-warning'>Approve</div></a></td>";
			
 			 
				}
			}
			elseif (($c1!=$nikso) or ($c2!=$nikso)) {
				if (($status_check1=='1')or($status_check2=='1')){
				echo "<td> <div class='badge badge-success'> $nm_nikcheck1 </div>
						<p style='font-size:10px'>$tgl_check1</p> 	 </td>";   
 			  
				}
				else  {
					echo "<td><div class='badge badge-warning'>Waiting Check</div></td>";
				}
			}
			  
			
		if (($app1==$nikso) or ($app2==$nikso)) {
			  if (($status_approve1=='1')or($status_approve2=='1')){
				   
						echo "<td> <div class='badge badge-success'> $nm_nikapprove1 </div>
						<p style='font-size:10px'>$tgl_approve1</p> 	 </td>"; 
				}		
						else  {
				echo"<td><a href='rejectc_approve.php?id=$id_trcuti'><div class='badge badge-danger'>Reject</div></a>
				 <a href='approve_by.php?id=$id_trcuti'><div class='badge badge-warning'>Approve</div></a></td>";
			 
				}
			}
				elseif (($app1!=$nikso) or ($app2!=$nikso)){
					if (($status_approve1=='1')or($status_approve2=='1')){
				   
						echo "<td> <div class='badge badge-success'> $nm_nikapprove1 </div>
						<p style='font-size:10px'>$tgl_approve1</p> 	 </td>"; 
				}		
						else  {
							echo "<td><div class='badge badge-warning'>Waiting App</div></td>"; 
			 
				}
				 
				 			  
			}
		echo "
		</tr>"; 
		$no++;
 
 }
 } 
else {
  echo "0 results";
}
 
 
$conn->close();
?> 
                      </tbody>
                    </table>
														
  
 
		<script type="text/javascript">
		$(document).ready(function () {
    $('#example').DataTable({
        	"order": [[0, 'desc']],
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
