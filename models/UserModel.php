<?php
include('../database/config.php');
include('../controllers/UserController.php');

// Set the timezone to Indonesia Western Time (WIB)
date_default_timezone_set('Asia/Jakarta');

// Function to add a user
function addUser($koneksi)
{
    if (isset($_POST['username'], $_POST['email'], $_POST['nik'], $_POST['role'], $_POST['kategori_id'], $_POST['password'])) {
        try {
            // Ambil data dari form
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $nik = trim($_POST['nik']);
            $role = trim($_POST['role']);
            $kategori_id = (int) $_POST['kategori_id'];
            $password = trim($_POST['password']);

            // Validasi apakah input tidak kosong
            if (empty($username) || empty($email) || empty($nik) || empty($role) || empty($kategori_id) || empty($password)) {
                throw new Exception("Data form tidak lengkap. Semua input harus diisi.");
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Validasi kategori_id
            $stmt = $koneksi->prepare("SELECT 1 FROM `kategori_program` WHERE `kategori_id` = ?");
            $stmt->bind_param("i", $kategori_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                throw new Exception("Invalid kategori_id: $kategori_id");
            }

            // Siapkan query untuk menambahkan data
            $stmt = $koneksi->prepare(
                "INSERT INTO `user` (username, email, nik, role, kategori_id, password, created_at, updated_at)
                 VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())"
            );
            $stmt->bind_param("ssssss", $username, $email, $nik, $role, $kategori_id, $hashedPassword);

            // Jalankan query
            if (!$stmt->execute()) {
                throw new Exception("Insert failed: " . $stmt->error);
            }

            header("Location: ../views/admin/users.php?status=success&action=add");
            exit();
        } catch (Exception $e) {
            echo "Gagal! Terjadi kesalahan saat menambahkan data. Pesan error: " . $e->getMessage();
        }
    } else {
        echo "Gagal! Data form tidak lengkap.";
    }
}


// Function to update a user
function updateUser($koneksi)
{
    if (isset($_POST['user_id'], $_POST['username'], $_POST['email'], $_POST['nik'], $_POST['role'])) {
        $user_id = (int) $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $nik = $_POST['nik'];
        $role = $_POST['role'];

        // Siapkan query untuk mengubah data
        $stmt = $koneksi->prepare("UPDATE `user` SET username = ?, email = ?, nik = ?, role = ?, updated_at = NOW() WHERE user_id = ?");
        $stmt->bind_param("ssssi", $username, $email, $nik, $role, $user_id);

        // Jalankan query
        if ($stmt->execute()) {
            header("Location: ../views/admin/users.php?status=success&action=update");
            exit();
        } else {
            header("Location: ../views/admin/users.php?status=error&action=update");
            exit();
        }

        // Tutup statement
        $stmt->close();
    } else {
        header("Location: ../views/admin/users.php?status=error&action=update");
        exit();
    }
}




// Function to delete a user
function deleteUser($koneksi)
{
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Prepare the delete query
        $stmt = $koneksi->prepare("DELETE FROM `user` WHERE `user_id` = ?");
        $stmt->bind_param("i", $user_id); // Assuming user_id is an integer

        // Execute the query
        if ($stmt->execute()) {
            header("Location: ../views/admin/users.php?status=success&action=delete");
            exit();
        } else {
            header("Location: ../views/admin/users.php?status=error&action=delete");
            exit();
        }

        $stmt->close();
    } else {
        header("Location: ../views/admin/users.php?status=error&action=delete");
        exit();
    }
}


// Check the request method and call the appropriate function
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
        deleteUser($koneksi);
    } elseif (isset($_POST['user_id'])) {
        updateUser($koneksi);
    } else {
        addUser($koneksi);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addUser($koneksi);
}
