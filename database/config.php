<?php
// Check if a session is already active before starting a new one
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost:3307';
$nama = 'root';
$pass = '';
$db = 'drafting';

$koneksi = mysqli_connect($host, $nama, $pass, $db);

// Check connection
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
