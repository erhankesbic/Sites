

<?php
include 'header.php'; // Include your header navigation

include 'db.php'; // Include your database connection


// Check if the form is submitted
if(isset($_POST['register'])) {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert a new user
    $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (:email, :hashed_password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hashed_password', $hashed_password);

    if($stmt->execute()) {
        echo "User created successfully";
    } else {
        echo "Error creating user";
    }
}
?>
<!-- Rest of your HTML code -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
</head>
<body>
    <form id="register-form" action="signup.php" method="post">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required>

        <div class="container-submit-btn">
            <button class="submit-btn" type="submit" name="register">Registrieren</button>
        </div>    
    </form>
</body>
</html>
