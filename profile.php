<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

/* Student Details */
$stmt = $conn->prepare("SELECT * FROM students WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

/* Registered Events */
$events = $conn->prepare("
SELECT id,event_name
FROM event_registration
WHERE student_email=?
");
$events->bind_param("s",$email);
$events->execute();
$eventsResult = $events->get_result();

/* Room Bookings */
$rooms = $conn->prepare("
SELECT id,room_name,status
FROM room_booking
WHERE student_email=?
");
$rooms->bind_param("s",$email);
$rooms->execute();
$roomsResult = $rooms->get_result();

/* Joined Clubs */
$clubs = $conn->prepare("
SELECT id,club_name
FROM club_registrations
WHERE student_email=?
");
$clubs->bind_param("s",$email);
$clubs->execute();
$clubsResult = $clubs->get_result();
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Profile</title>

<link rel="stylesheet" href="css/common.css">

<link rel="stylesheet" href="css/profile.css">

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

<li><a href="clubs.php">Clubs</a></li>

<li><a href="profile.php" class="active">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<main>

<section class="profile-section">

<div class="profile-container">

<div class="profile-card">

<h2>Student Profile</h2>

<form action="actions/update_profile.php" method="POST">

<div class="input-group">

<label>Full Name</label>

<input
type="text"
name="fullname"
value="<?php echo htmlspecialchars($student['fullname']); ?>"
required>

</div>

<div class="input-group">

<label>Roll Number</label>

<input
type="text"
name="rollno"
value="<?php echo htmlspecialchars($student['rollno']); ?>"
readonly>

</div>

<div class="input-group">

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($student['email']); ?>"
readonly>

</div>

<div class="input-group">

<label>Phone Number</label>

<input
type="tel"
name="phone"
value="<?php echo htmlspecialchars($student['phone']); ?>"
required>

</div>

<div class="input-group">

<label>Department</label>

<select name="department">

<option <?php if($student['department']=="CSE") echo "selected"; ?>>CSE</option>

<option <?php if($student['department']=="IT") echo "selected"; ?>>IT</option>

<option <?php if($student['department']=="ECE") echo "selected"; ?>>ECE</option>

<option <?php if($student['department']=="EEE") echo "selected"; ?>>EEE</option>

<option <?php if($student['department']=="MECH") echo "selected"; ?>>MECH</option>

<option <?php if($student['department']=="CIVIL") echo "selected"; ?>>CIVIL</option>

<option <?php if($student['department']=="ECI") echo "selected"; ?>>ECI</option>

<option <?php if($student['department']=="CSN") echo "selected"; ?>>CSN</option>

<option <?php if($student['department']=="CSM") echo "selected"; ?>>CSM</option>

<option <?php if($student['department']=="CSD") echo "selected"; ?>>CSD</option>

</select>

</div>

<div class="input-group">

<label>Year</label>

<select name="year">

<option <?php if($student['year']=="1st Year") echo "selected"; ?>>1st Year</option>

<option <?php if($student['year']=="2nd Year") echo "selected"; ?>>2nd Year</option>

<option <?php if($student['year']=="3rd Year") echo "selected"; ?>>3rd Year</option>

<option <?php if($student['year']=="4th Year") echo "selected"; ?>>4th Year</option>

</select>

</div>

<button class="btn" type="submit">

Update Profile

</button>

</form>

<hr style="margin:40px 0;">

<h2>My Registered Events</h2>

<table class="activity-table">

<tr>
<th>Event</th>
<th>Action</th>
</tr>

<?php while($row = $eventsResult->fetch_assoc()) { ?>

<tr>

<td><?php echo htmlspecialchars($row['event_name']); ?></td>

<td>
<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="<?php echo $row['event_name']; ?>">

<button class="btn btn-danger" type="submit">

Withdraw

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

<br><br>

<h2>My Room Bookings</h2>

<table class="activity-table">

<tr>

<th>Room</th>

<th>Status</th>

<th>Action</th>

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

<td>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<button class="btn btn-danger">

Cancel Booking

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

<br><br>

<h2>My Joined Clubs</h2>

<table class="activity-table">

<tr>

<th>Club</th>

<th>Action</th>

</tr>

<?php while($row = $clubsResult->fetch_assoc()) { ?>

<tr>

<td>

<?php echo htmlspecialchars($row['club_name']); ?>

</td>

<td>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<button class="btn btn-danger">

Leave Club

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

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