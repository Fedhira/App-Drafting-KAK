<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/controllers/UserController.php';


// Fungsi untuk menambahkan kategori
function addKategori($koneksi, $nama_divisi, $status)
{
    $stmt = $koneksi->prepare("INSERT INTO kategori_program (nama_divisi, status) VALUES (?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . $koneksi->error);
    }

    $stmt->bind_param("ss", $nama_divisi, $status);

    if ($stmt->execute()) {
        header("Location: ../views/admin/kategori.php?status=success&action=add");
        exit();
    } else {
        header("Location: ../views/admin/kategori.php?status=error&action=add");
        exit();
    }

    $stmt->close();
}

// Fungsi untuk mengupdate kategori
function updateKategori($koneksi, $kategori_id, $nama_divisi, $status)
{
    $stmt = $koneksi->prepare("UPDATE kategori_program SET nama_divisi = ?, status = ? WHERE kategori_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $koneksi->error);
    }

    $stmt->bind_param("ssi", $nama_divisi, $status, $kategori_id);

    if ($stmt->execute()) {
        header("Location: ../views/admin/kategori.php?status=success&action=update");
        exit();
    } else {
        header("Location: ../views/admin/kategori.php?status=error&action=update");
        exit();
    }

    $stmt->close();
}

// Fungsi untuk menghapus kategori
function deleteKategori($koneksi, $kategori_id)
{
    $stmt = $koneksi->prepare("DELETE FROM kategori_program WHERE kategori_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $koneksi->error);
    }

    $stmt->bind_param("i", $kategori_id);

    if ($stmt->execute()) {
        header("Location: ../views/admin/kategori.php?status=success&action=delete");
        exit();
    } else {
        header("Location: ../views/admin/kategori.php?status=error&action=delete");
        exit();
    }

    $stmt->close();
}

// Menangani request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $nama_divisi = $_POST['nama_divisi'] ?? null;
        $status = $_POST['status'] ?? null;
        $kategori_id = $_POST['kategori_id'] ?? null;

        // Tambah Kategori
        if ($action == 'add' && $nama_divisi && $status) {
            addKategori($koneksi, $nama_divisi, $status);
        }

        // Update Kategori
        elseif ($action == 'update' && $kategori_id && $nama_divisi && $status) {
            updateKategori($koneksi, $kategori_id, $nama_divisi, $status);
        }

        // Hapus Kategori
        elseif ($action == 'delete' && $kategori_id) {
            deleteKategori($koneksi, $kategori_id);
        } else {
            header("Location: ../views/admin/kategori.php?status=error&action=$action");
            exit();
        }
    } else {
        header("Location: ../views/admin/kategori.php?status=error&action=unknown");
        exit();
    }

    $koneksi->close();
}


// Fungsi untuk mengambil status yang tersedia di tabel kategori_program
function fetchStatusOptions($koneksi)
{
    $query = "SELECT DISTINCT status FROM kategori_program";
    $result = $koneksi->query($query);
    $statusOptions = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $statusOptions[] = $row['status'];
        }
    }

    return $statusOptions;
}
