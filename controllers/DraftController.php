<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../database/config.php';

// Get the date filter parameters from the GET request
$fromDate = isset($_GET['fromDate']) && !empty($_GET['fromDate']) ? $_GET['fromDate'] : null;
$toDate = isset($_GET['toDate']) && !empty($_GET['toDate']) ? $_GET['toDate'] : null;

// Base query for fetching data from the kak table
$query = "SELECT 
            kak.no_doc_mak, 
            kak.judul, 
            kategori_program.nama_divisi AS kategori_program, 
            kak.status, 
            DATE_FORMAT(kak.created_at, '%d-%m-%Y') AS tanggal_dibuat, 
            DATE_FORMAT(kak.updated_at, '%d-%m-%Y') AS tanggal_diperbarui
          FROM kak
          LEFT JOIN kategori_program ON kak.kategori_id = kategori_program.kategori_id";

// Add date filtering if both `fromDate` and `toDate` are provided
if ($fromDate && $toDate) {
    $query .= " WHERE DATE(kak.created_at) BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $fromDate, $toDate);
} else {
    $stmt = $koneksi->prepare($query); // No filter applied, fetch all data
}

$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
