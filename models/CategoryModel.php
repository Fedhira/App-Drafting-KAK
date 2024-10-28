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
        return true;
    } else {
        return false;
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
        return true;
    } else {
        return false;
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
        return true;
    } else {
        return false;
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
        if ($action == 'add') {
            if ($nama_divisi && $status) {
                if (addKategori($koneksi, $nama_divisi, $status)) {
                    header("Location: ../views/admin/kategori.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal menambahkan kategori!'); window.location.href='../views/admin/kategori.php';</script>";
                }
            } else {
                echo "<script>alert('Semua field harus diisi!'); window.location.href='../views/admin/kategori.php';</script>";
            }
        }

        // Update Kategori
        elseif ($action == 'update' && $kategori_id) {
            if ($nama_divisi && $status) {
                if (updateKategori($koneksi, $kategori_id, $nama_divisi, $status)) {
                    header("Location: ../views/admin/kategori.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal mengupdate kategori!'); window.location.href='../views/admin/kategori.php';</script>";
                }
            } else {
                echo "<script>alert('Semua field harus diisi!'); window.location.href='../views/admin/kategori.php';</script>";
            }
        }

        // Hapus Kategori
        elseif ($action == 'delete' && $kategori_id) {
            if (deleteKategori($koneksi, $kategori_id)) {
                header("Location: ../views/admin/kategori.php");
                exit();
            } else {
                echo "<script>alert('Gagal menghapus kategori!'); window.location.href='../views/admin/kategori.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Aksi tidak valid!'); window.location.href='../views/admin/kategori.php';</script>";
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
