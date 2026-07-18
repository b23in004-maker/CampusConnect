<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Total Students
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$students = mysqli_fetch_assoc($result)['total'];

// Total Event Registrations
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM event_registration");
$events = mysqli_fetch_assoc($result)['total'];

// Total Room Bookings
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM room_booking");
$rooms = mysqli_fetch_assoc($result)['total'];

// Total Club Members
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM club_registrations");
$clubs = mysqli_fetch_assoc($result)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusConnect Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,sans-serif;
}

body{
display:flex;
background:#f4f2ff;
}

/* Sidebar */

.sidebar{

width:250px;

background:#5b21b6;

min-height:100vh;

padding:25px;

}

.sidebar h2{

color:white;

text-align:center;

margin-bottom:40px;

}

.sidebar a{

display:block;

padding:14px;

margin:12px 0;

text-decoration:none;

color:white;

border-radius:8px;

transition:.3s;

}

.sidebar a:hover{

background:#7c3aed;

}

/* Main */

.main{

flex:1;

padding:35px;

}

.main h1{

color:#5b21b6;

margin-bottom:30px;

}

.cards{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

gap:25px;

}

.card{

background:white;

padding:30px;

border-radius:12px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

text-align:center;

}

.card i{

font-size:40px;

color:#7c3aed;

margin-bottom:15px;

}

.card h2{

font-size:35px;

color:#5b21b6;

}

.card p{

margin-top:10px;

color:#666;

}

.footer{

margin-top:50px;

text-align:center;

color:#888;

}

</style>

</head>

<body>

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>

<a href="students.php"><i class="fa-solid fa-users"></i> Students</a>

<a href="events.php"><i class="fa-solid fa-calendar"></i> Events</a>

<a href="rooms.php"><i class="fa-solid fa-building"></i> Room Bookings</a>

<a href="clubs.php"><i class="fa-solid fa-user-group"></i> Clubs</a>

<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>

</div>

<div class="main">

<h1>

Welcome Admin 👋

</h1>

<div class="cards">

<div class="card">

<i class="fa-solid fa-user-graduate"></i>

<h2><?php echo $students; ?></h2>

<p>Total Students</p>

</div>

<div class="card">

<i class="fa-solid fa-calendar-check"></i>

<h2><?php echo $events; ?></h2>

<p>Event Registrations</p>

</div>

<div class="card">

<i class="fa-solid fa-building"></i>

<h2><?php echo $rooms; ?></h2>

<p>Room Bookings</p>

</div>

<div class="card">

<i class="fa-solid fa-users"></i>

<h2><?php echo $clubs; ?></h2>

<p>Club Members</p>

</div>

</div>

<div class="footer">

© 2026 CampusConnect Admin Portal

</div>

</div>

</body>

</html>