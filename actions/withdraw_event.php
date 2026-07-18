<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$email = $_SESSION['email'];
$event = $_POST['event_name'];

$stmt = $conn->prepare("DELETE FROM event_registration WHERE student_email=? AND event_name=?");
$stmt->bind_param("ss",$email,$event);

if($stmt->execute())
{
    $_SESSION['success']="Event registration withdrawn successfully.";
}
else
{
    $_SESSION['error']="Unable to withdraw registration.";
}

$stmt->close();
$conn->close();

header("Location: ../events.php");
exit();
?>