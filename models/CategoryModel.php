<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/controllers/UserController.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori_id = $_POST['kategori_id'];
    $nama_divisi = $_POST['nama_divisi'];
    $status = $_POST['status'];

    // Update kategori di database
    $stmt = $koneksi->prepare("UPDATE kategori_program SET nama_divisi = ?, status = ? WHERE kategori_id = ?");
    $stmt->bind_param("ssi", $nama_divisi, $status, $kategori_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $koneksi->close();
}

function addKategori($koneksi, $nama_divisi, $status)
{
    // Prepare the SQL query to insert a new category
    $stmt = $koneksi->prepare("INSERT INTO kategori_program (nama_divisi, status) VALUES (?, ?)");
    if ($stmt === false) {
        // Jika prepare gagal, tampilkan error
        die('Prepare failed: ' . $koneksi->error);
    }

    $stmt->bind_param("ss", $nama_divisi, $status);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Return true if successful
    } else {
        return false; // Return false if there was an error
    }

    // Close the statement
    $stmt->close();
}

// Fetch available status options from the database
function fetchStatusOptions($koneksi)
{
    $query = "SELECT DISTINCT status FROM kategori_program";
    $result = $koneksi->query($query);
    $statusOptions = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $statusOptions[] = $row['status'];
        }
    }

    return $statusOptions;
}
