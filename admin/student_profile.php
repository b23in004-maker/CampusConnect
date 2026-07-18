<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$student = $stmt->get_result()->fetch_assoc();

$email = $student['email'];

/* Events */

$events = mysqli_query($conn,
"SELECT event_name
FROM event_registration
WHERE student_email='$email'");

/* Rooms */

$rooms = mysqli_query($conn,
"SELECT room_name,status
FROM room_booking
WHERE student_email='$email'");

/* Clubs */

$clubs = mysqli_query($conn,
"SELECT club_name
FROM club_registrations
WHERE student_email='$email'");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Student Profile</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

body{

font-family:Inter;

background:#f5f3ff;

padding:40px;

}

.container{

max-width:1100px;

margin:auto;

}

.card{

background:white;

padding:25px;

border-radius:12px;

margin-bottom:25px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

}

h2{

color:#5b21b6;

margin-bottom:20px;

}

table{

width:100%;

border-collapse:collapse;

}

th{

background:#5b21b6;

color:white;

padding:12px;

}

td{

padding:12px;

border-bottom:1px solid #eee;

}

.info{

display:grid;

grid-template-columns:repeat(2,1fr);

gap:15px;

}

.info div{

padding:10px;

background:#faf8ff;

border-radius:8px;

}

.back{

display:inline-block;

margin-bottom:20px;

background:#5b21b6;

padding:12px 20px;

color:white;

text-decoration:none;

border-radius:8px;

}

</style>

</head>

<body>

<div class="container">

<a href="students.php" class="back">

← Back

</a>

<div class="card">

<h2>Student Details</h2>

<div class="info">

<div>

<b>Name</b><br>

<?php echo $student['fullname']; ?>

</div>

<div>

<b>Roll No</b><br>

<?php echo $student['rollno']; ?>

</div>

<div>

<b>Email</b><br>

<?php echo $student['email']; ?>

</div>

<div>

<b>Phone</b><br>

<?php echo $student['phone']; ?>

</div>

<div>

<b>Department</b><br>

<?php echo $student['department']; ?>

</div>

<div>

<b>Year</b><br>

<?php echo $student['year']; ?>

</div>

</div>

</div>

<div class="card">

<h2>Registered Events</h2>

<table>

<tr>

<th>Event</th>

</tr>

<?php while($row=mysqli_fetch_assoc($events)){ ?>

<tr>

<td><?php echo $row['event_name']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<div class="card">

<h2>Room Bookings</h2>

<table>

<tr>

<th>Room</th>

<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($rooms)){ ?>

<tr>

<td><?php echo $row['room_name']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<div class="card">

<h2>Joined Clubs</h2>

<table>

<tr>

<th>Club</th>

</tr>

<?php while($row=mysqli_fetch_assoc($clubs)){ ?>

<tr>

<td><?php echo $row['club_name']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>

</html>