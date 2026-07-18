<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$email=$_SESSION['email'];
$room=$_POST['room_name'];

$stmt=$conn->prepare("DELETE FROM room_booking WHERE student_email=? AND room_name=?");

$stmt->bind_param("ss",$email,$room);

if($stmt->execute())
{
    $_SESSION['success']="Room booking cancelled.";
}
else
{
    $_SESSION['error']="Unable to cancel booking.";
}

$stmt->close();
$conn->close();

header("Location: ../rooms.php");
exit();
?>