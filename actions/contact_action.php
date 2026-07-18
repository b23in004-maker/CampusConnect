<?php
session_start();

include("../config/db.php");

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");

$stmt->bind_param(
    "ssss",
    $name,
    $email,
    $subject,
    $message
);

if ($stmt->execute()) {

    $_SESSION['success'] = "Your message has been sent successfully.";

} else {

    $_SESSION['error'] = "Unable to send your message.";

}

$stmt->close();
$conn->close();

header("Location: ../contact.php");
exit();

?>