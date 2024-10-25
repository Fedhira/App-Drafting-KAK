<?php
// Cek apakah session sudah aktif
if (session_status() === PHP_SESSION_NONE) {
    // Set parameter cookie sebelum session_start()
    ini_set('session.cookie_samesite', 'Lax');
    session_set_cookie_params([
        'lifetime' => 86400,  // Session berlaku 1 hari
        'path' => '/',
        'domain' => '',  // Kosongkan atau sesuaikan jika perlu
        'secure' => false,  // true jika menggunakan HTTPS
        'httponly' => true  // Cookie hanya bisa diakses oleh HTTP
    ]);

    // Mulai session
    session_start();
}

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
