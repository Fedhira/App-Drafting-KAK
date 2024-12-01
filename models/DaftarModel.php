<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';


function addRevisi($koneksi, $kak_id, $alasan_penolakan, $saran)
{
    // Query untuk memasukkan data ke tabel revisi
    $queryRevisi = "
        INSERT INTO revisi (kak_id, alasan_penolakan, saran) 
        VALUES (?, ?, ?)
    ";

    $stmtRevisi = $koneksi->prepare($queryRevisi);
    if (!$stmtRevisi) {
        die('Query Error: ' . $koneksi->error);
    }

    // Bind data untuk query revisi
    $stmtRevisi->bind_param("iss", $kak_id, $alasan_penolakan, $saran);

    // Eksekusi query revisi
    if ($stmtRevisi->execute()) {
        // Jika berhasil, perbarui status di tabel kak
        $queryUpdateStatus = "
            UPDATE kak 
            SET status = 'ditolak'
            WHERE kak_id = ?
        ";
        $stmtUpdate = $koneksi->prepare($queryUpdateStatus);
        if (!$stmtUpdate) {
            die('Query Error: ' . $koneksi->error);
        }

        $stmtUpdate->bind_param("i", $kak_id);
        if ($stmtUpdate->execute()) {
            // Redirect jika berhasil
            header("Location: ../views/supervisor/daftar.php?status=success&action=add");
            exit();
        } else {
            header("Location: ../views/supervisor/daftar.php?status=error&action=update_status");
            exit();
        }
    } else {
        header("Location: ../views/supervisor/daftar.php?status=error&action=add");
        exit();
    }
}


if (isset($_POST['submit_penolakan'])) {
    // Ambil data dari form
    $kak_id = $_POST['kak_id'];
    $alasan_penolakan = $_POST['alasan_penolakan'];
    $saran = $_POST['saran'];

    // Panggil fungsi untuk menyimpan revisi
    addRevisi($koneksi, $kak_id, $alasan_penolakan, $saran);
}


function getKAKDetails($koneksi, $kak_id)
{
    $query = "
        SELECT 
            kak.no_doc_mak, 
            kak.judul, 
            kategori_program.nama_divisi AS kategori
        FROM kak
        JOIN kategori_program ON kak.kategori_id = kategori_program.kategori_id
        WHERE kak.kak_id = ?
    ";

    $stmt = $koneksi->prepare($query);
    if (!$stmt) {
        die('Query Error: ' . $koneksi->error);
    }

    $stmt->bind_param("i", $kak_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengembalikan hasil sebagai array asosiatif
    return $result->fetch_assoc();
}

if (isset($_GET['kak_id'])) {
    $kak_id = $_GET['kak_id'];
    $kakDetails = getKAKDetails($koneksi, $kak_id);

    // Kirim data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($kakDetails);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'update') {
    // Ensure you are updating the correct entry based on the kak_id
    $kak_id = $_POST['kak_id'];
    $current_status = $_POST['current_status'];
    $new_status = 'disetujui'; // Set the new status to 'disetujui'

    // Database connection (assuming $koneksi is your DB connection variable)
    $query = "UPDATE kak SET status = ? WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("si", $new_status, $kak_id);

    if ($stmt->execute()) {
        // Redirect to the daftar page after updating status
        header("Location: ../views/supervisor/daftar.php");
        exit();
    } else {
        echo "Error updating status.";
    }
}
