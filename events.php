<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$registeredEvents = [];

$sql = "SELECT event_name FROM event_registration WHERE student_email='$email'";
$result = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
    $registeredEvents[]=$row['event_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Events</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/events.css">

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

<li><a href="events.php" class="active">Events</a></li>

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

<section class="page-banner">

<?php

if(isset($_SESSION['success']))
{
    echo '<div class="success-message">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['warning']))
{
    echo '<div class="warning-message">'.$_SESSION['warning'].'</div>';
    unset($_SESSION['warning']);
}

if(isset($_SESSION['error']))
{
    echo '<div class="error-message">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

?>

<h1>Campus Events</h1>

<p>

Register for technical, cultural and placement events happening on campus.

</p>

</section>

<section class="events-section">

<div class="events-grid">

<!-- Event 1 -->

<div class="event-card">

<i class="fa-solid fa-robot"></i>

<h3>AI & Machine Learning Workshop</h3>

<p><strong>Date:</strong> 15 July 2026</p>

<p><strong>Venue:</strong> Silver Jubilee Seminar Hall, Block 4</p>

<p>Hands-on workshop covering AI, Machine Learning and Generative AI.</p>

<form action="actions/event_register.php" method="POST">

<input type="hidden" name="event_name" value="AI & Machine Learning Workshop">

<?php if(in_array("AI & Machine Learning Workshop",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="AI & Machine Learning Workshop">

<button class="btn">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="AI & Machine Learning Workshop">

<button class="btn">

Register

</button>

</form>

<?php } ?>

</form>

</div>

<!-- Event 2 -->

<div class="event-card">

<i class="fa-solid fa-laptop-code"></i>

<h3>24-Hour Hackathon</h3>

<p><strong>Date:</strong> 20 July 2026</p>

<p><strong>Venue:</strong> ML Lab, Block 7</p>

<p>Build innovative software solutions with your teammates.</p>

<form action="actions/event_register.php" method="POST">

<input type="hidden" name="event_name" value="24-Hour Hackathon">

<?php if(in_array("24-Hour Hackathon",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="24-Hour Hackathon">

<button class="btn" type="submit">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="24-Hour Hackathon">

<button class="btn" type="submit">

Register

</button>

</form>

<?php } ?>

</form>

</div>

<!-- Event 3 -->

<div class="event-card">

<i class="fa-solid fa-briefcase"></i>

<h3>Campus Placement Drive</h3>

<p><strong>Date:</strong> 28 July 2026</p>

<p><strong>Venue:</strong> Main Auditorium</p>

<p>Top companies visit campus for recruitment and internships.</p>

<?php if(in_array("Campus Placement Drive",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="Campus Placement Drive">

<button class="btn" type="submit">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="Campus Placement Drive">

<button class="btn" type="submit">

Register

</button>

</form>

<?php } ?>

</form>

</div>

<!-- Event 4 -->

<div class="event-card">

<i class="fa-solid fa-microphone"></i>

<h3>Technical Symposium</h3>

<p><strong>Date:</strong> 10 August 2026</p>

<p><strong>Venue:</strong> i2RE</p>

<p>Present your ideas and participate in paper presentations.</p>

<?php if(in_array("Technical Symposium",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="Technical Symposium">

<button class="btn" type="submit">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="Technical Symposium">

<button class="btn" type="submit">

Register

</button>

</form>

<?php } ?>

</form>

</div>

<!-- Event 5 -->

<div class="event-card">

<i class="fa-solid fa-medal"></i>

<h3>Sports Meet</h3>

<p><strong>Date:</strong> 18 August 2026</p>

<p><strong>Venue:</strong> College Ground</p>

<p>Participate in athletics, cricket, football and indoor games.</p>

<form action="actions/event_register.php" method="POST">

<input type="hidden" name="event_name" value="Sports Meet">

<?php if(in_array("Sports Meet",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="Sports Meet">

<button class="btn" type="submit">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="Sports Meet">

<button class="btn" type="submit">

Register

</button>

</form>

<?php } ?>
</form>

</div>

<!-- Event 6 -->

<div class="event-card">

<i class="fa-solid fa-music"></i>

<h3>Cultural Fest</h3>

<p><strong>Date:</strong> 30 August 2026</p>

<p><strong>Venue:</strong> Main Auditorium</p>

<p>Dance, music, drama and exciting cultural competitions.</p>

<form action="actions/event_register.php" method="POST">

<input type="hidden" name="event_name" value="Cultural Fest">

<?php if(in_array("Cultural Fest",$registeredEvents)){ ?>

<form action="actions/withdraw_event.php" method="POST">

<input
type="hidden"
name="event_name"
value="Cultural Fest">

<button class="btn" type="submit">

Withdraw

</button>

</form>

<?php } else { ?>

<form action="actions/event_register.php" method="POST">

<input
type="hidden"
name="event_name"
value="Cultural Fest">

<button class="btn" type="submit">

Register

</button>

</form>

<?php } ?>

</form>

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