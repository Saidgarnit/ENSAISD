<!-- register_view.php -->

<?php
require_once '../Controllers/RegisterController.php';
require_once '../Models/UserModel.php';
require_once 'config.php'; // Include the configuration file

// Instantiate model and controller
$model = new UserModel($conn);
$controller = new RegisterController($model);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $CIN = $_POST["CIN"];
    $CNE = $_POST["CNE"];
    $filiere = $_POST["optionsRadios"];
    $email = $_POST["email"];

    // Call the registerUser method from the controller
    $error_message = $controller->registerUser($first_name, $last_name, $password, $confirm_password, $CIN, $CNE, $filiere, $email);

    // Output result as JSON
    echo json_encode(['error' => $error_message]);

    // Close the database connection
    $model->closeConnection();

    // Stop further execution
    exit();
}
?>

<!-- Include or redirect to your Register.html file -->
<?php include 'Register.html'; ?>