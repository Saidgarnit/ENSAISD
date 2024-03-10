<?php
// Database connection details
$host = 'localhost';
$db_name = 'ecole';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Start the session
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
