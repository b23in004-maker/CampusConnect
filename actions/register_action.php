<?php
session_start();

include("../config/db.php");

$fullname = trim($_POST['fullname']);
$rollno = trim($_POST['rollno']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$department = trim($_POST['department']);
$year = trim($_POST['year']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Check if passwords match
if ($password != $confirmPassword) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: ../register.php");
    exit();
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Email is already registered.";
    header("Location: ../register.php");
    exit();
}

// Check if roll number already exists
$stmt = $conn->prepare("SELECT id FROM students WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Roll Number already exists.";
    header("Location: ../register.php");
    exit();
}

// Encrypt password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert student
$stmt = $conn->prepare("INSERT INTO students (fullname, rollno, email, phone, department, year, password)
VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssss",
    $fullname,
    $rollno,
    $email,
    $phone,
    $department,
    $year,
    $hashedPassword
);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registration successful. Please login.";
    header("Location: ../login.php");
} else {
    $_SESSION['error'] = "Registration failed. Please try again.";
    header("Location: ../register.php");
}

$stmt->close();
$conn->close();
?>