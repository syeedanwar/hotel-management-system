<!-- Database Setup -->

<?php
$conn = mysqli_connect(
    "sql102.infinityfree.com",   // DB Host
    "if0_41572727",              // DB Username
    "6XOkNqfUiW7UIre",             // DB Password
    "if0_41572727_hotel_db"      // DB Name
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
