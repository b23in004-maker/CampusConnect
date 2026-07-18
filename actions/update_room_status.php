<?php

session_start();

if(!isset($_SESSION['admin']))
{
header("Location: ../admin/login.php");
exit();
}

include("../config/db.php");

$id=$_POST['id'];

$status=$_POST['status'];

$stmt=$conn->prepare("UPDATE room_booking SET status=? WHERE id=?");

$stmt->bind_param("si",$status,$id);

$stmt->execute();

$stmt->close();

$conn->close();

header("Location: ../admin/rooms.php");

exit();

?>