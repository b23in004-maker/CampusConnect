<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$joinedClubs = [];

$sql = "SELECT club_name FROM club_registrations WHERE student_email='$email'";
$result = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
    $joinedClubs[]=$row['club_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Clubs</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/clubs.css">

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

<li><a href="clubs.php" class="active">Clubs</a></li>

<li><a href="profile.php">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<section class="page-banner">

<h1>Student Clubs</h1>

<p>

Explore campus clubs and become part of a vibrant student community.

</p>

</section>

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

<section class="clubs-section">

<div class="clubs-grid">

<!-- Programming Club -->

<div class="club-card">

<i class="fa-solid fa-code"></i>

<h3>Programming Club</h3>

<p>

Enhance your coding skills through hackathons, coding contests and technical workshops.

</p>

<?php if(in_array("Programming Club",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Programming Club">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Programming Club">

<button class="btn" type="submit">

Join Club

</button>

</form>

<?php } ?>
</div>

<!-- Innovation Club -->

<div class="club-card">

<i class="fa-solid fa-flask"></i>

<h3>Innovation & Research Club</h3>

<p>

Work on innovative ideas, research projects and startup initiatives.

</p>

<?php if(in_array("Innovation & Research Club",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Innovation & Research Club">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Innovation & Research Club">

<button class="btn" type="submit">

Join Club

</button>

</form>

<?php } ?>
</div>

<!-- Women in STEM -->

<div class="club-card">

<i class="fa-solid fa-user-graduate"></i>

<h3>Women in STEM Club</h3>

<p>

Empowering women through mentorship, leadership and technical activities.

</p>

<?php if(in_array("Women in STEM Club",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Women in STEM Club">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="Women in STEM Club">

<button class="btn" type="submit">

Join Club

</button>

</form>

<?php } ?>
</div>

<!-- NCC -->

<div class="club-card">

<i class="fa-solid fa-shield-halved"></i>

<h3>NCC</h3>

<p>

Develop discipline, leadership and patriotism through National Cadet Corps activities.

</p>

<?php if(in_array("NCC",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="NCC">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="NCC">

<button class="btn" type="submit">

Join Club

</button>

</form>

<?php } ?>
</div>

<!-- NSS -->

<div class="club-card">

<i class="fa-solid fa-hand-holding-heart"></i>

<h3>NSS</h3>

<p>

Serve society through community service, awareness campaigns and volunteering.

</p>

<?php if(in_array("NSS",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="NSS">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="NSS">

<button class="btn" type="submit">

Join Club

</button>

</form>

<?php } ?>

</div>

<!-- MDF Club -->

<div class="club-card">

<i class="fa-solid fa-palette"></i>

<h3>MDF Club</h3>

<p>

Participate in dance, music, drama, fine arts and cultural festivals.

</p>

<?php if(in_array("MDF Club",$joinedClubs)){ ?>

<form action="actions/leave_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="MDF Club">

<button class="btn" type="submit">

Leave Club

</button>

</form>

<?php } else { ?>

<form action="actions/join_club.php" method="POST">

<input
type="hidden"
name="club_name"
value="MDF Club">

<button class="btn" type="submit">

Join Club

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