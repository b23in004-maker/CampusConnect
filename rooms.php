<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$bookedRooms = [];

$sql = "SELECT room_name FROM room_booking WHERE student_email='$email'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $bookedRooms[] = $row['room_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Resources</title>

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

<li><a href="rooms.php" class="active">Resources</a></li>

<li><a href="clubs.php">Clubs</a></li>

<li><a href="profile.php">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

<div id="menu">
<i class="fa-solid fa-bars"></i>
</div>

</nav>

</header>

<section class="page-banner">

<h1>Campus Resources</h1>

<p>

Reserve laboratories, seminar halls, auditoriums and meeting rooms online.

</p>

</section>

<?php
if(isset($_SESSION['success'])){
    echo '<div class="success-message">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['warning'])){
    echo '<div class="warning-message">'.$_SESSION['warning'].'</div>';
    unset($_SESSION['warning']);
}

if(isset($_SESSION['error'])){
    echo '<div class="error-message">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>

<section class="rooms-section">

<div class="rooms-grid">

<!-- Room 1 -->

<div class="room-card">

<i class="fa-solid fa-building"></i>

<h3>Civil Seminar Hall</h3>

<p>Capacity: 300 Students</p>

<p>Projector & Audio System Available</p>

<?php if(in_array("Civil Seminar Hall",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Civil Seminar Hall">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Civil Seminar Hall">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>
</div>

<!-- Room 2 -->

<div class="room-card">

<i class="fa-solid fa-computer"></i>

<h3>PSD Computer Lab, Block 4</h3>

<p>Capacity: 60 Students</p>

<p>Internet & Programming Software</p>

<?php if(in_array("PSD Computer Lab, Block 4",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="PSD Computer Lab, Block 4">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="PSD Computer Lab, Block 4">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>

</div>

<!-- Room 3 -->

<div class="room-card">

<i class="fa-solid fa-flask"></i>

<h3>WT Lab, Block 5</h3>

<p>Capacity: 80 Students</p>

<p>AI & IoT Development Lab</p>

<?php if(in_array("WT Lab, Block 5",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="WT Lab, Block 5">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="WT Lab, Block 5">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>

</div>

<!-- Room 4 -->

<div class="room-card">

<i class="fa-solid fa-chalkboard"></i>

<h3>Smart Classroom</h3>

<p>Capacity: 70 Students</p>

<p>Interactive Smart Board Available</p>

<?php if(in_array("Smart Classroom",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Smart Classroom">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Smart Classroom">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>

</div>

<!-- Room 5 -->

<div class="room-card">

<i class="fa-solid fa-users"></i>

<h3>New Seminar Hall</h3>

<p>Capacity: 300 Members</p>

<p>Ideal for Workshops & Events</p>

<?php if(in_array("New Seminar Hall",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="New Seminar Hall">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="New Seminar Hall">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>

</div>

<!-- Room 6 -->

<div class="room-card">

<i class="fa-solid fa-landmark"></i>

<h3>Auditorium</h3>

<p>Capacity: 1000 Students</p>

<p>Suitable for Large Events</p>
<?php if(in_array("Auditorium",$bookedRooms)){ ?>

<form action="actions/cancel_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Auditorium">

<button class="btn" type="submit">

Cancel Booking

</button>

</form>

<?php } else { ?>

<form action="actions/room_booking.php" method="POST">

<input
type="hidden"
name="room_name"
value="Auditorium">

<button class="btn" type="submit">

Book Now

</button>

</form>

<?php } ?>

</div>

</div>

</section>

<footer>

<div class="footer-bottom">

<p>

© 2026 CampusConnect. All Rights Reserved.

</p>

</div>

</footer>

<script src="js/main.js"></script>

<script>

setTimeout(function(){

let success=document.querySelector(".success-message");

let warning=document.querySelector(".warning-message");

let error=document.querySelector(".error-message");

if(success){
success.style.display="none";
}

if(warning){
warning.style.display="none";
}

if(error){
error.style.display="none";
}

},3000);

</script>

</body>


</body>

</html>