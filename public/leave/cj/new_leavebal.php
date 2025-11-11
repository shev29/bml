

 <?php
$servername = "localhost";
$userdb = "u7195330_bmladmin";
$password = "BML@P@ssww0rd@MySQL";
$dbname = "u7195330_bmlleave";
 


// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Jakarta');
    $nowdate = date("Y");
    $minusnowdate = $nowdate-1;
     $fulldate = date("m-d");
     $tgllahir_cuti = date("Y-m-d");
                $ket = "Post leave balance from system";
                 
                $tgl_lcuti = date("Y-m-d", strtotime($tgllahir_cuti)); 
                $effectiveDate = date('Y-m-d', strtotime("+18 months", strtotime($tgl_lcuti)));
                $thn_ambil = date("Y", strtotime($tgllahir_cuti)); 
                 

					
					 $sql = "SELECT `id_user`, `nama_lengkap`, `nik` FROM `user`					 
							WHERE hire_date like'%$fulldate%'
							ORDER BY nama_lengkap ASC";
					$result = $conn->query($sql);
                    //var_dump($sql);
					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  $id_user = $row["id_user"];
						  $nama_lengkap = $row["nama_lengkap"];
						  $nik = $row["nik"];						 
							$nm_kecil = strtolower($nama_lengkap);
						  $nmt_new = ucwords($nm_kecil);			 
						 /* $ket_kecil = strtolower($ket);
						  $ket_new = ucwords($ket_kecil); */
                 $sqlrt = "INSERT INTO `cuti_lahir` (`id_ctahunan`, `kode_jcuti`, `nik`, `tahun`, `jumlah`, `lahir_cuti`, `exp_cuti`, `tag`, ket, sequence) 
                 VALUES (NULL, 'CT12', '$nik', '$thn_ambil', '12', '$tgl_lcuti', '$effectiveDate', '12', '$ket', '$thn_ambil$nik')";
                 //var_dump($sqlrt);
                 
                if ($conn->query($sqlrt) === TRUE) {
                  
                }   						  
						  
					 // echo " $nik $nama_lengkap";
					  }
					} else {
					  echo "0 results";
					}
 
                


                 //echo"$nama, $nik, $hire_date, $kode_loc, $kode_dep, $atasan_nik, $username, $password, $level, $email, $email2 ";
                

  

            $conn->close();
?>