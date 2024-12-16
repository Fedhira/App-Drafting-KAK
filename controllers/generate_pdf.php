<?php
require_once '../vendor/autoload.php';
require_once '../database/config.php';

function generateKAKPDF($kak_id)
{
    global $koneksi;

    $query = "SELECT k.*, kp.nama_divisi, u.username
              FROM kak k
              JOIN kategori_program kp ON k.kategori_id = kp.kategori_id 
              JOIN user u ON k.user_id = u.user_id
              WHERE k.kak_id = ?";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $kak_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator('BAKTI');
    $pdf->SetAuthor('BAKTI');
    $pdf->SetTitle($data['judul']);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(25, 25, 25);
    $pdf->SetAutoPageBreak(TRUE, 25);

    // Cover page
    $pdf->AddPage();

    $coverHtml = '
    <style>
        .title { font-size: 20pt; text-align: center; margin-bottom: 10px; color:rgb(0, 0, 0); }
        .english-title { font-size: 12pt; text-align: center; font-style: italic; margin-bottom: 20px; color: #666; }
        .doc-title { font-size: 14pt; text-align: center; margin-bottom: 30px; font-weight: bold; color: #333; }
        .org-name { font-size: 14pt; text-align: center; font-weight: bold; margin-top: 80px; line-height: 2; color:rgb(0, 0, 0); }
        .year { font-size: 12pt; text-align: center; margin-top: 20px; color: #666; }
        .separator { border-bottom: 2px solidrgb(0, 0, 0); margin: 10px auto; width: 50%; }
        
    </style>
    
    <div class="title">KERANGKA ACUAN KERJA</div>
    <div class="english-title">(Term of Reference)</div>
    <br><br><br><br>
    <div class="doc-title">' . strtoupper($data['judul']) . '</div>
    <br><br><br><br>
    <div style="height: 300px;"></div>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    
    <div class="org-name">
        BADAN AKSESIBILITAS TELEKOMUNIKASI DAN INFORMASI<br>
        KEMENTERIAN KOMUNIKASI DAN INFORMATIKA<br>
        REPUBLIK INDONESIA
    </div>
    <div class="year">JAKARTA, ' . date('Y') . '</div>';

    // Insert logo after doc-title
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/assets/img/kaiadmin/logo_bakti.png';
    $pdf->Image($imagePath, 65, 120, 80);
    $pdf->writeHTML($coverHtml, true, false, true, false, '');

    // Content page
    $pdf->AddPage();
    $contentHtml = '
    <style>
        .main-header { 
            font-size: 14pt; 
            text-align: center; 
            font-weight: bold; 
            margin-bottom: 20px;
            color:rgb(0, 0, 0);
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .info-table { 
            width: 100%; 
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-table td { 
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child { 
            width: 80px;
            font-weight: bold;
            color:rgb(0, 0, 0);
        }
        .section { 
            font-size: 12pt;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            color:rgb(0, 0, 0);
            padding: 5px 0;
            border-bottom: 2px solid #eee;
        }
        p { 
            text-align: justify; 
            line-height: 1.6;
            margin-bottom: 10px;
            color: #333;
        }
    </style>

    <div class="main-header">KERANGKA ACUAN KERJA (KAK)</div>
    <br><br>
    <table class="info-table">
        <tr>
            <td style="width: 30%;"><b>Kementerian Negara</b></td>
            <td style="width: 70%;">: Kementerian Komunikasi dan Informatika</td>
        </tr>
        <tr>
            <td style="width: 30%;"><b>Unit Eselon I</b></td>
            <td style="width: 70%;">: Badan Aksesibilitas Telekomunikasi dan Informasi</td>
        </tr>
        <tr>
            <td style="width: 30%;"><b>Nama Kegiatan</b></td>
            <td style="width: 70%;">: ' . $data['judul'] . '</td>
        </tr>
        <tr><td style="width: 30%;"><b>Indikator Kinerja Kegiatan</b></td>
            <td style="width: 70%;">: ' . $data['indikator'] . '</td>
        </tr>
        <tr><td style="width: 30%;"><b>Satuan Ukur / Jenis Keluaran</b></td>
            <td style="width: 70%;">: ' . $data['satuan_ukur'] . '</td>
        </tr>
        <tr><td style="width: 30%;"><b>Volume</b></td>
            <td style="width: 70%;">: ' . $data['volume'] . '</td>
        </tr>
    </table>
    <br><br>
    <div class="section">A. LATAR BELAKANG</div>
    <div class="section" style="font-size:11pt;">1. DASAR HUKUM</div>
    <p>' . nl2br($data['dasar_hukum']) . '</p>
    
    <div class="section" style="font-size:11pt;">2. GAMBARAN UMUM</div>
    <p>' . nl2br($data['gambaran_umum']) . '</p>

    <div class="section">B. MAKSUD DAN TUJUAN</div>
    <p>' . nl2br($data['tujuan']) . '</p>

    <div class="section">C. TARGET/SASARAN</div>
    <p>' . nl2br($data['target_sasaran']) . '</p>

    <div class="section">D. UNIT KERJA</div>
    <p>' . nl2br($data['unit_kerja']) . '</p>

    <div class="section">E. RUANG LINGKUP PEKERJAAN</div>
    <p>' . nl2br($data['ruang_lingkup']) . '</p>

    <div class="section">F. PRODUK/JASA DIHASILKAN</div>
    <p>' . nl2br($data['produk_jasa_dihasilkan']) . '</p>

    <div class="section">G. WAKTU PELAKSANAAN</div>
    <p>' . nl2br($data['waktu_pelaksanaan']) . '</p>

    <div class="section">H. TENAGA AHLI/TERAMPIL</div>
    <p>' . nl2br($data['tenaga_ahli_terampil']) . '</p>

    <div class="section">I. PERALATAN</div>
    <p>' . nl2br($data['peralatan']) . '</p>

    <div class="section">J. METODE KERJA</div>
    <p>' . nl2br($data['metode_kerja']) . '</p>

    <div class="section">K. MANAJEMEN RISIKO</div>
    <p>' . nl2br($data['manajemen_resiko']) . '</p>

    <div class="section">L. LAPORAN PENGAJUAN PEKERJAAN</div>
    <p>' . nl2br($data['laporan_pengajuan_pekerjaan']) . '</p>

    <div class="section">M. SUMBER DANA</div>
    <p>' . nl2br($data['sumber_dana_prakiraan_biaya']) . '</p>

    <div class="section">N. PENUTUP</div>
<p>' . nl2br($data['penutup']) . '</p>

<br><br><br><br><br>
<div style="width: 100%; text-align: right;">
    <span>Jakarta, .................... ' . date('Y') . '</span><br><br>
    <span><b>' . $data['nama_divisi'] . '</b></span>
</div>
<br><br>
<div style="width: 100%; text-align: right;">
    <span style="text-decoration: underline; font-weight: bold;">' . $data['username'] . '</span><br>
    <span>NIP.</span>
</div>
    <div class="section">O. LAMPIRAN</div>
<br>
<div style="text-align:center;">
' . $data['judul'] . '<br>
MAK. ' . $data['no_doc_mak'] . '<br>
' . $data['lampiran'] . ' <br>
</div>';



    // Cek apakah lampiran ada
    if (!empty($data['lampiran'])) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/models/uploads/' . $data['lampiran'];

        // Periksa apakah file gambar benar-benar ada
        if (file_exists($imagePath)) {
            $contentHtml .= '<div style="text-align:center; margin:20px 0;">
                <img src="' . $imagePath . '" style="width:500px;">
            </div>';
        } else {
            $contentHtml .= '<p style="color: red; text-align: center;">Lampiran tidak ditemukan.</p>';
        }
    } else {
        $contentHtml .= '<p style="text-align: center;">Tidak ada lampiran yang tersedia.</p>';
    }


    // Tulis semua konten sekali saja
    $pdf->writeHTML($contentHtml, true, false, true, false, '');

    return $pdf;
}

if (isset($_GET['kak_id'])) {
    $kak_id = $_GET['kak_id'];
    $pdf = generateKAKPDF($kak_id);
    $pdf->Output('KAK_' . date('Y-m-d') . '.pdf', 'I');
    exit;
}
