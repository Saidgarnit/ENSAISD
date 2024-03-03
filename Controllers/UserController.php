<?php
require_once '../Models/UserModel.php';

class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function loginUser($email, $password) {
        $error_message = "";
        $redirect_url = "";
    
        // Simple validation (you can enhance this)
        if (empty($email) || empty($password)) {
            $error_message = "Email and password are required.";
        } else {
            // Check user credentials in the database
            $userData = $this->model->getUserByEmail($email);
    
            if ($userData) {
                $hashed_password = $userData["password"];
    
                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Set the user information in the session
                    session_start();
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['user_email'] = $userData['email'];
    
                    // Set the URL for redirection
                    $redirect_url = "../admin/student_profile.php";
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "User not found.";
            }
        }
    
        // Close the database connection
        $this->model->closeConnection();
    
        return ['error' => $error_message, 'redirect_url' => $redirect_url];
    }

    public function getUserData($userId) {
        // You might want to add some validation here for $userId

        // Call the method from the model to get user data
        $userData = $this->model->getUserDataById($userId);

        // Process the data if needed and return it
        return $userData;
    }
}
