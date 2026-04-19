<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard | The Sovereign Suites</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    margin: 0;
    font-family: "Segoe UI", Roboto, Arial, sans-serif;
    background: #f4f6fb;
    color: #222;
}

/* ===== HEADER ===== */
.admin-header {
    background: linear-gradient(135deg, #0a2540, #1b3a57);
    color: #fff;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.admin-header h2 {
    margin: 0;
    font-size: 22px;
}

.admin-header a {
    color: #fff;
    text-decoration: none;
    background: rgba(255,255,255,0.15);
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
}

.admin-header a:hover {
    background: rgba(255,255,255,0.3);
}

/* ===== CONTENT ===== */
.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
}

.section-title {
    font-size: 22px;
    margin-bottom: 20px;
}

/* ===== TABLE ===== */
.table-wrapper {
    background: #fff;
    border-radius: 12px;
    overflow-x: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

thead {
    background: #0a2540;
    color: #fff;
}

th, td {
    padding: 14px 16px;
    text-align: left;
    font-size: 14px;
}

th {
    font-weight: 600;
    letter-spacing: 0.5px;
}

tbody tr {
    border-bottom: 1px solid #eee;
}

tbody tr:hover {
    background: #f7f9fc;
}

.price {
    font-weight: 700;
    color: #0a2540;
}

/* ===== BUTTON ===== */
.invoice-btn {
    background: #ff5a5f;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.invoice-btn:hover {
    background: #e0484d;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
}
</style>
</head>

<body>

<div class="admin-header">
    <h2>Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h3 class="section-title">Bookings</h3>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Guest Name</th>
                    <th>Room</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Aadhaar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total</th>
                    <th>Invoice</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td><?= htmlspecialchars($row['room_type']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td><?= htmlspecialchars($row['mobile']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['aadhaar']) ?></td>
                    <td><?= htmlspecialchars($row['check_in']) ?></td>
                    <td><?= htmlspecialchars($row['check_out']) ?></td>
                    <td class="price">₹<?= number_format($row['total_price']) ?></td>
                    <td>
                        <a class="invoice-btn" href="invoice.php?id=<?= $row['id'] ?>" target="_blank">
                            Download
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
