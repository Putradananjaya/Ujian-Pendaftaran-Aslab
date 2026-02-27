<?php
// src/index.php
require 'database.php';

// [BUG 1: PROFILING] Asesi harus menambahkan fungsi microtime(true) di awal dan akhir file 
// untuk mengukur berapa detik halaman ini dimuat sebelum dan sesudah diperbaiki.

// Ambil semua data pendaftar
$query_utama = $db->query("SELECT * FROM calon_aslab");
$data_utama = $query_utama->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Asisten Laboratorium</title>
</head>
<body>
    <h1>Form Pendaftaran Asisten Laboratorium (Aslab)</h1>
    
    <form action="proses.php" method="POST">
        <input type="text" name="nama_mahasiswa" placeholder="Nama Lengkap Asesi"><br><br>
        <input type="text" name="nim" placeholder="NIM"><br><br>
        <select name="id_matkul">
            <option value="1">R Programming</option>
            <option value="2">Cyber Security</option>
            <option value="3">Mobile Programming</option>
            <option value="4">Business Intelligence</option>
        </select><br><br>
        <button type="submit">Daftar Menjadi Aslab</button>
    </form>
    
    <hr>
    
    <h2>Daftar Antrean Calon Aslab (5.000+ Data)</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Mata Kuliah Pilihan</th>
        </tr>
        <?php
        foreach ($data_utama as $row) {
            $id_matkul = $row['id_matkul'];
            
            // [BUG 2: SKALABILITAS / N+1 QUERY] 
            // Kueri SQL di dalam looping! Jika ada 5000 pendaftar, maka akan ada 5000 kueri dieksekusi ke database.
            // Asesi wajib menghapus baris ini dan menggunakan fitur JOIN pada $query_utama di atas.
            $query_relasi = $db->query("SELECT nama_matkul FROM mata_kuliah WHERE id = $id_matkul");
            $relasi = $query_relasi->fetch();

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama_mahasiswa'] . "</td>";
            echo "<td>" . $row['nim'] . "</td>";
            echo "<td>" . $relasi['nama_matkul'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>