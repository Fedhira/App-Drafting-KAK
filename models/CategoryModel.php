<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/controllers/UserController.php';

// Function to add a new category
function addKategori($koneksi, $nama_divisi, $status)
{
    // Prepare the SQL query to insert a new category
    $stmt = $koneksi->prepare("INSERT INTO kategori_program (nama_divisi, status) VALUES (?, ?)");
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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $nama_divisi = $_POST['nama_divisi'];
        $status = $_POST['status'];

        if (addKategori($koneksi, $nama_divisi, $status)) {
            header("Location: ../views/admin/kategori.php"); // Redirect on success
            exit();
        } else {
            echo "Error adding category.";
        }
    }
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
