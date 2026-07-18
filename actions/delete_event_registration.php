<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: ../admin/login.php");
    exit();
}

include("../config/db.php");

$id=$_POST['id'];

$stmt=$conn->prepare("DELETE FROM event_registration WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$stmt->close();

$conn->close();

header("Location: ../admin/events.php");

exit();

?>