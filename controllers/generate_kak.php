<?php
// Autoload PHPWord dan konfigurasi database
require_once __DIR__ . '/../phpoffice/vendor/autoload.php';
require __DIR__ . '/../database/config.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Ambil `kak_id` dari parameter URL
$kak_id = isset($_GET['kak_id']) ? intval($_GET['kak_id']) : 0; // Default 0 jika tidak ada kak_id
if ($kak_id <= 0) {
    die("Parameter 'kak_id' tidak valid.");
}

// Ambil data dari database termasuk nama_divisi dari tabel kategori
$sql = "SELECT kak.*, kategori_program.nama_divisi, user.username 
        FROM kak 
        JOIN kategori_program ON kak.kategori_id = kategori_program.kategori_id 
        JOIN user ON kak.user_id = user.user_id 
        WHERE kak.kak_id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param('i', $kak_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan untuk kak_id: $kak_id");
}

$data = $result->fetch_assoc();

// Periksa apakah template file tersedia
$templateFile = __DIR__ . '/../templates/template.docx'; // Path ke template
if (!file_exists($templateFile)) {
    die("Template dokumen tidak ditemukan di: $templateFile");
}

// Muat template dokumen
$templateProcessor = new TemplateProcessor($templateFile);

// Isi template dengan data dari database
$templateProcessor->setValue('nama_divisi', htmlspecialchars($data['nama_divisi'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('username', htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('no_doc_mak', htmlspecialchars($data['no_doc_mak'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('judul', htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('status', htmlspecialchars($status, ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('latar_belakang', htmlspecialchars($data['latar_belakang'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('dasar_hukum', htmlspecialchars($data['dasar_hukum'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('gambaran_umum', htmlspecialchars($data['gambaran_umum'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('tujuan', htmlspecialchars($data['tujuan'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('target_sasaran', htmlspecialchars($data['target_sasaran'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('unit_kerja', htmlspecialchars($data['unit_kerja'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('ruang_lingkup', htmlspecialchars($data['ruang_lingkup'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('produk_jasa_dihasilkan', htmlspecialchars($data['produk_jasa_dihasilkan'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('waktu_pelaksanaan', htmlspecialchars($data['waktu_pelaksanaan'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('tenaga_ahli_terampil', htmlspecialchars($data['tenaga_ahli_terampil'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('peralatan', htmlspecialchars($data['peralatan'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('metode_kerja', htmlspecialchars($data['metode_kerja'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('manajemen_resiko', htmlspecialchars($data['manajemen_resiko'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('laporan_pengajuan_pekerjaan', htmlspecialchars($data['laporan_pengajuan_pekerjaan'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('sumber_dana_prakiraan_biaya', htmlspecialchars($data['sumber_dana_prakiraan_biaya'], ENT_QUOTES, 'UTF-8'));
$templateProcessor->setValue('penutup', htmlspecialchars($data['penutup'], ENT_QUOTES, 'UTF-8'));

// Menambahkan lampiran sebagai gambar jika file gambar tersedia
$lampiranFile = __DIR__ . '/../models/uploads/' . $data['lampiran'];
if (file_exists($lampiranFile) && exif_imagetype($lampiranFile)) {
    $templateProcessor->setImageValue('lampiran', [
        'path' => $lampiranFile,
        'width' => 500,
        'height' => 300,
        'ratio' => true
    ]);
} else {
    // Log error jika file tidak ditemukan atau bukan gambar
    if (!file_exists($lampiranFile)) {
        error_log("File lampiran tidak ditemukan di path: $lampiranFile");
    } elseif (!exif_imagetype($lampiranFile)) {
        error_log("File lampiran bukan file gambar valid: $lampiranFile");
    }
    $templateProcessor->setValue('lampiran', 'Lampiran tidak tersedia');
}


// Tentukan nama file output
$outputFile = 'Dokumen_KAK_' . $kak_id . '.docx';

try {
    $templateProcessor->saveAs($outputFile);

    // Berikan file untuk diunduh pengguna
    if (file_exists($outputFile)) {
        header("Content-Description: File Transfer");
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Disposition: attachment; filename=\"Dokumen_KAK_$kak_id.docx\"");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Content-Length: " . filesize($outputFile));
        readfile($outputFile);

        // Hapus file sementara setelah diunduh
        unlink($outputFile);
    } else {
        die("Gagal membuat file dokumen.");
    }
} catch (Exception $e) {
    die("Terjadi kesalahan saat menyimpan dokumen: " . $e->getMessage());
}

exit();
