<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle POST data
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password1'])) {
    echo "Please fill in all the fields";
    exit;
}

if ($_POST['password1'] != $_POST['password2']) {
    echo "Passwords do not match";
    exit;
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password1 = mysqli_real_escape_string($conn, $_POST['password1']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);

// Check if username or email already exist
$user = mysqli_query($conn, "SELECT * FROM user WHERE name = '$name'");
if (mysqli_num_rows($user) > 0) {
    echo "Username has already been taken";
    exit;
}

$user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
if (mysqli_num_rows($user) > 0) {
    echo "Email has already been taken";
    exit;
}

// Hash the password
$hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

// Insert new user with hashed password
$query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
if (mysqli_query($conn, $query)) {
    echo "Registration Successful";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>