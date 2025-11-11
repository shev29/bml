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
<?php
$lokasi_karyawan = $_POST['kode_loc'];
$tgl_pengajuan = $_POST['tgl_pengajuan'];
$tahun_cbersama = $_POST['tahun_cbersama'];
$detail_tanggal = $_POST['detail_tanggal'];
$total_hari = $_POST['total_hari'];
$cuti_bal = $_POST['cuti_bal'];
$reason = $_POST['reason'];
 
?>  <a href="preadd_cutibsm.php"><button type="button" class="btn btn-outline-primary btn-fw">Cuti Bersama</button></a>
 
 <!-- form -->
           <div class="row"> 
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" /> 

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
 

<?php
 include "assets/configure/koneksi.php"; 
 $sqlTRUNCATE = "TRUNCATE TABLE cutibersama_temp";

if ($conn->query($sqlTRUNCATE) === TRUE) {
 // echo "Truncate and sync successfully";
}
    
// Acuan pengecheckan expired cuti    
	    $expire_paslibur = date('Y-m-d', strtotime($detail_tanggal));
	    $lebaran_tahun = date('Y', strtotime($detail_tanggal));


// Menghitung semua karyawan
$sql = "SELECT `id_user`, `nama_lengkap`, `nik`, 
`hire_date`, `email`, `email2`, `username`, `password`, 
`kode_loc`, `kode_dep`, `kode_section`, `title`, `level`, `level_akses`, 
`token`, `exp_token`, `status_aktif`, `ket`, `ket2` FROM `user`
		WHERE kode_loc='$lokasi_karyawan' AND nik>10000000 AND
		 status_aktif='1' ORDER BY id_user DESC 
		";

  	 // Hitung jumlah cuti yang dimiliki dalam tahun pengambilan 
    $now_date=date('Y-m-d');
 
$result = $conn->query($sql);
 //var_dump($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $id_user = $row['id_user'];
	  $nama_lengkap = $row['nama_lengkap'];
	  $nik = $row['nik'];
	  $hire_date = $row['hire_date'];
	  $level = $row['level'];
	  $email = $row['email'];
	  $email2 = $row['email2'];
	  $kode_loc = $row['kode_loc'];
	  $kode_dep = $row['kode_dep'];
	  $username = $row['username'];
	  $kode_section = $row['kode_section']; 
 
	  	 // Hitung jumlah cuti yang dimiliki dalam tahun pengambilan 
    $now_date=date('Y-m-d');
 

       // memfilter expired                        
  $sql_jmlct = "SELECT  `id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, `ket` 
                FROM `cuti_lahir` 
                WHERE nik='$nik'  AND exp_cuti>'$expire_paslibur' limit 0,1 ";
                
