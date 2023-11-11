<?php
session_start();

include_once __DIR__ . '/db.php';



if (isset($_SESSION['newUsername'])) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $_SESSION['newUsername'];

    // Попытка получить данные пользователя из базы данных
    if ($user->getUserByUsername()) {
        $username = $user->username;
        $email = $user->email;
        $phone = $user->phone;
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $petName = $user->pet_name;

        echo "Welcome, $username!<br>";
        echo "Email: $email<br>";
        echo "Phone: $phone<br>";
        echo "First Name: $firstName<br>";
        echo "Last Name: $lastName<br>";
        echo "Pet Name: $petName<br>";

        echo '<a href="logout.php">Logout</a>';
    } else {
        echo 'Error fetching user data. <a href="index.php">Go back</a>';
    }
} else {
    header('Location: index.php');
}
?>
