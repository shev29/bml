<?php 
error_reporting(0);
include "assets/configure/sesionadmin.php";
?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<fieldset>
<legend>Import data User / Employee</legend>
<form method="post" enctype="multipart/form-data" action="proses.php">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
</fieldset>
</body>
</html>