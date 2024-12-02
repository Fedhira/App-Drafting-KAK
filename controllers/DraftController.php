<?php
require __DIR__ . '/../database/config.php';

// Ambil parameter filter dari GET request
$fromDate = isset($_GET['fromDate']) && !empty($_GET['fromDate']) ? $_GET['fromDate'] : null;
$toDate = isset($_GET['toDate']) && !empty($_GET['toDate']) ? $_GET['toDate'] : null;

// Base query
$query = "
SELECT 
    kak.kak_id,
    kak.no_doc_mak,
    kak.judul,
    kategori_program.nama_divisi AS kategori_program,
    kak.status,
    kak.created_at AS tanggal_dibuat,
    kak.updated_at AS tanggal_diperbarui
FROM 
    kak
LEFT JOIN 
    kategori_program
ON 
    kak.kategori_id = kategori_program.kategori_id
WHERE 
    kak.status IN ('pending', 'disetujui', 'ditolak')
";

// Tambahkan filter tanggal jika tersedia
if ($fromDate && $toDate) {
    $query .= " AND DATE(kak.created_at) BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $fromDate, $toDate);
} else {
    $stmt = $koneksi->prepare($query);
}

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $koneksi->error);
}
