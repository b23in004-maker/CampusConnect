<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

$stmt = $conn->prepare("
SELECT *
FROM students
WHERE fullname LIKE ?
OR rollno LIKE ?
OR email LIKE ?
ORDER BY id DESC
");

$keyword = "%".$search."%";

$stmt->bind_param("sss", $keyword, $keyword, $keyword);

$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Students | Admin</title>

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

table th{

background:#5b21b6;
color:white;
padding:14px;

}

table td{

padding:14px;
text-align:center;
border-bottom:1px solid #eee;

}

table tr:hover{

background:#f8f5ff;

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

<h1>Registered Students</h1>

<form method="GET" style="margin-bottom:25px; display:flex; gap:10px;">

<input
type="text"
name="search"
placeholder="Search by Name, Roll No or Email"
value="<?php echo htmlspecialchars($search); ?>"
style="
flex:1;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;">

<button
type="submit"
style="
background:#5b21b6;
color:white;
border:none;
padding:12px 20px;
border-radius:8px;
cursor:pointer;">

Search

</button>

<a
href="students.php"
style="
background:#dc3545;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;">

Clear

</a>

</form>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Roll No</th>

<th>Email</th>

<th>Phone</th>

<th>Department</th>

<th>Year</th>

<th>Profile</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['rollno']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['department']; ?></td>

<td><?php echo $row['year']; ?></td>

<td>

<a
href="student_profile.php?id=<?php echo $row['id']; ?>"
style="
background:#5b21b6;
color:white;
padding:8px 15px;
border-radius:6px;
text-decoration:none;">

View

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>