<?php
session_start();
include_once __DIR__ . '/db.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST['username'];
$user->password = $_POST['password'];

if ($user->login()) {
    $_SESSION['newUsername'] = $user->username;
    header('Location: welcome.php');
} else {
    echo 'Invalid username or password. <a href="index.php">Try again</a>';
}
?>
