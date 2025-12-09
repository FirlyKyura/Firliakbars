<?php
require_once 'config.php';

if (!isset($conn)) {
    die("Koneksi database tidak tersedia");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    
    $sql = "SELECT * FROM Siswa WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        header("Location: index.php?message=Error query: " . urlencode(mysqli_error($conn)));
        exit();
    }
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        header("Location: index.php?edit=" . $row['id'] . 
               "&nama=" . urlencode($row['nama_lengkap']) . 
               "&nis=" . urlencode($row['nis']) . 
               "&kelas=" . urlencode($row['kelas']) . 
               "&jurusan=" . urlencode($row['jurusan']));
    } else {
        header("Location: index.php?message=Data tidak ditemukan!");
    }
} else {
    header("Location: index.php?message=ID tidak valid!");
}

mysqli_close($conn);
?>