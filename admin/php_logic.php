<?php
include 'config.php';
session_start(); // Start session if not already started

if (!isset($_SESSION['user_id'])) {
  die("User not logged in.");
}

// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Fetch student information
$queryStudent = $db->prepare("SELECT * FROM students WHERE id = :studentID");
$queryStudent->bindParam(':studentID', $userID, PDO::PARAM_INT);
$queryStudent->execute();
$student = $queryStudent->fetch(PDO::FETCH_ASSOC);

// Base URL of your local server
$baseURL = "http://localhost/ENSAISD"; // Change 'ENSAISD' to the name of your project directory

