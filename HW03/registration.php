<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>

    <h2>Registration</h2>
    <form action="register.php" method="post">
        <label for="newUsername">Username:</label>
        <input type="text" id="newUsername" name="newUsername" required><br>
        <label for="newPassword">Password:</label>
        <input type="password" id="newPassword" name="newPassword" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br>
        <label for="petName">Pet Name:</label>
        <input type="text" id="petName" name="petName" required><br>

        <input type="submit" value="Register">
    </form>

    <p>Already have an account? <a href="index.php">Login here</a></p>

</body>
</html>
