<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
?>