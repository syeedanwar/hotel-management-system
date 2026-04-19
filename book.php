<?php
session_start();
include 'db.php';

if (!isset($_GET['room_id'])) {
    die("Invalid room selection");
}

$room_id = (int)$_GET['room_id'];

$stmt = $conn->prepare("SELECT room_type, price_per_night FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Room not found");
}

$room = $result->fetch_assoc();

/* SAVE IN SESSION */
$_SESSION['room_id'] = $room_id;
$_SESSION['room_type'] = $room['room_type'];
$_SESSION['price_per_night'] = $room['price_per_night'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Your Stay</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>

<h2>Book Your Stay</h2>

<form method="POST" action="confirm_booking.php">

    <label>Room Type</label><br>
    <input type="text" value="<?= htmlspecialchars($room['room_type']) ?>" readonly><br><br>

    <label>Price Per Night (₹)</label><br>
    <input type="text" value="<?= $room['price_per_night'] ?>" readonly><br><br>

    <label>Full Name</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Gender</label><br>
    <select name="gender" required>
        <option value="">Select</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
    </select><br><br>

    <label>Mobile</label><br>
    <input type="text" name="mobile" pattern="[0-9]{10}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Aadhaar</label><br>
    <input type="text" name="aadhaar" pattern="[0-9]{12}" required><br><br>

    <label>Check-in</label><br>
    <input type="date" name="check_in" required><br><br>

    <label>Check-out</label><br>
    <input type="date" name="check_out" required><br><br>

    <button type="submit">Confirm Booking</button>
</form>

</body>
</html>
