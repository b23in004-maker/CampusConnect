<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$result = mysqli_query($conn, "
SELECT
event_registration.id,
event_registration.event_name,
students.fullname,
students.rollno,
students.department,
students.year,
students.email
FROM event_registration
INNER JOIN students
ON event_registration.student_email = students.email
ORDER BY event_registration.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin | Event Registrations</title>

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
color:white;
text-decoration:none;
border-radius:8px;
transition:.3s;
}

.sidebar a:hover{
background:#7c3aed;
}

.main{
flex:1;
padding:35px;
}

.main h1{
color:#5b21b6;
margin-bottom:25px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

th{
background:#5b21b6;
color:white;
padding:15px;
}

td{
padding:15px;
text-align:center;
border-bottom:1px solid #eee;
}

tr:hover{
background:#f8f5ff;
}

.delete-btn{
background:#dc3545;
color:white;
border:none;
padding:8px 16px;
border-radius:6px;
cursor:pointer;
}

.delete-btn:hover{
background:#b02a37;
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

<h1>Event Registrations</h1>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Roll No</th>

<th>Department</th>

<th>Year</th>

<th>Email</th>

<th>Event</th>

<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['rollno']; ?></td>

<td><?php echo $row['department']; ?></td>

<td><?php echo $row['year']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['event_name']; ?></td>

<td>

<form action="../actions/delete_event_registration.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<button class="delete-btn">

Delete

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>