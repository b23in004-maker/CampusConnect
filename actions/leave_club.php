<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$email=$_SESSION['email'];
$club=$_POST['club_name'];

$stmt=$conn->prepare("DELETE FROM club_registrations WHERE student_email=? AND club_name=?");

$stmt->bind_param("ss",$email,$club);

if($stmt->execute())
{
    $_SESSION['success']="Club left successfully.";
}
else
{
    $_SESSION['error']="Unable to leave club.";
}

$stmt->close();
$conn->close();

header("Location: ../clubs.php");
exit();
?>