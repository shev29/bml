<?php
    include "../assets/vendor/configure/koneksi.php";
    $response = [];
    $sql = 'SELECT id_alamat, nama_perusahaan, dtl_alamat FROM courierm_alamat WHERE nama_perusahaan LIKE "%'.$_GET['term'].'%"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response[] = [
                            'id' => $row['id_alamat'],
                            'text' => $row['nama_perusahaan'].' - '.$row['dtl_alamat'],
                        ];
        }
    }

    echo json_encode($response);
?>