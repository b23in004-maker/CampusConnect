<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$student_email = $_SESSION['email'];

if (!isset($_POST['room_name'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../rooms.php");
    exit();
}

$room_name = trim($_POST['room_name']);

// Check if already booked
$stmt = $conn->prepare("SELECT id FROM room_booking WHERE student_email = ? AND room_name = ?");
$stmt->bind_param("ss", $student_email, $room_name);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $_SESSION['warning'] = "⚠ You have already booked this resource.";

    $stmt->close();
    $conn->close();

    header("Location: ../rooms.php");
    exit();
}

$stmt->close();

// Save booking
$stmt = $conn->prepare("INSERT INTO room_booking (student_email, room_name) VALUES (?, ?)");
$stmt->bind_param("ss", $student_email, $room_name);

if ($stmt->execute()) {

    $_SESSION['success'] = "🎉 Resource Booked Successfully!";

} else {

    $_SESSION['error'] = "❌ Booking Failed.";

}

$stmt->close();
$conn->close();

header("Location: ../rooms.php");
exit();
?>