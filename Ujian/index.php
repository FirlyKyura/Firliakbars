<?php
require_once 'config.php';

$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian_firliakbarsuryontoko</title>
</head>
<body>
    <?php if($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>
    
    <h2>Form Data Siswa</h2>
    <form action="save.php" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
        
        <div>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_lengkap" required value="<?php echo isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : ''; ?>">
        </div>
        <br>
        
        <div>
            <label>NIS:</label><br>
            <input type="text" name="nis" required value="<?php echo isset($_GET['nis']) ? htmlspecialchars($_GET['nis']) : ''; ?>">
        </div>
        <br>
        
        <div>
            <label>Kelas:</label><br>
            <input type="text" name="kelas" required value="<?php echo isset($_GET['kelas']) ? htmlspecialchars($_GET['kelas']) : ''; ?>">
        </div>
        <br>
        
        <div>
            <label>Jurusan:</label><br>
            <select name="jurusan" required>
                <option value="">Pilih Jurusan</option>
                <option value="PPLG" <?php echo (isset($_GET['jurusan']) && $_GET['jurusan'] == 'PPLG') ? 'selected' : ''; ?>>PPLG</option>
                <option value="TJKT" <?php echo (isset($_GET['jurusan']) && $_GET['jurusan'] == 'TJKT') ? 'selected' : ''; ?>>TJKT</option>
                <option value="DKV" <?php echo (isset($_GET['jurusan']) && $_GET['jurusan'] == 'DKV') ? 'selected' : ''; ?>>DKV</option>
                <option value="Pemasaran" <?php echo (isset($_GET['jurusan']) && $_GET['jurusan'] == 'Pemasaran') ? 'selected' : ''; ?>>Pemasaran</option>
                <option value="Perhotelan" <?php echo (isset($_GET['jurusan']) && $_GET['jurusan'] == 'Perhotelan') ? 'selected' : ''; ?>>Perhotelan</option>
            </select>
        </div>
        <br>
        
        <button type="submit">
            <?php echo isset($_GET['edit']) ? 'Update Data' : 'Simpan Data'; ?>
        </button>
        
        <?php if(isset($_GET['edit'])): ?>
            <a href="index.php"><button type="button">Batal Edit</button></a>
        <?php endif; ?>
    </form>
    
    <hr>
    
    <h2>Data Siswa</h2>
    
    <?php

    if (!isset($conn)) {
        die("Koneksi database tidak tersedia");
    }
    
    $sql = "SELECT * FROM Siswa ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        die("Error dalam query: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) > 0):
    ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($row['nis']); ?></td>
            <td><?php echo htmlspecialchars($row['kelas']); ?></td>
            <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">
                    <button type="button">Edit</button>
                </a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <button type="button">Delete</button>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>Tidak ada data siswa.</p>
    <?php endif; ?>
    
    <?php mysqli_close($conn); ?>
</body>
</html>