<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if none is active
}

// Check if the user is logged in
if (!isset($_SESSION['log'])) {
    header('location:./login.php');
    exit(); // Make sure to exit after a redirect
}
