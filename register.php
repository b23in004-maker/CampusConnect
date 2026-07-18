<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Register</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">

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

<li><a href="contact.php">Contact</a></li>

<li><a href="login.php" class="login-btn">Login</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<main>

<section class="register-section">

<div class="register-container">

<div class="register-left">

<h2>Join CampusConnect</h2>

<p>

Create your student account and access
events, clubs, resources and campus services.

</p>

</div>

<div class="register-right">

<h2>Create Account</h2>

<?php
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

<form action="actions/register_action.php" method="POST">

<div class="form-grid">

<div class="input-group">

<label>Full Name</label>

<input
type="text"
id="name"
name="fullname"
placeholder="Enter your full name"
required>

</div>

<div class="input-group">

<label>Roll Number</label>

<input
type="text"
id="roll"
name="rollno"
placeholder="Enter Roll Number"
required>

</div>

<div class="input-group">

<label>Email</label>

<input
type="email"
id="email"
name="email"
placeholder="Enter Email"
required>

</div>

<div class="input-group">

<label>Phone</label>

<input
type="tel"
id="phone"
name="phone"
placeholder="Enter Phone Number"
required>

</div>

<div class="input-group">

<label>Department</label>

<select
id="department"
name="department"
required>

<option value="">Select Department</option>

<option>CSE</option>
<option>IT</option>
<option>ECE</option>
<option>EEE</option>
<option>MECH</option>
<option>CSO</option>
<option>CSN</option>
<option>CSD</option>
<option>CSM</option>
<option>CIVIL</option>
<option>ECI</option>

</select>

</div>

<div class="input-group">

<label>Year</label>

<select
id="year"
name="year"
required>

<option value="">Select Year</option>

<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
<option>4th Year</option>

</select>

</div>

<div class="input-group full">

<label>Password</label>

<input
type="password"
id="password"
name="password"
placeholder="Create Password"
required>

</div>

<div class="input-group full">

<label>Confirm Password</label>

<input
type="password"
id="confirmPassword"
name="confirmPassword"
placeholder="Confirm Password"
required>

</div>

</div>

<button class="btn" type="submit">

Create Account

</button>

<p class="login-link">

Already have an account?

<a href="login.php">

Login

</a>

</p>

</form>

</div>

</div>

</section>

</main>

<footer>

<div class="footer-container">

<div class="footer-box">

<h3>CampusConnect</h3>

<p>Smart Campus Management System</p>

</div>

<div class="footer-box">

<h3>Quick Links</h3>

<a href="index.html">Home</a>

<a href="about.html">About</a>

<a href="events.php">Events</a>

<a href="contact.php">Contact</a>

</div>

<div class="footer-box">

<h3>Contact</h3>

<p>📍 KITSW Campus</p>

<p>📧 support@campusconnect.com</p>

<p>📞 +91 98765 43210</p>

</div>

</div>

<div class="footer-bottom">

<p>© 2026 CampusConnect. All Rights Reserved.</p>

</div>

</footer>

<script src="js/main.js"></script>

</body>

</html>