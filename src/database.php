<?php
// src/database.php

// [BUG] Kredensial koneksi rentan dan mode Exception (try-catch) belum diaktifkan!
// Asesi harus menambahkan baris setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new PDO('sqlite:pendaftaran.sqlite');

?>