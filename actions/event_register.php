<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$student_email = $_SESSION['email'];

if (!isset($_POST['event_name'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../events.php");
    exit();
}

$event_name = trim($_POST['event_name']);

// Check if already registered
$stmt = $conn->prepare("SELECT id FROM event_registration WHERE student_email = ? AND event_name = ?");
$stmt->bind_param("ss", $student_email, $event_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $_SESSION['warning'] = "⚠ You have already registered for this event.";

    $stmt->close();
    $conn->close();

    header("Location: ../events.php");
    exit();
}

$stmt->close();

// Register event
$stmt = $conn->prepare("INSERT INTO event_registration (student_email, event_name) VALUES (?, ?)");
$stmt->bind_param("ss", $student_email, $event_name);

if ($stmt->execute()) {

    $_SESSION['success'] = "🎉 Event Registered Successfully!";

} else {

    $_SESSION['error'] = "❌ Registration Failed.";

}

$stmt->close();
$conn->close();

header("Location: ../events.php");
exit();
?>