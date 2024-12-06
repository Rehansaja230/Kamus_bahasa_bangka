<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'kamus_bangka_v2'; // Nama database baru

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error); 
}
?>