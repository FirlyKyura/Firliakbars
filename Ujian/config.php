<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "Ujian_firliakbarsuryontoko";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>