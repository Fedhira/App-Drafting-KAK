<?php

// Check if the user is logged in
if (!isset($_SESSION['log'])) {
    header('location:../login.php');
    exit(); // Make sure to exit after a redirect
}
