<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/controllers/UserController.php';

// Set the timezone to Indonesia Western Time (WIB)
date_default_timezone_set('Asia/Jakarta');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_SESSION['user_id'] ?? null;
    $kategori_id = $_POST['kategori'];
    $no_doc_mak = $_POST['nodoc'];
    $judul = $_POST['judul'];
    $latar_belakang = $_POST['latbek'];
    $dasar_hukum = $_POST['daskum'];
    $gambaran_umum = $_POST['gambaran'];
    $tujuan = $_POST['tujuan'];
    $target_sasaran = $_POST['target'];
    $unit_kerja = $_POST['unitkerja'];
    $ruang_lingkup = $_POST['ruanglingkup'];
    $produk_jasa_dihasilkan = $_POST['produk'];
    $waktu_pelaksanaan = $_POST['waktu'];
    $tenaga_ahli_terampil = $_POST['tenaga_ahli'] ?? null;
    $peralatan = $_POST['peralatan'];
    $metode_kerja = $_POST['metode'];
    $manajemen_resiko = $_POST['manajemen'];
    $laporan_pengajuan_pekerjaan = $_POST['laporan'];
    $sumber_dana_prakiraan_biaya = $_POST['sumber'];
    $penutup = $_POST['penutup'];
    $status = 'draft';

    // Check if user_id exists
    if ($user_id === null) {
        echo "User ID is missing. Please ensure you are logged in.";
        exit;
    }

    // Handle file upload for 'lampiran'
    $lampiran = ""; // Default is empty
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $lampiran = basename($_FILES['lampiran']['name']);
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/uploads/';
        $target_file = $target_dir . $lampiran;

        // Check if the file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            exit;
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($_FILES['lampiran']['tmp_name'], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        echo "File upload error: " . $_FILES['lampiran']['error'];
        exit;
    }

    // Prepare SQL query to insert data into the 'kak' table
    $query = "INSERT INTO kak (
        user_id, kategori_id, no_doc_mak, judul, status, latar_belakang,
        dasar_hukum, gambaran_umum, tujuan, target_sasaran, unit_kerja,
        ruang_lingkup, produk_jasa_dihasilkan, waktu_pelaksanaan,
        tenaga_ahli_terampil, peralatan, metode_kerja, manajemen_resiko,
        laporan_pengajuan_pekerjaan, sumber_dana_prakiraan_biaya, lampiran,
        penutup
      ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
      )";

    // Prepare and bind parameters
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param(
        "iissssssssssssssssssss",
        $user_id,
        $kategori_id,
        $no_doc_mak,
        $judul,
        $status,
        $latar_belakang,
        $dasar_hukum,
        $gambaran_umum,
        $tujuan,
        $target_sasaran,
        $unit_kerja,
        $ruang_lingkup,
        $produk_jasa_dihasilkan,
        $waktu_pelaksanaan,
        $tenaga_ahli_terampil,
        $peralatan,
        $metode_kerja,
        $manajemen_resiko,
        $laporan_pengajuan_pekerjaan,
        $sumber_dana_prakiraan_biaya,
        $lampiran,
        $penutup
    );

    // Execute and check for success
    if ($stmt->execute()) {
        header("Location: ../views/user/draft.php"); // Redirect to draft page after successful insertion
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$koneksi->close();
