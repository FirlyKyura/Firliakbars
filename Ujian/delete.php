<?php
require_once 'config.php';

if (!isset($conn)) {
    die("Koneksi database tidak tersedia");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "DELETE FROM Siswa WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?message=Data berhasil dihapus!");
    } else {
        header("Location: index.php?message=Error: " . urlencode(mysqli_error($conn)));
    }
} else {
    header("Location: index.php?message=ID tidak valid!");
}

mysqli_close($conn);
?>