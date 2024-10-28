<?php
// Login logic
if (isset($_POST['login'])) {
    require '../database/config.php'; // Pastikan path benar

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query database
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $data = mysqli_fetch_assoc($cekdatabase);

        // Simpan data session
        $_SESSION['log'] = 'True';
        $_SESSION['role'] = $data['role'];
        $_SESSION['email'] = $email;  // Existing line
        $_SESSION['username'] = $data['username']; // Store username
        $_SESSION['user_email'] = $data['email']; // Store email


        // Redirect sesuai role user
        if ($data['role'] === 'admin') {
            header('Location: ../views/admin/index.php');
        } elseif ($data['role'] === 'user') {
            header('Location: ../views/user/index.php');
        } elseif ($data['role'] === 'supervisor') {
            header('Location: ../views/supervisor/index.php');
        }
        exit();
    } else {
        header('Location: ../login.php?error=invalid');
        exit();
    }
}

// Check if the user is logged in
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'guest@example.com'; // Default email


// Query untuk menghitung jumlah user
$sql = "SELECT COUNT(*) AS total_users FROM user";
$result = $koneksi->query($sql);

// Ambil hasil query
$total_users = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
}

$sql = "SELECT COUNT(*) AS total_kategori FROM kategori_program";
$result = $koneksi->query($sql);

// Ambil hasil query
$total_kategori = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_kategori = $row['total_kategori'];
}

// Query untuk menghitung jumlah daftar KAK
$sql = "SELECT COUNT(*) AS total_kak FROM kak";
$result = $koneksi->query($sql);

// Ambil hasil query
$total_kak = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_kak = $row['total_kak'];
}
