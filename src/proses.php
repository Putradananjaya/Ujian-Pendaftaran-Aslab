<?php
// src/proses.php
require 'database.php';

// [BUG 1: ALGORITMA] Tidak ada validasi. Jika user submit form kosong, program akan tetap lanjut dan error.
$nama_mahasiswa = $_POST['nama_mahasiswa'];
$nim = $_POST['nim'];
$id_matkul = $_POST['id_matkul'];

// [BUG 2: SQL INJECTION] Parameter dari user langsung digabung ke dalam string SQL!
// Asesi wajib mengubahnya menjadi Prepared Statement (menggunakan ? atau :nama_parameter).
$sql = "INSERT INTO calon_aslab (nama_mahasiswa, nim, id_matkul) VALUES ('$nama_mahasiswa', '$nim', '$id_matkul')";

// Mengeksekusi kueri kotor
$db->exec($sql);

// Redirect kembali ke halaman utama
header("Location: index.php");
exit;
?>