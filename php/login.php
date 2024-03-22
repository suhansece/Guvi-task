<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(empty($_POST['email']) || empty($_POST['password'])){
    echo "<h2>Please fill out the form</h2>";
    exit;
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' LIMIT 1");
if(mysqli_num_rows($user) > 0){
    $row = mysqli_fetch_assoc($user);
    if(password_verify($password, $row['password'])){ // verify password hash
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["id"];
        $response = array("status" => "success", "message" => "Login Successful");
        echo json_encode($response);
        exit();
    }
    else{
        $response = array("status" => "error", "message" => "Wrong Password");
        echo json_encode($response);
        exit;
    }
}
else{
    $response = array("status" => "error", "message" => "User not registered");
    echo json_encode($response);
    exit;
}

mysqli_close($conn);
?>
