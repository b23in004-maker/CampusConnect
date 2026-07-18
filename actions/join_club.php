<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$student_email = $_SESSION['email'];

if (!isset($_POST['club_name'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../clubs.php");
    exit();
}

$club_name = trim($_POST['club_name']);

// Check if already joined
$stmt = $conn->prepare("SELECT id FROM club_registrations WHERE student_email = ? AND club_name = ?");
$stmt->bind_param("ss", $student_email, $club_name);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $_SESSION['warning'] = "⚠ You have already joined this club.";

    $stmt->close();
    $conn->close();

    header("Location: ../clubs.php");
    exit();
}

$stmt->close();

// Join Club
$stmt = $conn->prepare("INSERT INTO club_registrations (student_email, club_name) VALUES (?, ?)");

$stmt->bind_param("ss", $student_email, $club_name);

if ($stmt->execute()) {

    $_SESSION['success'] = "🎉 Club Joined Successfully!";

} else {

    $_SESSION['error'] = "❌ Unable to join the club.";

}

$stmt->close();
$conn->close();

header("Location: ../clubs.php");
exit();

?>