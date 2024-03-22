<?php
use MongoDB\BSON\ObjectId;
use MongoDB\Client;

session_start();

// Instantiate MongoDB client
$conn = new Client('mongodb+srv://suganth:9789625779@cluster0.qt4i9vq.mongodb.net/signup?retryWrites=true&w=majority');
$db = $conn->mydatabase;
$collection = $db->users;
$user_id = $_SESSION['id']; // Assuming you store user ID in session

// Check if user ID is valid
if (!isset($user_id) || empty($user_id)) {
    die('User ID not found');
}

$user = $collection->findOne(['_id' => new ObjectId($user_id)]);
if (!$user) {
    die('User not found');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_data = [
        '$set' => [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'img' => $_POST['img'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address']
        ]
    ];
    $collection->updateOne(['_id' => new ObjectId($user_id)], $update_data);
    // You might want to redirect here
    header("Location: profile.html");
    exit();
}
?>
