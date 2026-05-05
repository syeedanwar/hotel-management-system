<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM rooms ORDER BY price_per_night ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Sovereign Suites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <!-- ===== HEADER ===== -->
    <header class="main-header">
        <div class="brand">
            <span class="brand-sub">THE</span>
            <span class="brand-main">Sovereign</span>
            <span class="brand-sub">Suites</span>
        </div>

        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="#location">Location</a>
            <a href="help.html">Help</a>
            <a href="login.php">Management Login</a>
        </nav>
    </header>
    <!-- ===== HERO SLIDER ===== -->
    <div class="hero-slider">

        <?php for ($i = 1; $i <= 8; $i++): ?>
            <div class="slide <?= $i === 1 ? 'active' : '' ?>"
                style="background-image:url('images/hotel<?= $i ?>.jpg')">
            </div>
        <?php endfor; ?>

        <div class="slide-text">
            <span class="slider-badge" id="sliderBadge">5★ Luxury Hotel</span>
            <h1 id="sliderTitle">Experience Royal Luxury</h1>
            <p id="sliderQuote">Comfort • Elegance • Independence</p>

            <div class="slider-features" id="sliderFeatures">
                <span>✓ Prime Location</span>
                <span>✓ Premium Rooms</span>
                <span>✓ 24×7 Service</span>
            </div>
        </div>

    </div>

    </div>

    </div>

    <!-- ===== ROOMS ===== -->
    <section class="container">
        <h2 class="section-title">Available Rooms</h2>

        <div class="room-grid">
            <?php while ($room = $result->fetch_assoc()): ?>
                <div class="room-card">
                    <span class="room-tag">Luxury Stay</span>

                    <h3><?= htmlspecialchars($room['room_type']) ?></h3>

                    <p class="price">
                        ₹<?= number_format($room['price_per_night']) ?>
                        <span>/ night</span>
                    </p>

                    <a href="room_details.php?room_id=<?= $room['id'] ?>" class="btn small">
                        View Details
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- ===== MAP ===== -->
    <section id="location" class="map-section">
        <h2 class="section-title">Our Location</h2>
        <p class="section-sub">Located in the heart of the city</p>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps?q=New+Delhi+India&output=embed"
                loading="lazy"
                allowfullscreen>
            </iframe>
        </div>
    </section>

    <footer>
        © <?= date('Y') ?> © 2026 The Sovereign Suites | Designed & Developed by Syeed Anwar
    </footer>

    <script>
        const slides = document.querySelectorAll(".slide");
        let index = 0;

        const sliderContent = [{
                badge: "5★ Luxury Hotel",
                title: "Experience Royal Luxury",
                quote: "Comfort • Elegance • Independence",
                features: ["Prime Location", "Premium Rooms", "24×7 Service"]
            },
            {
                badge: "Exclusive Stay",
                title: "Where Comfort Meets Class",
                quote: "Designed for refined travelers",
                features: ["Spacious Suites", "Luxury Interiors", "Peaceful Ambience"]
            },
            {
                badge: "Best Price Guarantee",
                title: "Luxury That Fits Your Budget",
                quote: "Affordable elegance without compromise",
                features: ["Transparent Pricing", "No Hidden Charges", "Value for Money"]
            },
            {
                badge: "Business & Leisure",
                title: "Stay Smart. Stay Stylish.",
                quote: "An experience beyond accommodation",
                features: ["High-Speed WiFi", "Business Friendly", "Central Location"]
            }
        ];

        const badge = document.getElementById("sliderBadge");
        const title = document.getElementById("sliderTitle");
        const quote = document.getElementById("sliderQuote");
        const features = document.getElementById("sliderFeatures");

        function updateText(slideIndex) {
            const data = sliderContent[slideIndex % sliderContent.length];

            badge.textContent = data.badge;
            title.textContent = data.title;
            quote.textContent = data.quote;

            features.innerHTML = "";
            data.features.forEach(item => {
                const span = document.createElement("span");
                span.textContent = "✓ " + item;
                features.appendChild(span);
            });
        }

        setInterval(() => {
            slides[index].classList.remove("active");

            index = (index + 1) % slides.length;

            slides[index].classList.add("active");

            updateText(index);
        }, 4000);
    </script>



</body>

</html>
