<?php
session_start();

include_once 'db.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST['newUsername'];
$user->password = $_POST['newPassword'];
$user->email = $_POST['email'];
$user->phone = $_POST['phone'];
$user->first_name = $_POST['firstName'];
$user->last_name = $_POST['lastName'];
$user->pet_name = $_POST['petName'];

if ($user->register()) {
    $_SESSION['newUsername'] = $user->username;
    header('Location: index.php');
} else {
    echo 'Unable to register. <a href="registration.php">Try again</a>';
}
?>
