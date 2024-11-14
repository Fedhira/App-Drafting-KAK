<?php
// Start the session if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection
require __DIR__ . '/../database/config.php';

// Login logic
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query database with prepared statements to prevent SQL Injection
    $query = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $email, $password); // Bind email and password parameters
    $stmt->execute();
    $result = $stmt->get_result();
    $hitung = $result->num_rows;

    if ($hitung > 0) {
        $data = $result->fetch_assoc();

        // Simpan data session
        $_SESSION['log'] = 'True';
        $_SESSION['role'] = $data['role'];
        $_SESSION['user_id'] = $data['user_id']; // Pastikan 'user_id' disimpan di sesi
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $data['username'];

        // Redirect sesuai role user dan tambahkan status=success
        switch ($data['role']) {
            case 'admin':
                header('Location: ../views/admin/index.php?status=success');
                break;
            case 'user':
                header('Location: ../views/user/index.php?status=success');
                break;
            case 'supervisor':
                header('Location: ../views/supervisor/index.php?status=success');
                break;
        }
        exit();
    } else {
        header('Location: ../login.php?status=error');
        exit();
    }
}

// Check if the user is logged in
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'guest@example.com';


// Query untuk menghitung jumlah user
$sql = "SELECT COUNT(*) AS total_users FROM user";
$result = $koneksi->query($sql);
$total_users = $result->fetch_assoc()['total_users'] ?? 0;

// Query untuk menghitung jumlah kategori
$sql = "SELECT COUNT(*) AS total_kategori FROM kategori_program";
$result = $koneksi->query($sql);
$total_kategori = $result->fetch_assoc()['total_kategori'] ?? 0;

// Query untuk menghitung jumlah daftar KAK
$sql = "SELECT COUNT(*) AS total_kak FROM kak";
$result = $koneksi->query($sql);
$total_kak = $result->fetch_assoc()['total_kak'] ?? 0;

$sql_pending = "SELECT COUNT(*) AS total_pending FROM kak WHERE status = 'pending'";
$sql_draft = "SELECT COUNT(*) AS total_draft FROM kak WHERE status = 'draft'";
$sql_disetujui = "SELECT COUNT(*) AS total_disetujui FROM kak WHERE status = 'disetujui'";
$sql_ditolak = "SELECT COUNT(*) AS total_ditolak FROM kak WHERE status = 'ditolak'";

$result_pending = $koneksi->query($sql_pending);
$result_draft = $koneksi->query($sql_draft);
$result_disetujui = $koneksi->query($sql_disetujui);
$result_ditolak = $koneksi->query($sql_ditolak);

$total_pending = $result_pending->fetch_assoc()['total_pending'] ?? 0;
$total_draft = $result_draft->fetch_assoc()['total_draft'] ?? 0;
$total_disetujui = $result_disetujui->fetch_assoc()['total_disetujui'] ?? 0;
$total_ditolak = $result_ditolak->fetch_assoc()['total_ditolak'] ?? 0;

// Get the date filter parameters from the GET request
$fromDate = isset($_GET['fromDate']) && !empty($_GET['fromDate']) ? $_GET['fromDate'] : null;
$toDate = isset($_GET['toDate']) && !empty($_GET['toDate']) ? $_GET['toDate'] : null;
