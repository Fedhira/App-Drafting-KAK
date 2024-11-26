<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';

date_default_timezone_set('Asia/Jakarta');

function addKak($koneksi, $data, $lampiran = null)
{
    // Tetapkan status default sebagai 'draft' jika tidak diatur
    $status = isset($data['status']) ? $data['status'] : 'draft';

    $targetDir = "uploads/";

    // Pastikan direktori uploads ada
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Cek apakah file diunggah
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $fileName = basename($_FILES['lampiran']['name']);
        $fileName = preg_replace('/\s+/', '_', $fileName); // Ganti spasi dengan underscore
        $targetFilePath = $targetDir . $fileName;

        // Pindahkan file yang diunggah
        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $targetFilePath)) {
            $lampiran = $fileName; // Set lampiran jika upload berhasil
        } else {
            $lampiran = null; // Jika upload gagal, set lampiran menjadi null
        }
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
    $targetDir = "uploads/";

    // Proses upload file lampiran baru (jika ada)
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $fileName = basename($_FILES['lampiran']['name']);
        $fileName = preg_replace('/\s+/', '_', $fileName); // Ganti spasi dengan underscore
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $targetFilePath)) {
            $lampiran = $fileName;
        }
    } else {
        $lampiran = $data['current_lampiran']; // Pertahankan lampiran lama
    }

    // Jika action adalah upload, ubah status menjadi 'pending'
    $status = isset($data['action']) && $data['action'] === 'upload' ? 'pending' : $data['current_status'];

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
        $data['penutup'],
        $data['kak_id']
    );

    if ($stmt->execute()) {
        // Redirect ke daftar.php jika action adalah upload
        if (isset($data['action']) && $data['action'] === 'upload') {
            header("Location: ../views/user/daftar.php");
            exit;
        }

        header("Location: ../views/user/draft.php");
        exit;
    } else {
        return $stmt->error;
    }
}


// Fungsi Hapus Data
function deleteKak($koneksi, $kak_id)
{
    // Validasi ID (pastikan ini angka)
    if (!is_numeric($kak_id)) {
        die("Invalid ID provided.");
    }

    // Query untuk menghapus data
    $query = "DELETE FROM kak WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman draft.php
        header("Location: ../views/user/draft.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        die("Error deleting data: " . $stmt->error);
    }
}

function uploadKak($koneksi, $kak_id, $lampiran)
{
    // Validasi parameter
    if (!$lampiran) {
        return "Tidak ada file yang diunggah.";
    }

    // Tentukan lokasi penyimpanan file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($lampiran);
    $upload_ok = 1;

    // Validasi jenis file
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ['pdf', 'docx', 'xlsx'])) {
        return "Jenis file tidak diizinkan. Hanya PDF, DOCX, dan XLSX yang diizinkan.";
    }

    // Pindahkan file yang diunggah
    if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $target_file)) {
        // Simpan informasi ke database
        $query = "UPDATE draft_table SET lampiran = '$target_file' WHERE id = $kak_id";
        if (mysqli_query($koneksi, $query)) {
            return true; // Sukses
        } else {
            return "Error saat menyimpan ke database: " . mysqli_error($koneksi);
        }
    } else {
        return "Error saat mengunggah file.";
    }
}


function getDraftById($koneksi, $kak_id)
{
    $query = "SELECT * FROM kak WHERE kak_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


// Fungsi Ambil Data Draft (status draft saja)
function getDraftData($koneksi)
{
    $query = "SELECT * FROM kak WHERE status = 'draft'";
    $result = $koneksi->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi Ambil Data Daftar (status selain draft)
function getDaftarData($koneksi)
{
    $query = "SELECT * FROM kak WHERE status IN ('pending', 'disetujui', 'ditolak')";
    $result = $koneksi->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'add':
            $result = addKak($koneksi, $_POST, $_FILES['lampiran']);
            if ($result !== true) {
                echo "Error adding data: " . $result;
            }
            break;
        case 'update':
            $result = updateKak($koneksi, $_POST, $_FILES['lampiran']);
            if ($result !== true) {
                echo "Error updating data: " . $result;
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'upload') {
        if (isset($_POST['kak_id'])) {
            $kak_id = intval($_POST['kak_id']);
            $new_status = 'pending'; // Status baru otomatis menjadi pending

            // Query untuk update status
            $query = "UPDATE kak SET status = ? WHERE kak_id = ?";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "si", $new_status, $kak_id);

            if (mysqli_stmt_execute($stmt)) {
                echo "Draft berhasil diunggah, status telah diubah menjadi 'pending'.";
                // Redirect ke halaman lain jika perlu
                header("Location: ../views/user/daftar.php");
                exit();
            } else {
                echo "Gagal mengubah status: " . mysqli_error($koneksi);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "ID tidak ditemukan. Mohon pastikan form sudah benar.";
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['kak_id'])) {
    $kak_id = $_GET['kak_id'];
    deleteKak($koneksi, $kak_id);
}

if (isset($_POST['upload'])) {
    // Pastikan data kak_id dan lampiran ada di POST
    if (isset($_POST['kak_id']) && isset($_FILES['lampiran'])) {
        $kak_id = $_POST['kak_id'];
        $lampiran = $_FILES['lampiran']['name'];

        // Tentukan lokasi penyimpanan file
        $target_dir = "uploads/"; // Ganti dengan folder tempat penyimpanan file
        $target_file = $target_dir . basename($lampiran);

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $target_file)) {
            // Proses mengubah status dan mengupload file
            $query = "UPDATE kak SET lampiran = ?, status = 'pending', updated_at = NOW() WHERE kak_id = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("si", $lampiran, $kak_id);

            if ($stmt->execute()) {
                // Pindahkan data dari tabel kak ke tabel daftar
                $queryMove = "INSERT INTO daftar (SELECT * FROM kak WHERE kak_id = ?)";
                $stmtMove = $koneksi->prepare($queryMove);
                $stmtMove->bind_param("i", $kak_id);

                if ($stmtMove->execute()) {
                    // Hapus data dari tabel kak setelah dipindahkan
                    $queryDelete = "DELETE FROM kak WHERE kak_id = ?";
                    $stmtDelete = $koneksi->prepare($queryDelete);
                    $stmtDelete->bind_param("i", $kak_id);
                    $stmtDelete->execute();

                    // Redirect ke halaman daftar dengan status sukses
                    header("Location: daftar.php?status=success&action=upload");
                    exit;
                } else {
                    // Jika gagal memindahkan data
                    header("Location: daftar.php?status=error&action=move");
                    exit;
                }
            } else {
                // Jika gagal mengubah status
                header("Location: daftar.php?status=error&action=upload");
                exit;
            }
        } else {
            die('Gagal meng-upload file');
        }
    } else {
        die('Lampiran atau Kak ID tidak ditemukan');
    }
}
