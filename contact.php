<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Contact</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/contact.css">

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

<li><a href="index.html">Home</a></li>

<li><a href="about.html">About</a></li>

<li><a href="events.php">Events</a></li>

<li><a href="rooms.php">Resources</a></li>

<li><a href="clubs.php">Clubs</a></li>

<li><a href="contact.php" class="active">Contact</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<section class="page-banner">

<h1>Contact Us</h1>

<p>

We're here to help. Reach out to us for any queries or support.

</p>

</section>

<section class="contact-section">

<div class="contact-container">

<div class="contact-info">

<h2>Get in Touch</h2>

<div class="info-box">

<i class="fa-solid fa-location-dot"></i>

<div>

<h4>Address</h4>

<p>KITSW Campus, Hasanparthy, Warangal, Telangana</p>

</div>

</div>

<div class="info-box">

<i class="fa-solid fa-envelope"></i>

<div>

<h4>Email</h4>

<p>support@campusconnect.com</p>

</div>

</div>

<div class="info-box">

<i class="fa-solid fa-phone"></i>

<div>

<h4>Phone</h4>

<p>+91 98765 43210</p>

</div>

</div>

</div>

<div class="contact-form">

<h2>Send a Message</h2>

<?php

session_start();

if(isset($_SESSION['success']))
{
    echo "<p style='color:green;font-weight:bold;'>".$_SESSION['success']."</p>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['error']))
{
    echo "<p style='color:red;font-weight:bold;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}

?>

<form action="actions/contact_action.php" method="POST">

<input
type="text"
name="name"
placeholder="Your Name"
required>

<input
type="email"
name="email"
placeholder="Your Email"
required>

<input
type="text"
name="subject"
placeholder="Subject"
required>

<textarea
name="message"
rows="6"
placeholder="Write your message..."
required></textarea>

<button class="btn" type="submit">

Send Message

</button>

</form>

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

</body>

</html>