<?php
session_start();
include 'db.php';

/* ================= GET BOOKING ID ================= */
$booking_id = $_GET['booking_id'] ?? $_SESSION['booking_id'] ?? null;

if (!$booking_id) {
    die("No booking found");
}

/* ================= FETCH BOOKING ================= */
$stmt = $conn->prepare("
    SELECT *
    FROM bookings
    WHERE id = ?
");

$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Invalid booking ID");
}

/* ================= CALCULATE NIGHTS ================= */
$check_in  = new DateTime($booking['check_in']);
$check_out = new DateTime($booking['check_out']);
$nights    = $check_in->diff($check_out)->days;

$rate  = $booking['price_per_night'];
$total = $booking['total_price'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>The Sovereign Suites | Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;500&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #111, #333);
            font-family: 'Poppins', sans-serif;
        }

        .invoice-box {
            width: 900px;
            margin: 40px auto;
            background: #ffffff;
            padding: 45px;
            border-radius: 14px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
        }

        h1 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            margin-bottom: 5px;
            color: #111;
            letter-spacing: 1px;
        }

        .subtitle {
            text-align: center;
            color: #b89b5e;
            font-size: 16px;
            letter-spacing: 2px;
            margin-bottom: 35px;
        }

        .info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px 40px;
            margin-bottom: 30px;
        }

        .info p {
            margin: 6px 0;
            font-size: 14px;
            color: #333;
        }

        .info strong {
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 15px;
        }

        table th {
            background: #111;
            color: #fff;
            padding: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
        }

        table td {
            border-bottom: 1px solid #ddd;
            padding: 14px;
            text-align: center;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .grand-total {
            text-align: right;
            margin-top: 25px;
            font-size: 24px;
            font-weight: 600;
            color: #111;
        }

        .grand-total strong {
            color: #b89b5e;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 14px 28px;
            background: linear-gradient(135deg, #000, #444);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-size: 14px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(135deg, #b89b5e, #8f743c);
            color: #000;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
            font-size: 13px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        /* PRINT FRIENDLY */
        @media print {
            body {
                background: none;
            }

            .btn {
                display: none;
            }

            .invoice-box {
                box-shadow: none;
                margin: 0;
                width: 100%;
            }
        }
    </style>

</head>

<body>

    <div class="invoice-box">
        <h1>The Sovereign Suites</h1>
        <div class="subtitle">Luxury Hotel Invoice</div>

        <div class="info">
            <p><strong>Invoice ID:</strong> <?= $booking_id ?></p>
            <p><strong>Guest Name:</strong> <?= htmlspecialchars($booking['full_name']) ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($booking['gender']) ?></p>
            <p><strong>Mobile:</strong> <?= htmlspecialchars($booking['mobile']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
            <p><strong>Room Type:</strong> <?= htmlspecialchars($booking['room_type']) ?></p>
            <p><strong>Check-in:</strong> <?= $booking['check_in'] ?></p>
            <p><strong>Check-out:</strong> <?= $booking['check_out'] ?></p>
            <p><strong>Total Nights:</strong> <?= $nights ?></p>
        </div>

        <table>
            <tr>
                <th>Description</th>
                <th>Nights</th>
                <th>Rate</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>Room Stay</td>
                <td><?= $nights ?></td>
                <td>₹<?= $rate ?></td>
                <td>₹<?= $total ?></td>
            </tr>
        </table>

        <div class="grand-total">
            <strong>Grand Total: ₹<?= $total ?></strong>
        </div>

        <a href="invoice.php?booking_id=<?= $booking_id ?>" onclick="window.print()" class="btn">
            Download / Print
        </a>

        <div class="footer">
            Thank you for choosing The Sovereign Suites.<br>
            We look forward to serving you again.
        </div>
    </div>

</body>

</html>