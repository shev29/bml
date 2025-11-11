<?php 
error_reporting(0);
include "../assets/configure/sesionadmin.php";
 
include "assets/configure/koneksi.php";  

$id_trcuti = $_GET['id_trcuti'];  
$reason = $_GET['reason'];  
$namas = $_SESSION['nama']; 
$nikso = $_SESSION['nik'];

$sqlz = "SELECT `id_trcuti`, (tr_cuti.nik)as nik_pemohon, nama_lengkap,tr_cuti.kode_jcuti, jenis_cuti.nama_cuti, 
 `tgl_pengajuan`, `tgl_awalc`, `tgl_akhir`, `detail_tanggal`, `total_hari`, 
 `cuti_tahun`, `alasan`,`nik_sleader`, `status_sleader`, `tgl_appsleader`,
 `nik_check1`, `status_check1`, `tgl_check1`, `nik_check2`, `status_check2`, 
 `tgl_check2`, `nik_approve1`, `status_approve1`, `tgl_approve1`, `nik_approve2`,
 `status_approve2`, `tgl_approve2`, 
 `nik_hrgas`,(select nama_lengkap from user where nik=nik_hrgas)as nm_hrgastaf,
 `app_hrgas`, `tgl_apphrgas`,
 `nik_hrgaspv`, `app_hrgaspv`, `tgl_apphrgaspv`,
 (select nama_lengkap from user where nik=nik_hrgaspv)as nm_hrgaspv,
 `nik_hrgamng`, `app_hrgamng`,
  (select nama_lengkap from user where nik=nik_hrgamng)as nm_hrgamng,
 `tgl_apphrgamng`,  tr_cuti.ket,
 tr_cuti.ket2, user.kode_loc, user.kode_section FROM `tr_cuti` 
 INNER JOIN user ON tr_cuti.nik = user.nik 
 INNER JOIN jenis_cuti ON tr_cuti.kode_jcuti = jenis_cuti.kode_jcuti 
 WHERE  id_trcuti='$id_trcuti'";
$resultz = $conn->query($sqlz);
while($rowz = $resultz->fetch_assoc()) {
     $id = $id_trcuti;
     $nik_pemohon = $rowz['nik_pemohon'];
     $nama_lengkap = $rowz['nama_lengkap'];
     $nama_cuti = $rowz['nama_cuti'];
     $kode_jcuti = $rowz['kode_jcuti'];
     $tgl_pengajuan = $rowz['tgl_pengajuan'];
     $detail_tanggal = $rowz['detail_tanggal'];
     $total_hari = $rowz['total_hari'];
     $tgl_pengajuan = $rowz['tgl_pengajuan'];
  } 
  
  $sql2 = "INSERT INTO `log_tcuti` (`id_logtcuti`, `id_trcuti`, `nik_atasan`, `nama_atasan`, `field`, `kode_jcuti`,
            `tgl_pengajuan`, `detail_tanggal`, `total_hari`, `action`, `reason`, `nik_pemohon`,nama_pemohon, `ket`) 
            VALUES ('', '$id', '$nikso', '$namas', '$kode_jcuti', '$nama_cuti', '$tgl_pengajuan', '$detail_tanggal', '$total_hari', 'Delete Approved', '$reason', '$nik_pemohon','$nama_lengkap', 'Delete Lev 2')";
var_dump($sql2);

if ($conn->query($sql2) === TRUE) {
  echo "New record created successfully";
}
  
 $sql = "Delete from tr_cuti where id_trcuti='$id_trcuti'";
if ($conn->query($sql) === TRUE) {
  echo ("<script LANGUAGE='JavaScript'>
    window.alert('Reject data cuti berhasil');
    window.location.href='view_app.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} 
   
//var_dump($sqlz);
//echo $reason; echo $id_trcuti;


 //---------------------------- end upload
?>