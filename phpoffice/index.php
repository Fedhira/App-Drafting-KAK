<?php
require_once 'vendor/autoload.php';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

$templateProcessor->setValues(
    [
        'judul' => 'penyediaan barang',
        'dasar_hukum' => 'apa aja coba',
        'gambaran_umum' => 'gabar apa aja',
    ]
);

$pathToSave = 'hasil.docx';
$templateProcessor->saveAs($pathToSave);
