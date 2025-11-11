<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Courier System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Dropzone -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "../assets/vendor/menu_admin/navbar.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include "../assets/vendor/menu_admin/logo.php"; ?>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gambar/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>
      <?php include "../assets/vendor/menu_admin/sidebar.php"; ?>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Address Data Master</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">
                Zoom:
                <input type="button" value="150%" onclick="document.body.style.zoom='150%'">
                <input type="button" value="100%" onclick="document.body.style.zoom='100%'">
                <input type="button" value="90%" onclick="document.body.style.zoom='90%'">
                <input type="button" value="80%" onclick="document.body.style.zoom='80%'">
                <input type="button" value="70%" onclick="document.body.style.zoom='70%'">
              </li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <form method="post" action="post_alamat.php">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Input Form</h3></div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan" value="">
                  </div>
                  <div class="form-group">
                    <label>Detail Alamat</label>
                    <textarea class="form-control" rows="3" name="dtl_alamat" placeholder="..."></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" class="form-control" name="kode_pos">
                  </div>
                  <div class="form-group">
                    <label>Map</label>
                    <input type="text" class="form-control" name="map">
                  </div>

                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control select2bs4" name="kota" style="width: 100%;">
                      <option>---- Choose City ----</option>
                      <?php 
                        include "../assets/vendor/configure/koneksi.php"; 
                        $sql = "SELECT id_kota, nama_kota FROM courierm_kota";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='{$row['id_kota']}'>{$row['nama_kota']}</option>";
                        }
                        $conn->close();
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Province</label>
                    <select class="form-control select2bs4" name="provinsi" style="width: 100%;">
                      <option>---- Choose Province ----</option>
                      <?php 
                        include "../assets/vendor/configure/koneksi.php"; 
                        $sql = "SELECT id_prov, nama_provinsi FROM courierm_provinsi";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='{$row['id_prov']}'>{$row['nama_provinsi']}</option>";
                        }
                        $conn->close();
                      ?>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col -->
          </div> <!-- /.row -->
        </form>
      </div> <!-- /.container-fluid -->
    </section>
  </div> <!-- /.content-wrapper -->

</div> <!-- /.wrapper -->

<!-- Scripts (jQuery, Bootstrap, AdminLTE, etc.) -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
