<?php

if (!class_exists('StudentController')) {
    class StudentController {
        public function displayStudents() {
            // Instantiate the model
            $studentModel = new StudentModel();

            // Get all students from the model
            $students = $studentModel->getAllStudents();

            // Include the view file and pass the $students variable
            include 'student_profile.php';
        }
    }
}

// Include the model outside the class/method
include 'Models/StudentModel.php';

?>
