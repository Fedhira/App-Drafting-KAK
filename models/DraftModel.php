<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';

date_default_timezone_set('Asia/Jakarta');

function addKak($koneksi, $data, $lampiran = null)
{
    // Jika status tidak diatur, tetapkan sebagai "draft"
    $status = isset($data['status']) ? $data['status'] : 'draft';

    $targetDir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Check if file was uploaded and move it
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $fileName = basename($_FILES['lampiran']['name']);
        $fileName = preg_replace('/\s+/', '_', $fileName); // Replace spaces with underscores
        $targetFilePath = $targetDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $targetFilePath)) {
            $lampiran = $fileName; // Set $lampiran to the file name if upload is successful
        } else {
            $lampiran = null; // Handle the case where file upload fails
        }
    } else {
        $lampiran = null; // If no file is uploaded, set $lampiran to null
    }

    $query = "INSERT INTO kak (
        user_id, kategori_id, no_doc_mak, judul, status, latar_belakang,
        dasar_hukum, gambaran_umum, tujuan, target_sasaran, unit_kerja,
        ruang_lingkup, produk_jasa_dihasilkan, waktu_pelaksanaan,
        tenaga_ahli_terampil, peralatan, metode_kerja, manajemen_resiko,
        laporan_pengajuan_pekerjaan, sumber_dana_prakiraan_biaya, lampiran,
        penutup, created_at, updated_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param(
        "iissssssssssssssssssss",
        $data['user_id'],
        $data['kategori_id'],
        $data['no_doc_mak'],
        $data['judul'],
        $status,
        $data['latar_belakang'],
        $data['dasar_hukum'],
        $data['gambaran_umum'],
        $data['tujuan'],
        $data['target_sasaran'],
        $data['unit_kerja'],
        $data['ruang_lingkup'],
        $data['produk_jasa_dihasilkan'],
        $data['waktu_pelaksanaan'],
        $data['tenaga_ahli_terampil'],
        $data['peralatan'],
        $data['metode_kerja'],
        $data['manajemen_resiko'],
        $data['laporan_pengajuan_pekerjaan'],
        $data['sumber_dana_prakiraan_biaya'],
        $lampiran,
        $data['penutup']
    );

    if ($stmt->execute()) {
        header("Location: ../views/user/draft.php");
        exit;
    } else {
        return $stmt->error;
    }
}

function updateKak($koneksi, $data, $lampiran = null)
{
    $query = "UPDATE kak SET
        kategori_id = ?, no_doc_mak = ?, judul = ?, status = ?, latar_belakang = ?,
        dasar_hukum = ?, gambaran_umum = ?, tujuan = ?, target_sasaran = ?,
        unit_kerja = ?, ruang_lingkup = ?, produk_jasa_dihasilkan = ?, waktu_pelaksanaan = ?,
        tenaga_ahli_terampil = ?, peralatan = ?, metode_kerja = ?, manajemen_resiko = ?,
        laporan_pengajuan_pekerjaan = ?, sumber_dana_prakiraan_biaya = ?, lampiran = ?,
        penutup = ?, updated_at = NOW()
        WHERE kak_id = ?";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param(
        "issssssssssssssssssssi",
        $data['kategori_id'],
        $data['no_doc_mak'],
        $data['judul'],
        $data['status'],
        $data['latar_belakang'],
        $data['dasar_hukum'],
        $data['gambaran_umum'],
        $data['tujuan'],
        $data['target_sasaran'],
        $data['unit_kerja'],
        $data['ruang_lingkup'],
        $data['produk_jasa_dihasilkan'],
        $data['waktu_pelaksanaan'],
        $data['tenaga_ahli_terampil'],
        $data['peralatan'],
        $data['metode_kerja'],
        $data['manajemen_resiko'],
        $data['laporan_pengajuan_pekerjaan'],
        $data['sumber_dana_prakiraan_biaya'],
        $lampiran,
        $data['penutup'],
        $data['kak_id']
    );

    if ($stmt->execute()) {
        header("Location: ../views/user/draft.php");
        exit;
    } else {
        return $stmt->error;
    }
}

function deleteKak($koneksi, $kak_id)
{
    $query = "DELETE FROM kak WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);

    if ($stmt->execute()) {
        header("Location: ../views/user/draft.php");
        exit;
    } else {
        return $stmt->error;
    }
}

function getKakById($koneksi, $kak_id)
{
    $query = "SELECT * FROM kak WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'add':
                // Panggil fungsi tambah KAK
                $result = addKak($koneksi, $_POST, $_FILES['lampiran']);
                if ($result === true) {
                    header("Location: ../views/user/draft.php");
                    exit;
                } else {
                    echo "Error adding data: " . $result;
                }
                break;

            case 'update':
                // Panggil fungsi update KAK
                $result = updateKak($koneksi, $_POST, $_FILES['lampiran']);
                if ($result === true) {
                    header("Location: ../views/user/draft.php");
                    exit;
                } else {
                    echo "Error updating data: " . $result;
                }
                break;
        }
    }
}

// Hapus data jika menerima permintaan GET dengan aksi 'delete'
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['kak_id'])) {
    $kak_id = $_GET['kak_id'];
    $result = deleteKak($koneksi, $kak_id);
    if ($result === true) {
        header("Location: ../views/user/draft.php");
        exit;
    } else {
        echo "Error deleting data: " . $result;
    }
}
