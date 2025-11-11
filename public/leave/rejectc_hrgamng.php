<?php 
error_reporting(0);
include "../assets/configure/sesion.php";
?>
  
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
<?php 
include "assets/configure/koneksi.php";  

$id_trcuti = $_GET['id'];  
$halaman = $_GET['halaman']; 
$sql = "Delete from tr_cuti where id_trcuti='$id_trcuti'";
if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Reject data cuti berhasil');
    window.location.href='view_app.php?halaman=$halaman';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} 
 //---------------------------- end upload
?>
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

