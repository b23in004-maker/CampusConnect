```php
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

/* Logged-in Student Details */
$stmt = $conn->prepare("SELECT * FROM students WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

/* Registered Events */
$events = $conn->prepare("
SELECT event_name
FROM event_registration
WHERE student_email=?
");
$events->bind_param("s", $email);
$events->execute();
$eventsResult = $events->get_result();
$eventCount = $eventsResult->num_rows;

/* Room Bookings */
$rooms = $conn->prepare("
SELECT room_name,status
FROM room_booking
WHERE student_email=?
");
$rooms->bind_param("s", $email);
$rooms->execute();
$roomsResult = $rooms->get_result();
$roomCount = $roomsResult->num_rows;

/* Joined Clubs */
$clubs = $conn->prepare("
SELECT club_name
FROM club_registrations
WHERE student_email=?
");
$clubs->bind_param("s", $email);
$clubs->execute();
$clubsResult = $clubs->get_result();
$clubCount = $clubsResult->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Dashboard</title>

<link rel="stylesheet" href="css/common.css">

<link rel="stylesheet" href="css/dashboard.css">

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

<li><a href="dashboard.php" class="active">Dashboard</a></li>

<li><a href="events.php">Events</a></li>

<li><a href="rooms.php">Resources</a></li>

<li><a href="clubs.php">Clubs</a></li>

<li><a href="profile.php">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<main>

<section class="dashboard">

<h1>

Welcome,
<?php echo htmlspecialchars($student['fullname']); ?> 👋

</h1>

<p>

Manage your campus activities from one place.

</p>

<div class="dashboard-grid">

<div class="card">

<i class="fa-solid fa-calendar-days"></i>

<h3>My Events</h3>

<p>

<?php echo $eventCount; ?> Registered Events

</p>


</div>

<div class="card">

<i class="fa-solid fa-building"></i>

<h3>Room Bookings</h3>

<p>

<?php echo $roomCount; ?> Active Bookings

</p>



</div>

<div class="card">

<i class="fa-solid fa-users"></i>

<h3>Student Clubs</h3>

<p>

<?php echo $clubCount; ?> Joined Clubs

</p>


</div>

<div class="card">

<i class="fa-solid fa-user"></i>

<h3>Profile</h3>

<p>

Update your details

</p>

<a href="profile.php" class="btn">

Open

</a>

</div>

</div>

</section>

<section class="announcements">

<h2>

Latest Announcements

</h2>

<div class="announcement">

<h3>Placement Drive</h3>

<p>

TCS Campus Recruitment starts on 25 July 2026.

</p>

</div>

<div class="announcement">

<h3>Hackathon</h3>

<p>

24-Hour National Hackathon registrations are open.

</p>

</div>

<div class="announcement">

<h3>Library Notice</h3>

<p>

Digital Library access is now available 24×7.

</p>

</div>

</section>

<section class="dashboard-details">

<h2>My Registered Events</h2>

<table>

<tr>

<th>Event</th>

</tr>

<?php while($row = $eventsResult->fetch_assoc()) { ?>

<tr>

<td><?php echo htmlspecialchars($row['event_name']); ?></td>

</tr>

<?php } ?>

</table>

<br><br>

<h2>My Room Bookings</h2>

<table>

<tr>

<th>Room</th>

<th>Status</th>

</tr>

<?php while($row = $roomsResult->fetch_assoc()) { ?>

<tr>

<td>

<?php echo htmlspecialchars($row['room_name']); ?>

</td>

<td>

<?php

if($row['status']=="Approved")
{
    echo "<span style='color:green;font-weight:bold;'>Approved</span>";
}
elseif($row['status']=="Rejected")
{
    echo "<span style='color:red;font-weight:bold;'>Rejected</span>";
}
else
{
    echo "<span style='color:orange;font-weight:bold;'>Pending</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

<br><br>

<h2>My Clubs</h2>

<table>

<tr>

<th>Club</th>

</tr>

<?php while($row = $clubsResult->fetch_assoc()) { ?>

<tr>

<td>

<?php echo htmlspecialchars($row['club_name']); ?>

</td>

</tr>

<?php } ?>

</table>

</section>

</main>

<footer>

<div class="footer-bottom">

<p>

© 2026 CampusConnect. All Rights Reserved.

</p>

</div>

</footer>

<script src="js/main.js"></script>

</body>

</html>
