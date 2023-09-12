<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the nis already exists in the database
    $nis = $_POST['nis'];
    $existingQuery = mysqli_query($db, "SELECT nis FROM t_siswa WHERE nis = '$nis'");
    
    if (mysqli_num_rows($existingQuery) > 0) {
        // Handle duplicate 'nis' value
        header('Location: index.php?status=duplicate');
    } else {
        // Continue with the insert query
        $nama = $_POST['nama_lengkap'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jenis_kelamin'];
        $no_telp = $_POST['no_telp'];
        $kelas = $_POST['kelas'];

        $sql = "INSERT INTO t_siswa(nis, nama_lengkap, alamat, jenis_kelamin, no_telp, kelas)
        VALUES('$nis','$nama','$alamat','$jk','$no_telp','$kelas')";
        
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));

        if ($query) {
            header('Location: index.php?status=sukses');
        } else {
            header('Location: index.php?status=gagal');
        }
    }
} else {
    die("Akses dilarang ...");
}

?>