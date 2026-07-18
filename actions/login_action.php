<?php
session_start();

include("../config/db.php");

$email = trim($_POST['email']);
$password = $_POST['password'];

// Check if user exists
$stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['rollno'] = $user['rollno'];

        header("Location: ../dashboard.php");
        exit();

    } else {

        $_SESSION['error'] = "Incorrect password.";
        header("Location: ../login.php");
        exit();

    }

} else {

    $_SESSION['error'] = "No account found with this email.";
    header("Location: ../login.php");
    exit();

}

$stmt->close();
$conn->close();
?>