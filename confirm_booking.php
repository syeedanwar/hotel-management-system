<?php
session_start();
include 'db.php';


$required = ['full_name','gender','mobile','email','aadhaar','check_in','check_out'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        die("Missing field: $field");
    }
}

if (!isset($_SESSION['room_type'], $_SESSION['price_per_night'])) {
    die("Room session expired");
}

$room_type = $_SESSION['room_type'];
$price     = (int) $_SESSION['price_per_night'];

/* POST DATA */
$full_name = $_POST['full_name'];
$gender    = $_POST['gender'];
$mobile    = $_POST['mobile'];
$email     = $_POST['email'];
$aadhaar   = $_POST['aadhaar'];
$check_in  = $_POST['check_in'];
$check_out = $_POST['check_out'];


$days = (strtotime($check_out) - strtotime($check_in)) / 86400;
if ($days <= 0) {
    die("Invalid check-out date");
}

$total_price = $days * $price;

$stmt = $conn->prepare("
INSERT INTO bookings
(full_name, gender, mobile, email, aadhaar, room_type, price_per_night, total_price, check_in, check_out)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssiiss",
    $full_name,
    $gender,
    $mobile,
    $email,
    $aadhaar,
    $room_type,
    $price,
    $total_price,
    $check_in,
    $check_out
);

$stmt->execute();


$_SESSION['booking_id']  = $stmt->insert_id;
$_SESSION['success_msg'] = "🎉 Booking confirmed successfully!";


header("Location: booking_success.php");
exit;
