 <?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level_akses']==""){
		header("location:../index.php?Pesan=Maaf anda harus login admin!");
	}
	elseif($_SESSION['level_akses']!="admin"){
		header("location:../index.php?Pesan=Maaf anda harus login admin!");
	}
	$level = $_SESSION['level_akses'];
	$nama = $_SESSION['nama']	
	
?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<fieldset>
<legend>Form Upload Excel</legend>
<form method="post" enctype="multipart/form-data" action="p_update.php">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
</fieldset>
</body>
</html>