<style>

  input[type=submit], input[type=reset] { 
  background-color: #ff0000;
  border-radius:5px;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

<?php 
include "../assets/sesion/sesionadmin.php"; 
$nama_admin = $_SESSION['nama'];
$nikadmin = $_SESSION['nik'];
//echo $nama_admin;
 
 
 error_reporting(0);
include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");
$no_order = $_GET['no_order'];  
$nikpemohon = $_GET['nikp'];
 echo "<center><a href='manage_order.php'><img src='images/bck.png' width='40' height='40'><br>Back</a><br><br>";
 
 
 
echo "<form method='post' action='act_del.php'>"; 
        echo"<label>Are you sure want to delete (Resi No:$no_order) !!</label><br>";
         echo"<label>Please input the reason:</label><br>";
        echo"<input type='hidden' name='nama_admin' value='$nama_admin'>
        <input type='hidden' name='nikpemohon' value='$nikpemohon'>
        <input type='hidden' name='no_order' value='$no_order'>
        <input type='text' name='reason' value=''><br><br>";
        echo"<input type='Submit'   value='Yes Delete it'>";
echo "</form></center>";


