<?php
include 'db.php';

/* ===== VALIDATE ROOM ID ===== */
if (!isset($_GET['room_id']) || !is_numeric($_GET['room_id'])) {
    die("Invalid room selection");
}

$room_id = (int)$_GET['room_id'];

/* ===== FETCH ROOM ===== */
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Room not found");
}

$room = $result->fetch_assoc();

/* ===== IMAGE LOGIC ===== */
$roomType = strtolower(trim($room['room_type']));

$imageMap = [
    'single' => '/Hotel_Management_System/images/Single.jpg',
    'double' => '/Hotel_Management_System/images/double.jpg',
    'deluxe' => '/Hotel_Management_System/images/deluxe.jpg',
    'suite'  => '/Hotel_Management_System/images/suite.jpg'
];

$imagePath = $imageMap[$roomType] ?? '/Hotel_Management_System/images/default.jpg';

/* ===== ROOM QUALITY DETAILS ===== */
$roomDetails = [
    'single' => [
        'size' => '250 sq.ft',
        'capacity' => '1 Guest',
        'bed' => 'Single Bed',
        'view' => 'City View',
        'description' => 'A compact yet elegant room designed for solo travelers who value comfort and privacy.'
    ],
    'double' => [
        'size' => '350 sq.ft',
        'capacity' => '2 Guests',
        'bed' => 'Queen Bed',
        'view' => 'Garden View',
        'description' => 'Spacious and warm, ideal for couples or companions seeking relaxation.'
    ],
    'deluxe' => [
        'size' => '450 sq.ft',
        'capacity' => '2–3 Guests',
        'bed' => 'King Bed',
        'view' => 'Pool View',
        'description' => 'Refined luxury with premium interiors and a tranquil ambiance.'
    ],
    'suite' => [
        'size' => '650 sq.ft',
        'capacity' => '3–4 Guests',
        'bed' => 'King Bed + Lounge',
        'view' => 'Panoramic View',
        'description' => 'An opulent suite offering unmatched comfort, space, and exclusivity.'
    ]
];

$currentRoom = $roomDetails[$roomType] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($room['room_type']) ?> | The Sovereign Suites</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: #111;
}

/* HEADER */
.header {
    padding: 22px 60px;
    color: #fff;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 1px;
    background: rgba(0,0,0,0.4);
    backdrop-filter: blur(12px);
}

/* WRAPPER */
.wrapper {
    max-width: 1250px;
    margin: 50px auto;
    padding: 0 20px;
}

/* CARD */
.room-card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 40px 80px rgba(0,0,0,0.35);
}

/* IMAGE */
.room-image img {
    width: 100%;
    height: 480px;
    object-fit: cover;
}

/* CONTENT */
.room-content {
    display: flex;
    gap: 50px;
    padding: 50px;
}

/* LEFT */
.room-left {
    flex: 2;
}

.room-title {
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 12px;
}

.sub-text {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 25px;
}

/* HIGHLIGHTS */
.room-highlights {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
    margin-bottom: 35px;
}

.room-highlights div {
    background: linear-gradient(135deg, #f6f8fb, #e9edf3);
    padding: 16px 20px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 500;
}

/* AMENITIES */
.amenities {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.amenities div {
    background: #f1f4f9;
    padding: 14px 18px;
    border-radius: 12px;
    font-size: 14px;
}

/* RIGHT */
.room-right {
    flex: 1;
}

.price-box {
    position: sticky;
    top: 30px;
    background: linear-gradient(135deg, #ffffff, #f3f6fb);
    padding: 35px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.price {
    font-size: 40px;
    font-weight: 700;
    color: #0a2540;
}

.price span {
    font-size: 14px;
    color: #666;
}

/* BUTTON */
.book-btn {
    display: block;
    margin-top: 30px;
    padding: 18px;
    background: linear-gradient(135deg, #ff512f, #dd2476);
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.book-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(221,36,118,0.4);
}

/* MOBILE */
@media(max-width: 900px) {
    .room-content {
        flex-direction: column;
        padding: 30px;
    }
    .room-image img {
        height: 300px;
    }
}
</style>
</head>

<body>

<div class="header">The Sovereign Suites</div>

<div class="wrapper">
    <div class="room-card">

        <div class="room-image">
            <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($room['room_type']) ?>">
        </div>

        <div class="room-content">

            <div class="room-left">
                <div class="room-title"><?= htmlspecialchars($room['room_type']) ?></div>
                <div class="sub-text"><?= $currentRoom['description'] ?></div>

                <div class="room-highlights">
                    <div>📐 <?= $currentRoom['size'] ?></div>
                    <div>👥 <?= $currentRoom['capacity'] ?></div>
                    <div>🛏 <?= $currentRoom['bed'] ?></div>
                    <div>🌆 <?= $currentRoom['view'] ?></div>
                </div>

                <h3>Amenities</h3>
                <div class="amenities">
                    <?php foreach (explode(',', $room['amenities']) as $a): ?>
                        <div>✔ <?= htmlspecialchars(trim($a)) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="room-right">
                <div class="price-box">
                    <div class="price">
                        ₹<?= htmlspecialchars($room['price_per_night']) ?>
                        <span>/ night</span>
                    </div>

                    <a href="book.php?room_id=<?= $room['id'] ?>" class="book-btn">
                        Reserve This Room
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
