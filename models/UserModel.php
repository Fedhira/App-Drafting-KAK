<?php
include('../database/config.php');
include('../controllers/UserController.php');
session_start();

// Set the timezone to Indonesia Western Time (WIB)
date_default_timezone_set('Asia/Jakarta');

// Function to add a user
function addUser($koneksi)
{
    // Get the POST data and ensure they are set
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;
    $nik = $_POST['nik'] ?? null;
    $password = $_POST['password'] ?? null;
    $kategori_id = $_POST['kategori_id'] ?? null;

    // Get the current timestamps
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Check if all necessary fields are filled
    if ($username && $email && $role && $nik && $password && $kategori_id) {
        $stmt = $koneksi->prepare("INSERT INTO `user` (`kategori_id`, `username`, `email`, `nik`, `password`, `role`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $kategori_id, $username, $email, $nik, $password, $role, $created_at, $updated_at);

        // Execute the query
        if ($stmt->execute()) {
            header("location:../views/admin/users.php");
            exit();
        } else {
            echo "ERROR, data gagal ditambah: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ERROR, all fields are required!";
    }
}

// Function to update a user
function updateUser($koneksi)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $role = $_POST['role'] ?? null;
        $nik = $_POST['nik'] ?? null;
        $kategori_id = $_POST['kategori_id'] ?? null;

        // Waktu sekarang otomatis untuk updated_at
        $updated_at = date('Y-m-d H:i:s');

        if ($username && $email && $role && $nik && $kategori_id) {
            $query = "UPDATE `user` SET 
                        `username` = ?, 
                        `email` = ?, 
                        `role` = ?, 
                        `nik` = ?, 
                        `kategori_id` = ?, 
                        `updated_at` = ? 
                      WHERE `user_id` = ?";

            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssssisi", $username, $email, $role, $nik, $kategori_id, $updated_at, $user_id);

            if ($stmt->execute()) {
                header("Location: ../views/admin/users.php"); // Redirect on success
            } else {
                echo "ERROR: Query failed: " . $stmt->error; // Pesan error untuk debug
            }
            $stmt->close();
        } else {
            echo "ERROR, all fields are required!";
        }
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
            header("Location: ../views/admin/users.php"); // Redirect on success
            exit();
        } else {
            echo "ERROR: Could not execute $stmt. " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ERROR: user_id not set!";
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


