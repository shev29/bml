<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";

?>
 
 <!-- form -->
           <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
<?php 
include "assets/configure/koneksi.php";  
///`id_dep`, `kode_dep`, `nama_dep`, `ket
$id_trcuti = $_POST['id_trcuti'];
$total_hari = $_POST['total_hari']; 
$kode_jcuti = $_POST['kode_jcuti'];
$detail_tanggal = $_POST['detail_tanggal']; 
		$tgl_awalc = substr($detail_tanggal, 0, 10);
		$newtgl_awalc = date("Y-m-d", strtotime($tgl_awalc));
		$tgl_akhir = substr($detail_tanggal, -10);
		$newtgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
$cuti_tahun = $_POST['cuti_tahun'];		
		
$sql = "UPDATE tr_cuti SET detail_tanggal='$detail_tanggal',tgl_awalc='$newtgl_awalc', tgl_akhir='$newtgl_akhir',kode_jcuti='$kode_jcuti', cuti_tahun='$cuti_tahun',  total_hari='$total_hari' WHERE id_trcuti ='$id_trcuti'";
 //var_dump($sql);
   if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Update Leave request successfuly');
    window.location.href='track_cuti.php';
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

