<?php
session_start();
$bookingId = $_SESSION['booking_id'] ?? null;
$successMsg = $_SESSION['success_msg'] ?? null;
unset($_SESSION['success_msg']); // show only once
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .check-icon {
            font-size: 60px;
            color: #28a745;
        }

        h1 {
            margin: 15px 0 10px;
            color: #333;
        }

        p {
            color: #555;
            font-size: 15px;
        }

        .booking-id {
            background: #f4f6f8;
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: bold;
            color: #333;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #2a5298;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .btn:hover {
            background: #1e3c72;
        }

        .btn.secondary {
            background: #28a745;
        }

        .btn.secondary:hover {
            background: #1e7e34;
        }
    </style>
</head>
<body>

<div class="success-card">
    <div class="check-icon">✔</div>

    <?php if ($successMsg): ?>
        <h1>Booking Confirmed!</h1>
        <p><?= htmlspecialchars($successMsg); ?></p>

        <div class="booking-id">
            Booking ID: <?= htmlspecialchars($bookingId); ?>
        </div>

        <!-- Invoice Button -->
        <a href="invoice.php?id=<?= $bookingId; ?>" class="btn secondary">
            View / Download Invoice
        </a>

        <br>

        <!-- Back to Home or Rooms -->
        <a href="index.php" class="btn">
            Book Another Room
        </a>

    <?php else: ?>
        <h1>No Booking Found</h1>
        <p>Your booking session has expired.</p>
        <a href="index.php" class="btn">Back To Home</a>
    <?php endif; ?>
</div>

</body>
</html>
