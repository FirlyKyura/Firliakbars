<?php
require_once 'config.php';


if (!isset($conn)) {
    die("Koneksi database tidak tersedia");
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
$nis = mysqli_real_escape_string($conn, $_POST['nis']);
$kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);


if (empty($nama_lengkap) || empty($nis) || empty($kelas) || empty($jurusan)) {
    header("Location: index.php?message=Semua field harus diisi!");
    exit();
}

if (!empty($id)) {
    
    $sql = "UPDATE Siswa SET 
            nama_lengkap = '$nama_lengkap',
            nis = '$nis',
            kelas = '$kelas',
            jurusan = '$jurusan'
            WHERE id = $id";
    $action = "diupdate";
} else {

    $check_sql = "SELECT id FROM Siswa WHERE nis = '$nis'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: index.php?message=NIS sudah terdaftar!");
        exit();
    }
    
   
    $sql = "INSERT INTO Siswa (nama_lengkap, nis, kelas, jurusan) 
            VALUES ('$nama_lengkap', '$nis', '$kelas', '$jurusan')";
    $action = "disimpan";
}


if (mysqli_query($conn, $sql)) {
    header("Location: index.php?message=Data berhasil $action!");
} else {
    header("Location: index.php?message=Error: " . urlencode(mysqli_error($conn)));
}

mysqli_close($conn);
?>