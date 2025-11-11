 <?php
include "assets/configure/sesionadmin.php"; 
?> 
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "assets/template/headform.php"; ?>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html atas lebih pouler disebut toolbar -->
<?php include "assets/template/navbar.php";
     
include "assets/configure/koneksi.php";  

					?>
  
	
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
 
 
      <!-- partial:partials/_sidebar.html -->
 
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

 <?php //include "assets/template/rowwelcome.php"; ?>

 
 <!-- form -->	
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card"> 
              <div class="card">
                  <?php
                $id_trcuti = $_GET['id'];  
                ?>
                <center><h4>Confirmation</h4><br></center> 
                <center><br>
                
                <label>Employee leave request rejected, please input the reason.</label>
                <br><label>Permohonan cuti ditolak, silahkan input alasan.</label>
                <br><br> 
                <form method='get' action='delete_check.php'>
                    <table border='0'>
                            <tr>
                                <td><input type='hidden' name='id_trcuti' value='<?php echo $id_trcuti;?>'>Reason</td>
                                <td>
                                    <div class="col-sm-19">
                                        <input type='text' name='reason' value=''  class="form-control" > 
                                    </div>
                                    
                                    
                                    </td>
                            </tr>
                            
                            <tr>
                                <td><br>Keep Reject</td><td></td>
                            </tr>
                            <tr>
                                <td></td><td><br><input type='submit'  class='btn btn-info' value='Yes'></td><td></td></form>
                            </tr> 
                            <tr> 
                                <td></td><td><br><a href='hrga_app.php'><label class="badge badge-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></a></td> </td>
                            </tr> 
                    <table>
                
                

          </div>
          </div>
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
<?php include"assets/template/footerjs.php";?>

</body>

</html>

