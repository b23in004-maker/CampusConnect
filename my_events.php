<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$sql = "SELECT * FROM event_registration
        WHERE student_email='$email'
        ORDER BY event_name DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Events | CampusConnect</title>

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

<li><a href="events.php">Events</a></li>

<li><a href="my_events.php" class="active">My Events</a></li>

<li><a href="rooms.php">Resources</a></li>

<li><a href="clubs.php">Clubs</a></li>

<li><a href="profile.php">Profile</a></li>

<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

</nav>

</header>

<section class="page-banner">

<h1>My Registered Events</h1>

<p>

These are the events you have successfully registered for.

</p>

</section>

<section class="events-section">

<div class="events-grid">

<?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="event-card">

<i class="fa-solid fa-circle-check"></i>

<h3><?php echo $row['event_name']; ?></h3>

<p>

Registered on

<?php echo date("d M Y",strtotime($row['registered_on'])); ?>

</p>

<button class="btn" disabled>

Registered ✓

</button>

</div>

<?php

}

}

else

{

?>

<div class="event-card">

<h2>No Events Registered</h2>

<p>

You haven't registered for any events yet.

</p>

<a href="events.php" class="btn">

Browse Events

</a>

</div>

<?php

}

?>

</div>

</section>

<footer>

<div class="footer-bottom">

<p>

© 2026 CampusConnect

</p>

</div>

</footer>

</body>

</html>