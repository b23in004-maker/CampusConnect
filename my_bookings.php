<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$sql = "SELECT * FROM room_booking
        WHERE student_email='$email'
        ORDER BY room_name DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Bookings | CampusConnect</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/rooms.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<header>

<nav class="navbar">

<div class="logo">

<i class="fa-solid fa-graduation-cap"></i>

<span>CampusConnect</span>

</div>

<ul class="nav-links">

<li><a href="dashboard.php">Dashboard</a></li>

<li><a href="events.php">Events</a></li>

<li><a href="rooms.php">Resources</a></li>

<li><a href="my_bookings.php" class="active">My Bookings</a></li>

<li><a href="clubs.php">Clubs</a></li>

<li><a href="profile.php">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

</nav>

</header>

<section class="page-banner">

<h1>My Room Bookings</h1>

<p>

These are the campus resources you have booked.

</p>

</section>

<section class="rooms-section">

<div class="rooms-grid">

<?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="room-card">

<i class="fa-solid fa-circle-check"></i>

<h3><?php echo $row['room_name']; ?></h3>

<p>

Booked on

<?php echo date("d M Y",strtotime($row['room_name'])); ?>

</p>

<button class="btn" disabled>

Booked ✓

</button>

</div>

<?php

}

}

else

{

?>

<div class="room-card">

<h2>No Bookings Found</h2>

<p>

You haven't booked any campus resources yet.

</p>

<a href="rooms.php" class="btn">

Book a Resource

</a>

</div>

<?php

}

?>

</div>

</section>

<footer>

<div class="footer-bottom">

<p>© 2026 CampusConnect</p>

</div>

</footer>

</body>

</html>