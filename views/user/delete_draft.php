<?php
// Konfigurasi database
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';

// Validasi apakah parameter `kak_id` diterima
if (isset($_GET['kak_id']) && is_numeric($_GET['kak_id'])) {
    $kak_id = $_GET['kak_id'];

    // Query untuk menghapus data berdasarkan kak_id
    $query = "DELETE FROM kak WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman draft.php
        header("Location: draft.php?msg=deleted");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error deleting data: " . $stmt->error;
    }
} else {
    // Jika `kak_id` tidak valid, tampilkan pesan error
    echo "Invalid ID provided.";
}
