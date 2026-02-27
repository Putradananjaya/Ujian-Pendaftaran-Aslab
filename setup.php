<?php
// setup.php - Eksekusi file ini sekali di terminal: php setup.php
$db = new PDO('sqlite:src/pendaftaran.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Buat Tabel Mata Kuliah dan Calon Aslab
$db->exec("CREATE TABLE IF NOT EXISTS mata_kuliah (id INTEGER PRIMARY KEY AUTOINCREMENT, nama_matkul TEXT)");
$db->exec("CREATE TABLE IF NOT EXISTS calon_aslab (id INTEGER PRIMARY KEY AUTOINCREMENT, nama_mahasiswa TEXT, nim TEXT, id_matkul INTEGER)");

// Masukkan data referensi mata kuliah
$db->exec("INSERT INTO mata_kuliah (nama_matkul) VALUES ('R Programming'), ('Cyber Security'), ('Mobile Programming'), ('Business Intelligence')");

// Masukkan 5.000 data dummy calon aslab untuk mensimulasikan beban server (Skalabilitas)
echo "Sedang men-generate 5.000 data pendaftar dummy...\n";
$db->beginTransaction();
for ($i = 1; $i <= 5000; $i++) {
    $id_matkul = rand(1, 4);
    $db->exec("INSERT INTO calon_aslab (nama_mahasiswa, nim, id_matkul) VALUES ('Mahasiswa Dummy $i', 'NIM2026$i', $id_matkul)");
}
$db->commit();

echo "Setup Selesai! File pendaftaran.sqlite berhasil dibuat di dalam folder src/.";
?>