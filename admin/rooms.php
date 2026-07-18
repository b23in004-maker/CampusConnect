<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$result=mysqli_query($conn,"
SELECT
room_booking.*,
students.fullname,
students.rollno,
students.department,
students.year
FROM room_booking
INNER JOIN students
ON room_booking.student_email=students.email
ORDER BY room_booking.id DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Room Bookings</title>

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
color:#fff;
text-align:center;
margin-bottom:35px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:14px;
margin:10px 0;
border-radius:8px;
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
box-shadow:0 5px 15px rgba(0,0,0,.1);
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

select{
padding:8px;
border-radius:6px;
}

button{
padding:8px 14px;
border:none;
border-radius:6px;
cursor:pointer;
color:white;
}

.update{
background:#28a745;
}

.delete{
background:#dc3545;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="dashboard.php">Dashboard</a>

<a href="students.php">Students</a>

<a href="events.php">Events</a>

<a href="rooms.php">Room Bookings</a>

<a href="clubs.php">Clubs</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<h1>Room Bookings</h1>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Roll No</th>
<th>Department</th>
<th>Year</th>
<th>Email</th>
<th>Room</th>
<th>Status</th>
<th>Update</th>
<th>Delete</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['rollno']; ?></td>

<td><?php echo $row['department']; ?></td>

<td><?php echo $row['year']; ?></td>

<td><?php echo $row['student_email']; ?></td>

<td><?php echo $row['room_name']; ?></td>

<!-- STATUS UPDATE -->
<td>
<form action="../actions/update_room_status.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status">

<option value="Pending" 
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Approved"
<?php if($row['status']=="Approved") echo "selected"; ?>>
Approved
</option>

<option value="Rejected"
<?php if($row['status']=="Rejected") echo "selected"; ?>>
Rejected
</option>

</select>

</td>

<td>
<button class="update" type="submit">Update</button>
</form>
</td>

<!-- DELETE -->
<td>
<form action="../actions/delete_booking.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<button class="delete" type="submit">Delete</button>
</form>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php


?>

</table>

</div>

</body>

</html>