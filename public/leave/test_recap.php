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
	$niks = $_SESSION['nik'];

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
                  <p class="card-title mb-0">DAFTAR HAK CUTI YANG LAHIR </p>
                  <div class="table-responsive">
                     <table id="dynamic-table"  border="1" style='border: 1px solid #fff; font-family: sans-serif; color: #232323;  border-collapse: collapse;
					} '>
                        <thead>
                        <tr style='background: #35A9DB;color:#fff;font-weight:normal;'>
                          <th>&nbsp;No&nbsp;&nbsp;</th>
                          <th>&nbsp;Nama&nbsp;Lengkap&nbsp;Karyawan</th>
                          <th>&nbsp;NIK&nbsp;</th>
                          <th>&nbsp;Jenis Cuti&nbsp;</th>
                          <th>&nbsp;Tahun&nbsp;</th>
                          <th>&nbsp;Lahir&nbsp;Cuti&nbsp;</th>
                          <th>&nbsp;Exp&nbsp;Cuti&nbsp;</th>
                          <th>&nbsp;Keterangan&nbsp;</th>
                            <th>&nbsp;Edit&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

$sql = "DELETE FROM table_balance_recap WHERE balance_year IN ('2023','2024')";
$sql = "DELETE FROM table_balance_transaction WHERE balance_year IN ('2023','2024')";
  $conn->query($sql);

 $sql = "SELECT `id_ctahunan`, `nama_cuti`,nama_lengkap, cuti_lahir.nik, `tahun`,
				`jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, cuti_lahir.ket
		 FROM `cuti_lahir`
		 INNER JOIN jenis_cuti ON cuti_lahir.kode_jcuti=jenis_cuti.kode_jcuti
		 INNER JOIN user ON cuti_lahir.nik=user.nik
		 WHERE cuti_lahir.tahun IN ('2023','2024') ORDER BY cuti_lahir.nik asc, cuti_lahir.tahun ASC
		 ";
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
	  $id_ctahunan = $row['id_ctahunan'];
	  $nama_cuti = $row['nama_cuti'];
	  $nama_lengkap = $row['nama_lengkap'];
	  $nm_kecil = strtolower($nama_lengkap);
	  $nmt_new = ucwords($nm_kecil);

	  $nik = $row['nik'];
	  $tahun = $row['tahun'];

	  $jumlah = $row['jumlah'];
	  $lahir_cuti = $row['lahir_cuti'];
	  $lhr_cuti = date('d M Y', strtotime($lahir_cuti));
	  $exp_cuti = $row['exp_cuti'];
	  $expired_cuti = date('d M Y', strtotime($exp_cuti));

	 if(strtotime($row['exp_cuti']) > 0){
     $showexpcuti=$expired_cuti;
 }else{
     $showexpcuti="<center><img src='images/tthinggas.png' width='60' height='20'>";
 }

	  $tag = $row['tag'];
	  $kete = $row['ket'];
      $ket = substr($kete,-4);


 // hitung jumlah cuti yang diambil dalam tahun yang sama

$sql_hitung = "SELECT  sum(total_hari)as total_ambil FROM `tr_cuti`
                WHERE cuti_tahun='$tahun' AND nik='$nik' and kode_jcuti='CT12'";
$result_hitung = $conn->query($sql_hitung);
//var_dump($sql_hitung);
if ($result_hitung->num_rows > 0) {
  // output data of each row
  while($row_hitung = $result_hitung->fetch_assoc()) {
      $total_ambil = $row_hitung['total_ambil'];
    //echo " $jml_ct <br>";
  }
	$endingBalance = $jumlah - $total_ambil;
	$status = $exp_cuti >= date('Y-m-d') ? 'ACTIVE' : 'EXPIRED';
	$sqlInsertRecap = "INSERT INTO table_balance_recap (id_ctahunan, nik, employee_name, balance_year, balance_created_at, balance_expired_at, beginning_balance, used_balance, ending_balance, status) VALUES('$id_ctahunan', '$nik', '$nmt_new', '$tahun', '$lahir_cuti', '$exp_cuti', '$jumlah', '$total_ambil', '$endingBalance', '$status')";
	$conn->query($sqlInsertRecap);

	$sqlTransaction = "SELECT id_trcuti, tgl_pengajuan, detail_tanggal, total_hari, cuti_tahun FROM `tr_cuti` WHERE cuti_tahun='$tahun' AND nik='$nik' and kode_jcuti='CT12' ORDER BY nik ASC, cuti_tahun ASC";
	$getTransaction = $conn->query($sqlTransaction);
	while($rowTransaction = $getTransaction->fetch_assoc()) {
		$id_trcuti = $rowTransaction['id_trcuti'];
		$total_hari = $rowTransaction['total_hari'];
		$detail_tanggal = $rowTransaction['detail_tanggal'];
		$tgl_pengajuan = $rowTransaction['tgl_pengajuan'];

		$sqlInsertTr = "INSERT INTO table_balance_transaction (id_tr_cuti, nik, employee_name, balance_use, balance_year, detail_date, submitted_at) VALUES ('$id_trcuti', '$nik', '$nmt_new', '$total_hari', '$tahun', '$detail_tanggal', '$tgl_pengajuan')";
		$conn->query($sqlInsertTr);

	}

}

	echo "<tr bgcolor='$warna'>
			<td><font style='font-size:12px'>$no</font></td>
			<td><font style='font-size:12px'>$nmt_new</font></td>
			<td><font style='font-size:12px'>$nik</font></td>
			<td><font style='font-size:12px'>$nama_cuti ($jumlah), Used ($total_ambil)</font></td>
			<td><font style='font-size:12px'><center>$tahun</center></font></td>
			<td><font style='font-size:12px'><center>$lhr_cuti</center></font></td>
			<td><font style='font-size:12px'><center>$showexpcuti</center></font></td>
			<td><font style='font-size:12px'>$ket</font></td>
			<td><a href='edit_jmlcuti.php?id=$id_ctahunan'>
			<img src='images/edit.png'  width='20px' height='20px' title='edit'>
			<font style='font-size:10px'>Edit</font></a></td>
		</tr>";
		$no++;
  }
}


 else {
  echo "0 results";
}


?>

 </tbody>
                    </table>


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
					  null, { "bSortable": false },null, null, null,  { "bSortable": false }, { "bSortable": false },
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

