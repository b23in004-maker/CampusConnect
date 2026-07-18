<?php
session_start();

if(isset($_SESSION['admin']))
{
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>CampusConnect Admin Login</title>

<link rel="stylesheet" href="../css/common.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

body{

font-family:Inter;

background:#f4efff;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}

.login-box{

width:380px;

background:white;

padding:40px;

border-radius:15px;

box-shadow:0 5px 20px rgba(0,0,0,.1);

}

.login-box h2{

text-align:center;

margin-bottom:25px;

color:#6a0dad;

}

input{

width:100%;

padding:12px;

margin:12px 0;

border:1px solid #ccc;

border-radius:8px;

}

button{

width:100%;

padding:12px;

background:#6a0dad;

color:white;

border:none;

border-radius:8px;

font-size:16px;

cursor:pointer;

}

button:hover{

background:#551A8B;

}

.error{

background:#ffdddd;

color:red;

padding:10px;

margin-bottom:15px;

border-radius:8px;

text-align:center;

}

</style>

</head>

<body>

<div class="login-box">

<h2>

CampusConnect Admin

</h2>

<?php

if(isset($_SESSION['error']))
{

echo "<div class='error'>".$_SESSION['error']."</div>";

unset($_SESSION['error']);

}

?>

<form action="../actions/admin_login.php" method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button type="submit">

Login

</button>

</form>

</div>

</body>

</html>