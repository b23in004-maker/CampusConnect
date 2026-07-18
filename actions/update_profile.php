<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$email = $_SESSION['email'];

$fullname = trim($_POST['fullname']);
$phone = trim($_POST['phone']);
$department = trim($_POST['department']);
$year = trim($_POST['year']);

$stmt = $conn->prepare("UPDATE students SET fullname=?, phone=?, department=?, year=? WHERE email=?");

$stmt->bind_param(
    "sssss",
    $fullname,
    $phone,
    $department,
    $year,
    $email
);

if ($stmt->execute()) {

    $_SESSION['fullname'] = $fullname;
    $_SESSION['success'] = "Profile updated successfully.";

} else {

    $_SESSION['error'] = "Failed to update profile.";

}

$stmt->close();
$conn->close();

header("Location: ../profile.php");
exit();
?>