$result_jmlct = $conn->query($sql_jmlct);




                                  if ($result_jmlct->num_rows > 0) {
                                // output data of each row
                                    while($row_jmlct = $result_jmlct->fetch_assoc()) {
                                        $exp_cuti = $row_jmlct['exp_cuti'];
                                    $jml_ct = $row_jmlct['jumlah'];
                                    $niki = $row_jmlct['nik'];
                                    $cuti_stahun = $row_jmlct['tahun'];
                                    $lahir_cuti = $row_jmlct['lahir_cuti'];
                        
                        // Menghitung sisa cuti di tahun berikutnya
                         $sql_test = " SELECT SUM(total_hari) as sisa FROM `tr_cuti` WHERE cuti_tahun='$cuti_stahun' AND nik='$nik' AND kode_jcuti='CT12'";
                         $result_test = $conn->query($sql_test);
                         $row_test = $result_test->fetch_assoc();
                         $sisa=$row_test['sisa'];
                         $sisas= $jml_ct-$sisa;             
                         $saldo_cuti = $sisas-$total_hari;
                         
                      
                                         $sql_normal = "INSERT INTO `cutibersama_temp` (`id_cbtem`, `nama_bersama`, `cuti_tahun`, cbersama_tahun,`nik`, `sisa_cuti`, `tag`, tag2,`total_cutibersama`, saldo) 
                                         VALUES (NULL, '$reason $lebaran_tahun', '$cuti_stahun','$tahun_cbersama', '$nik', '$sisas', '$cuti_stahun$nik','Normal', '$total_hari','$saldo_cuti')";
                                          
                                        if ($conn->query($sql_normal) === TRUE) {
                                        //  echo "abnormal";
                                        }
                                                                            
                                    }}    
                                    else{
                        $jml_ct="Kosong";
                    //Beruhutang cuti tahun depan
                         $sql_test2 = " SELECT SUM(total_hari) as sisa FROM `tr_cuti` WHERE cuti_tahun='$cuti_stahun' AND nik='$nik' AND kode_jcuti='CT12'";
                         $result_test2 = $conn->query($sql_test2);
                         $row_test2 = $result_test2->fetch_assoc();
                         $sisa2=$row_test2['sisa'];
                         $sisas2= $jml_ct-$sisa2;             
                         $saldo_cuti2 = $sisas2-$total_hari;
 /*  $sql_ct = "INSERT INTO `tr_cuti_samaran` 
 (`id_trcuti`, `nik`, `kode_jcuti`, `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`,
 `detail_tanggal`, `total_hari`, `doc_pendukung`, `cuti_tahun`, alasan,
 nik_sleader, `status_sleader`, `tgl_appsleader`, `nik_check1`, `status_check1`, 
 `tgl_check1`, `nik_check2`, `status_check2`, `tgl_check2`, `nik_approve1`, status_approve1,
 tgl_approve1, `nik_approve2`, `status_approve2`, `tgl_approve2`, `nik_hrgas`, `app_hrgas`,
 `tgl_apphrgas`, `nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`, `nik_hrgamng`, `app_hrgamng`,
 `tgl_apphrgamng`, `ket`, `ket2`) VALUES
 (NULL, '$nik', 'CT12', '$now_date', '$expire_paslibur',
 '$expire_paslibur', '$expire_paslibur', '$total_hari', '', 
 '$lebaran_tahun', '$reason', '', '0', '0000-00-00 00:00:00', '120000010',
 '1', '$expire_paslibur', '', '0', '$expire_paslibur', '120000010', '1', '$expire_paslibur', '122050008', '0', '$expire_paslibur', 
 '108000010', '1', '$expire_paslibur', '108000010', '1', '$expire_paslibur', '108000010', '1', '$expire_paslibur', '', '')"; */
 
 $sql_ct = "INSERT INTO `cutibersama_temp` (`id_cbtem`, `nama_bersama`, `cuti_tahun`,cbersama_tahun, `nik`, `sisa_cuti`, `tag`,tag2, `total_cutibersama`, saldo, detail_tanggal) 
 VALUES (NULL, '$reason $lebaran_tahun', '$lebaran_tahun', '$tahun_cbersama','$nik', '0', '$cuti_stahun$nik','Abnormal', '$total_hari','$saldo_cuti2','$detail_tanggal')";
  
if ($conn->query($sql_ct) === TRUE) {
  //echo "normal";
}
 
                                   }
                                  
              
                         
 						
	}
} else {
  echo "0 results";
}

?> 
 
<?php 

 

$sql = "SELECT `id_cbtem`, nama_lengkap, `nama_bersama`, `cuti_tahun`, cutibersama_temp.nik, `sisa_cuti`, tag, tag2,  `total_cutibersama`, `saldo` 
        FROM `cutibersama_temp`
        INNER JOIN user
ON cutibersama_temp.nik = user.nik ORDER BY nama_lengkap ASC;
        
        ";
