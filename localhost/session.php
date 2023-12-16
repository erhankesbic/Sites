<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Ersetzt den Platzhalter für die Benutzer-ID
?>
