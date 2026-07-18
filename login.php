<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect | Login</title>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/login.css">

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

<li><a href="register.php" class="login-btn">Register</a></li>

</ul>

<div id="menu">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

</header>

<main>

<section class="login-section">

<div class="login-container">

<div class="login-left">

<h2>Welcome Back!</h2>

<p>

Login to access your dashboard, manage events, clubs and campus resources.

</p>

</div>

<div class="login-right">

<h2>Student Login</h2>

<?php
if(isset($_SESSION['success'])){
    echo "<p style='color:green;font-weight:bold;'>".$_SESSION['success']."</p>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo "<p style='color:red;font-weight:bold;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>

<form action="actions/login_action.php" method="POST">

<div class="input-group">

<label>Email</label>

<input
type="email"
name="email"
placeholder="Enter your Email"
required>

</div>

<div class="input-group">

<label>Password</label>

<input
type="password"
name="password"
placeholder="Enter your Password"
required>

</div>

<button class="btn" type="submit">

Login

</button>

<p class="login-link">

Don't have an account?

<a href="register.php">

Register

</a>

</p>

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