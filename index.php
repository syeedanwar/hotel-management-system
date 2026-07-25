<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM rooms ORDER BY price_per_night ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Sovereign Suites</title>
    <link rel="stylesheet" href="index.css">

    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <header class="main-header">
        <div class="brand">
            <span class="brand-sub">THE</span>
            <span class="brand-main">Sovereign</span>
            <span class="brand-sub">Suites</span>
        </div>

        <button class="hamburger" id="hamburger" aria-label="Toggle Navigation">
            ☰
        </button>

        <nav class="nav-links" id="navLinks">
            <a href="index.php">Home</a>
            <a href="help.html">Help</a>
            <a href="login.php">Management Login</a>
        </nav>
    </header>

    <div class="hero-slider">
        <?php for ($i = 1; $i <= 8; $i++): ?>
            <div class="slide <?= $i === 1 ? 'active' : '' ?>"
                style="background-image: url('/Hotel_Management_System/images/hotel<?= $i ?>.jpg');">
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

    <section class="showcase-section">
        <h2 class="section-title">Explore Our Luxury Spaces</h2>

        <div class="card-slider">
            <button class="slider-btn prev">&#10094;</button>

            <div class="card-track">

                <div class="show-card">
                    <img src="images/hotel2.jpg" alt="Royal Suite">
                    <div class="card-content">
                        <h3>Royal Suite</h3>
                        <p>
                            Experience ultimate luxury with elegant interiors,
                            king-size bedding, premium amenities and breathtaking ambience.
                        </p>
                        <a href="#" class="btn small">Explore</a>
                    </div>
                </div>

                <div class="show-card">
                    <img src="images/hotel3.jpg" alt="Deluxe Room">
                    <div class="card-content">
                        <h3>Deluxe Room</h3>
                        <p>
                            Perfect for business and leisure travelers seeking
                            modern comfort with stylish décor.
                        </p>
                        <a href="#" class="btn small">Explore</a>
                    </div>
                </div>

                <div class="show-card">
                    <img src="images/hotel4.jpg" alt="Premium Lounge">
                    <div class="card-content">
                        <h3>Premium Lounge</h3>
                        <p>
                            Relax in our exclusive lounge offering elegant seating,
                            refreshments and luxury surroundings.
                        </p>
                        <a href="#" class="btn small">Explore</a>
                    </div>
                </div>

                <div class="show-card">
                    <img src="images/hotel5.jpg" alt="Fine Dining Restaurant">
                    <div class="card-content">
                        <h3>Fine Dining</h3>
                        <p>
                            Savor world-class cuisine prepared by expert chefs in a
                            sophisticated dining environment.
                        </p>
                        <a href="#" class="btn small">Explore</a>
                    </div>
                </div>

                <div class="show-card">
                    <img src="images/hotel6.jpg" alt="Infinity Pool">
                    <div class="card-content">
                        <h3>Infinity Pool</h3>
                        <p>
                            Enjoy a refreshing swim while admiring panoramic city
                            views in our luxurious pool area.
                        </p>
                        <a href="#" class="btn small">Explore</a>
                    </div>
                </div>

            </div>

            <button class="slider-btn next">&#10095;</button>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="contact-container">
            <div class="contact-header">
                <span class="brand-sub">GET IN TOUCH</span>
                <h2 class="section-title">We’re Here to Help Your Stay</h2>
                <p>Have questions about reservations, special events, or tailored amenities? Send us a message and our concierge team will respond within 24 hours.</p>
            </div>

            <div class="contact-wrapper">
                <!-- Contact Info Cards -->
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-icon">&#128205;</div>
                        <div>
                            <h3>Location</h3>
                            <p>In the Heart of the City<br>Patna</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">&#128222;</div>
                        <div>
                            <h3>Reservations & Support</h3>
                            <p>Direct: +91-9262534723</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">&#128231;</div>
                        <div>
                            <h3>Email Us</h3>
                            <p>syeed7015@gmail.com</p>
                        </div>
                    </div>
                </div>

                <!-- Booking / General Contact Form -->
                <form class="contact-form" onsubmit="event.preventDefault(); alert('Thank you! Your message has been sent.');">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" placeholder="xyz" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="xyz@example.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" placeholder="+91-xxxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="inquiry">Inquiry Type</label>
                            <select id="inquiry">
                                <option value="room-booking">Room Reservation</option>
                                <option value="special-event">Events & Weddings</option>
                                <option value="general">General Question</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" rows="5" placeholder="Tell us about your arrival date, preferences, or any questions..." required></textarea>
                    </div>

                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>
    <footer>
        © <?= date('Y') ?> The Sovereign Suites | Designed & Developed by QuadStack
    </footer>

    <script>
        const hamburger = document.getElementById("hamburger");
        const navLinks = document.getElementById("navLinks");

        hamburger.addEventListener("click", () => {
            navLinks.classList.toggle("active");
            hamburger.textContent = navLinks.classList.contains("active") ? "✕" : "☰";
        });

        document.querySelectorAll(".nav-links a").forEach(link => {
            link.addEventListener("click", () => {
                navLinks.classList.remove("active");
                hamburger.textContent = "☰";
            });
        });

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

        const track = document.querySelector(".card-track");
        const next = document.querySelector(".next");
        const prev = document.querySelector(".prev");

        if (track && next && prev) {
            next.addEventListener("click", () => {
                track.scrollBy({
                    left: 360,
                    behavior: "smooth"
                });
            });

            prev.addEventListener("click", () => {
                track.scrollBy({
                    left: -360,
                    behavior: "smooth"
                });
            });

            setInterval(() => {
                if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 5) {
                    track.scrollTo({
                        left: 0,
                        behavior: "smooth"
                    });
                } else {
                    track.scrollBy({
                        left: 360,
                        behavior: "smooth"
                    });
                }
            }, 4000);
        }
    </script>

</body>

</html>
