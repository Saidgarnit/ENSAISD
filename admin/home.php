<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'Controllers/StudentController.php';


// Instantiate the controller
$studentController = new StudentController();

// Call the method to display students
$studentController->displayStudents();
?> 
