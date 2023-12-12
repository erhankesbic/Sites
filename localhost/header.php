<?php 
include 'session.php'; 
include 'db.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartGainz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="header-content">
                <img src="SG.png" alt="Beschreibung des Bildes" class="logo" width="200" height="100">    
                <nav>
                    <ul>
                        <?php if ($is_logged_in): ?>
                        <li><a href="dashboard.php">Startseite</a></li>
                        <li><a href="training.php">Training</a></li>
                        <li><a href="ernährung.php">Ernährung</a></li>
                        <li><a href="profil.php">Profil</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                        <li><a href="index.php">Startseite</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Registrieren</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
