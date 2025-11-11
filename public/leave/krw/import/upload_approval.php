 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<fieldset>
<legend>Form Upload Approval Master</legend>
<form method="post" enctype="multipart/form-data" action="approval_process.php">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
    </div>
    <input type="submit" class="btn btn-primary" value='Process'> 
</form>
</fieldset>
</body>
</html>