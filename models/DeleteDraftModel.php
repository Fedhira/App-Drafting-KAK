<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App-Drafting-KAK/database/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kak_id'])) {
    $kak_id = intval($_POST['kak_id']); // Sanitasi input
    $query = "DELETE FROM kak WHERE kak_id = $kak_id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: ../views/user/draft.php?status=success&action=add");
    } else {
        header("Location: ../views/user/draft.php?status=error&action=add");
    }
} else {
    header("Location: ../path/to/page.php?status=error&action=delete");
}
?>
