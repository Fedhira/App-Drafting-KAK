<?php
// Start the session if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection
require __DIR__ . '/../database/config.php';

// Fungsi untuk mengecek login dan hak akses
function checkLoginAndRole($required_role = null, $required_user_id = null)
{
    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'True') {
        echo "<script>alert('Anda belum login!'); window.location.href = '../views/login.php';</script>";
        exit();
    }

    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'True') {
        header('Location: ../views/login.php');
        exit();
    }

    // Cek apakah role sesuai dengan yang diperlukan
    if ($required_role && $_SESSION['role'] !== $required_role) {
        echo "Akses ditolak! Anda tidak memiliki hak untuk mengakses halaman ini.";
        exit();
    }

    // Cek apakah user_id sesuai dengan yang diperlukan (misalnya untuk halaman profil)
    if ($required_user_id && $_SESSION['user_id'] != $required_user_id) {
        echo "Akses ditolak! Anda tidak dapat mengakses akun user lain.";
        exit();
    }
}

// Cek login dan role saat user mengakses halaman admin
if (isset($_GET['page']) && $_GET['page'] === 'admin') {
    checkLoginAndRole('admin');  // Pastikan hanya admin yang bisa akses
}

// Cek login dan role saat user mengakses halaman user
if (isset($_GET['page']) && $_GET['page'] === 'user') {
    checkLoginAndRole('user', $_SESSION['user_id']);  // Pastikan hanya user yang bisa akses dan sesuai dengan user_id mereka
}

// Cek login dan role saat supervisor mengakses halaman supervisor
if (isset($_GET['page']) && $_GET['page'] === 'supervisor') {
    checkLoginAndRole('supervisor');  // Pastikan hanya supervisor yang bisa akses
}


// Login logic
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query database hanya untuk email, password akan diverifikasi secara terpisah
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            // Password benar, lanjutkan login
            $_SESSION['log'] = 'True';
            $_SESSION['role'] = $data['role'];
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $data['username'];

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
            echo "Password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }
}


// Check if the user is logged in
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'guest@example.com';


// Ambil ID user yang login
$user_id = $_SESSION['user_id']; // Sesuaikan dengan cara Anda mendapatkan user_id
$user_role = $_SESSION['role']; // Ambil role dari session (admin, supervisor, user)

// Jika role adalah 'user', filter berdasarkan user_id
if ($user_role == 'user') {
    // Query untuk menghitung jumlah KAK berdasarkan status dan user_id
    $sql_pending = "
        SELECT COUNT(*) AS total_pending 
        FROM kak
        WHERE kak.status = 'pending' AND kak.user_id = '$user_id'
    ";

    $sql_draft = "
        SELECT COUNT(*) AS total_draft 
        FROM kak
        WHERE kak.status = 'draft' AND kak.user_id = '$user_id'
    ";

    $sql_disetujui = "
        SELECT COUNT(*) AS total_disetujui 
        FROM kak
        WHERE kak.status = 'disetujui' AND kak.user_id = '$user_id'
    ";

    $sql_ditolak = "
        SELECT COUNT(*) AS total_ditolak 
        FROM kak
        WHERE kak.status = 'ditolak' AND kak.user_id = '$user_id'
    ";

    $sql_kak = "
        SELECT COUNT(*) AS total_kak 
        FROM kak
        WHERE kak.user_id = '$user_id'
    ";
} else {
    // Jika role adalah 'admin' atau 'supervisor', ambil semua data
    $sql_pending = "
        SELECT COUNT(*) AS total_pending 
        FROM kak
        WHERE kak.status = 'pending'
    ";

    $sql_draft = "
        SELECT COUNT(*) AS total_draft 
        FROM kak
        WHERE kak.status = 'draft'
    ";

    $sql_disetujui = "
        SELECT COUNT(*) AS total_disetujui 
        FROM kak
        WHERE kak.status = 'disetujui'
    ";

    $sql_ditolak = "
        SELECT COUNT(*) AS total_ditolak 
        FROM kak
        WHERE kak.status = 'ditolak'
    ";

    $sql_kak = "
        SELECT COUNT(*) AS total_kak 
        FROM kak
    ";
}

// Query untuk menghitung jumlah user
$sql_users = "SELECT COUNT(*) AS total_users FROM user";
$result_users = $koneksi->query($sql_users);
$total_users = $result_users->fetch_assoc()['total_users'] ?? 0;

// Query untuk menghitung jumlah kategori
$sql_kategori = "SELECT COUNT(*) AS total_kategori FROM kategori_program";
$result_kategori = $koneksi->query($sql_kategori);
$total_kategori = $result_kategori->fetch_assoc()['total_kategori'] ?? 0;

// Eksekusi query dan ambil hasilnya
$result_pending = $koneksi->query($sql_pending);
$result_draft = $koneksi->query($sql_draft);
$result_disetujui = $koneksi->query($sql_disetujui);
$result_ditolak = $koneksi->query($sql_ditolak);
$result_kak = $koneksi->query($sql_kak);

// Ambil hasil dari query
$total_pending = $result_pending->fetch_assoc()['total_pending'] ?? 0;
$total_draft = $result_draft->fetch_assoc()['total_draft'] ?? 0;
$total_disetujui = $result_disetujui->fetch_assoc()['total_disetujui'] ?? 0;
$total_ditolak = $result_ditolak->fetch_assoc()['total_ditolak'] ?? 0;
$total_kak = $result_kak->fetch_assoc()['total_kak'] ?? 0;



// Get the date filter parameters from the GET request
$fromDate = isset($_GET['fromDate']) && !empty($_GET['fromDate']) ? $_GET['fromDate'] : null;
$toDate = isset($_GET['toDate']) && !empty($_GET['toDate']) ? $_GET['toDate'] : null;
