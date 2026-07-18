<?php
session_start();

include("../config/db.php");

$username=$_POST['username'];
$password=$_POST['password'];

$stmt=$conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");

$stmt->bind_param("ss",$username,$password);

$stmt->execute();

$result=$stmt->get_result();

if($result->num_rows==1)
{
    $_SESSION['admin']=$username;

    header("Location: ../admin/dashboard.php");
}
else
{
    $_SESSION['error']="Invalid Username or Password";

    header("Location: ../admin/login.php");
}

$stmt->close();
$conn->close();
exit();
?>