$result = $conn->query($sql);
 //var_dump($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $no =1;
  while($row = $result->fetch_assoc()) {
        $nama_bersama = $row['nama_bersama'];
         $nama_lengkap = $row['nama_lengkap'];
        $nik = $row['nik'];
        $tag = $row['tag'];
   $cuti_tahuns = $row['cuti_tahun'];
   $sisa_cuti = $row['sisa_cuti'];
   $total_cutibersama = $row['total_cutibersama'];
    $saldo = $row['saldo'];
    $tag2 = $row['tag2'];
    if(($saldo<0)&&($tag2=="Normal"))
        {
            
            // Hitung cuti normal tapi minus
                         $next1 = $cuti_tahuns +1;                         
                         $sql_next1 = " SELECT SUM(total_hari) as sisa FROM `tr_cuti` WHERE cuti_tahun='$next1' AND nik='$nik' AND kode_jcuti='CT12'";
                         $result_next1 = $conn->query($sql_next1);
                         $row_next1 = $result_next1->fetch_assoc();
                         $sisa_next1 = $row_next1['sisa'];
                         
    $jmlcuti_ext = "SELECT  `id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, `ket` 
                FROM `cuti_lahir` 
                WHERE nik='$nik'  AND tahun='$next1' limit 0,1 "; 
    $result_ext = $conn->query($jmlcuti_ext);
 
      if ($result_ext->num_rows > 0) {
    // output data of each row
        while($row_ext = $result_ext->fetch_assoc()) {
            
            $jumlah_cext=$row_ext['jumlah'];
            
            
        }}
                         
                         $saldo_next1 = $jumlah_cext-$sisa_next1;
                         $extend_saldo = $sisa_next1-$saldo;
                         
$split = explode("-", $saldo);
$split_cbersama = $split[1];
        $blc = "Normal tapi minus $next1";
        // Query insert untuk pemohon minus
        $sql_extendminus = "INSERT INTO `cutibersama_temp` (`id_cbtem`, `nama_bersama`, `cuti_tahun`, cbersama_tahun,`nik`, `sisa_cuti`, `tag`, tag2,`total_cutibersama`, saldo) 
                                         VALUES (NULL, '$reason $lebaran_tahun', '$tahun_cbersama','$tahun_cbersama', '$nik', '$saldo_next1', '$next1$nik','Extend Minus', '$split_cbersama','ext_minus')";
                                 
    
    }
    else{
        $blc = $saldo;
         $sql_extendminus = "";
   
    }
    
                                        if ($conn->query($sql_extendminus) === TRUE) {
                                        //  echo "abnormal";
                                        }
                                       // var_dump($sql_extendminus);

 
   $no++;
  }
} else {
  echo "0 results";
}  
$conn->close();
?>
                        
  
<style>
/* HTML:  */
.loader {
  width: 40px;
  aspect-ratio: 1;
  display: grid;
}
.loader::before,
.loader::after {
  content: "";
  grid-area: 1/1;
  --c:no-repeat linear-gradient(#046D8B 0 0);
  background:
    var(--c) 0 0,
    var(--c) 100% 0,
    var(--c) 100% 100%,
    var(--c) 0 100%;
  animation: 
    l10-1 2s infinite linear,
    l10-2 2s infinite linear;
}
.loader::after {
  margin: 25%;
  transform: scale(-1);
}
@keyframes l10-1 {
  0%   {background-size: 0    4px,4px 0   ,0    4px,4px 0   }
  12.5%{background-size: 100% 4px,4px 0   ,0    4px,4px 0   }
  25%  {background-size: 100% 4px,4px 100%,0    4px,4px 0   }
  37.5%{background-size: 100% 4px,4px 100%,100% 4px,4px 0   }
  45%,
  55%  {background-size: 100% 4px,4px 100%,100% 4px,4px 100%}
  62.5%{background-size: 0    4px,4px 100%,100% 4px,4px 100%}
  75%  {background-size: 0    4px,4px 0   ,100% 4px,4px 100%}
  87.5%{background-size: 0    4px,4px 0   ,0    4px,4px 100%}
  100% {background-size: 0    4px,4px 0   ,0    4px,4px 0   }
}

@keyframes l10-2 {
  0%,49.9%{background-position: 0 0   ,100% 0   ,100% 100%,0 100%}
  50%,100%{background-position: 100% 0,100% 100%,0    100%,0 0   }
}
</style><center><br><br><br>
<p>Waiting fo Generate ...</p> <?php echo "<button type='button' class='btn btn-info'>$lokasi_karyawan</button> ";?>
<br><br>
<div class="loader"> </div>
<meta http-equiv="refresh" content="7; url='cbready_process.php'" />
														
  
 
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
				     "pageLength": 100,
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null, null,null,
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

