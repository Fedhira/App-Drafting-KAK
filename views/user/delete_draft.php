<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kak_id'])) {
    $kak_id = intval($_POST['kak_id']); // Sanitasi input
    $query = "DELETE FROM kak WHERE kak_id = $kak_id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: draft.php?status=success&action=delete");
    } else {
        header("Location: draft.php?status=error&action=delete");
    }
} else {
    header("Location: draft.php?status=error&action=delete");
}
?>
