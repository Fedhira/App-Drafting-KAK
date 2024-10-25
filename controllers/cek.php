<?php
session_start();

// Jika belum login, redirect ke login
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'True') {
    header('Location: ./login.php'); // Arahkan ke halaman login
    exit();
}
