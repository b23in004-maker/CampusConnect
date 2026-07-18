<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");

$email = $_SESSION['email'];

$sql = "SELECT * FROM club_registrations
        WHERE student_email='$email'
        ORDER BY joined_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Clubs | CampusConnect</title>

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
<li><a href="my_bookings.php">My Bookings</a></li>
<li><a href="my_clubs.php" class="active">My Clubs</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="logout.php" class="login-btn">Logout</a></li>

</ul>

</nav>

</header>

<section class="page-banner">

<h1>My Clubs</h1>

<p>These are the clubs you have joined.</p>

</section>

<section class="rooms-section">

<div class="rooms-grid">

<?php

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

<div class="room-card">

<i class="fa-solid fa-users"></i>

<h3><?php echo $row['club_name']; ?></h3>

<p>
Joined on
<?php echo date("d M Y", strtotime($row['joined_at'])); ?>
</p>

<button class="btn" disabled>
Joined ✓
</button>

</div>

<?php

    }

} else {

?>

<div class="room-card">

<h2>No Clubs Joined</h2>

<p>You haven't joined any clubs yet.</p>

<a href="clubs.php" class="btn">
Explore Clubs
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