<?php

include 'header.php';
include 'db.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted email and password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the email and password
    if (!empty($email) && !empty($password)) {
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password against the hashed password in the database
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = true;

                // Redirect to dashboard
                header("Location: index.php");
                exit;
            } else {
                // Password is not correct
                $error = "Incorrect email or password.";
            }
        } else {
            // No user found with that email
            $error = "Incorrect email or password.";
        }
    } else {
        // If the email or password is empty, show an error message
        $error = "Please enter both email and password.";
    }
}

// If there's an error, display it
if (isset($error)) {
    echo $error;
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form id="login-form" action="login.php" method="post">
        <label for="email">E-Mail:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required>

        <div class="container-submit-btn"><button class="submit-btn" type="submit" name="login">Einloggen</button></div>
    </form>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>


