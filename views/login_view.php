<?php
require_once '../Controllers/UserController.php';
require_once '../Models/UserModel.php';
require_once 'config.php'; // Include the configuration file

// Instantiate model and controller
$model = new UserModel($conn);
$controller = new UserController($model);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $controller->loginUser($email, $password);

    // Output result as JSON
    header('Content-Type: application/json');
    echo json_encode($result);

    // Close the database connection
    $model->closeConnection();

    // Stop further execution
    exit();
}
?>