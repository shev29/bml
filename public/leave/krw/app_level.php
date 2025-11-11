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
 <h5>Approval Master</h5><br>
           <div class="row"> 
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> 
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css" /> 

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
 

<table id="example" class="table table-striped table-bordered" style="width:100%">                   <thead>
                        <tr style='background: #35A9DB;color:#fff;font-weight:normal;'>
						
                          <th>Prepared</th>
                          <th>Loc/Section</th>
                          <th>Shift Leader </th>
                          <th>Check 1</th>
                          <th>Check 2</th>
                          <th>App 1</th>
                          <th>App 2</th> 
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
<?php   include "assets/configure/koneksi.php"; 
$sql = " SELECT `id_app`, user.nik,nama_lengkap,kode_loc,kode_section, `tl_checker`, `check_1`, `check_2`, `approve_1`, `approve_2`,
`hrga_staff1`, `hrga_staff2`, `hrga_spv`, `hrga_mng`, 
(select nama_lengkap from user where nik=tl_checker GROUP by id_user) as nm_tl_checker1,
(select nama_lengkap from user where nik=check_1 GROUP by id_user) as nm_check1, 
(select nama_lengkap from user where nik=check_2 GROUP by id_user) as nm_check2, 
(select nama_lengkap from user where nik=approve_1 GROUP by id_user) as nm_app1, 
(select nama_lengkap from user where nik=approve_2 GROUP by id_user) as nm_app2 FROM `app_level` INNER join user on app_level.nik=user.nik GROUP BY nik
		";
$result = $conn->query($sql);
//var_dump($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $id_app = $row['id_app'];
	  $nama_lengkap = $row['nama_lengkap'];
	  	$nml_kecil = strtolower($nama_lengkap);
		$nml_new = ucwords($nml_kecil); 
	  $location = $row['kode_loc'];
	  $kode_section = $row['kode_section'];
	  $tl_checker = $row['tl_checker'];
	  $nm_tl_checker1 = $row['nm_tl_checker1'];
	  
	 //Approval Checks  1a
	  $check_1 = $row['check_1'];
	  $nm_check1 = $row['nm_check1'];
	  	$nm_kecil = strtolower($nm_check1);
		$nmt_new = ucwords($nm_kecil); 
        $pieces = explode(" ", $nmt_new);
        $nm_depan = $pieces[0]; // piece1
        $nm_belakang = $pieces[1]; // piece2
        $nm = ucwords($nm_depan);
        $nmbelakang_alias = substr($nm_belakang,0,1);
        
    //Approval Checks  1b
      $nm_check2 = $row['nm_check2']; 
	  	$nm_kecil2 = strtolower($nm_check2);
		$nmt_new2 = ucwords($nm_kecil2); 
        $pieces2 = explode(" ", $nmt_new2);
        $nm_depan2 = $pieces2[0]; // piece1
        $nm_belakang2 = $pieces2[1]; // piece2
        $nm2 = ucwords($nm_depan);
        $nmbelakang_alias2 = substr($nm_belakang2,0,1);
      
	  $check_2 = $row['check_2'];
	  $approve_1 = $row['approve_1'];
	  $approve_2 = $row['approve_2'];
	  
	  $nm_app1 = $row['nm_app1'];
	  $nm_app2 = $row['nm_app2'];
 
     
  ?>
						<tr> 				  
                          <td><font style='font-size:12px'> <?php echo $nml_new; ?></font></td>
                          <td>			
                    <div class='dropdown'>
                      <button title='Detail' class='btn btn-success btn-sm dropdown-toggle' type='button' 
					  id='dropdownMenuSizeButton2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                
                      </button>
                      <div class='dropdown-menu' aria-labelledby='dropdownMenuSizeButton2'>
                          
						<div class='dropdown-divider'>	</div> 
                        <a class='dropdown-item' href='#'>Loc : <?php echo $location; ?> </a>
						<div class='dropdown-divider'>	</div> 
                        <a class='dropdown-item' href='#'>Section : <?php echo $kode_section; ?></a>
						<div class='dropdown-divider'>	</div> 
                           
                      </div>
                    </div>
                              
                              
                              </td> 
                          <td> <?php echo $nm_tl_checker1; ?></td>
                          
                          <td><font style='font-size:12px'> <?php echo "$nm_depan&nbsp;$nmbelakang_alias"; ?></font></td>
                          <td><font style='font-size:12px'> <?php echo "$nm_depan2 $nmbelakang_alias2"; ?></font></td>
                          <td><font style='font-size:12px'> <?php echo $nm_app1; ?></font></td>
                          <td><font style='font-size:12px'> <?php echo $nm_app2; ?></font></td>
                          
                          <td><font style='font-size:12px'><a href='edit_appmaster.php?id_app=<?php echo $id_app;?>'>Edit</a>  </font></td>
                           
 
                        </tr>
                         
<?php						
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

