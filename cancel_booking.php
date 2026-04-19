<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete booking
    mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

    // Redirect back
    header("Location: admin_dashboard.php");
    exit();
}
?>