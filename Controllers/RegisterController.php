<?php

require_once '../Models/UserModel.php';

class RegisterController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function registerUser($first_name, $last_name, $password, $confirm_password, $CIN, $CNE, $filiere, $email) {
        $error_message = "";

        // Simple validation
        if (empty($first_name) || empty($last_name) || empty($password) || empty($confirm_password) || empty($CIN) || empty($CNE) || empty($filiere) || empty($email)) {
            $error_message = "All fields are required.";
        } elseif ($password !== $confirm_password) {
            $error_message = "Password and Confirm Password do not match.";
        } else {
            // Register the user
            $registrationResult = $this->model->registerUser($first_name, $last_name, $password, $CIN, $CNE, $filiere, $email);

            if ($registrationResult) {
                // Redirect to Login.html after successful registration
                header("Location: Login.html");
                exit();
            } else {
                $error_message = "Registration failed.";
            }
        }

        return $error_message;
    }
}
