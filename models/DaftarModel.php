<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';


function addRevisi($koneksi, $kak_id, $alasan_penolakan, $saran)
{
    // Query untuk memasukkan data ke tabel revisi
    $query = "
    INSERT INTO revisi (kak_id, alasan_penolakan, saran) 
    VALUES (?, ?, ?)
    ";

    $stmt = $koneksi->prepare($query);
    if (!$stmt) {
        die('Query Error: ' . $koneksi->error);
    }

    // Bind data untuk query
    $stmt->bind_param("iss", $kak_id, $alasan_penolakan, $saran);

    // Eksekusi query dan redirect sesuai hasilnya
    if ($stmt->execute()) {
        header("Location: ../views/supervisor/daftar.php?status=success&action=add");
        exit();
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
