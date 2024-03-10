<?php

require_once '../Models/UserModel.php';

class ConfirmationController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function confirmEmail($token)
    {
        // Validate the token and update the user's validation status
        $userId = $this->model->validateToken($token);

        if ($userId) {
            // Token is valid, update the user's validation status
            $this->model->updateValidationStatus($userId);
            return true;
        } else {
            // Token validation failed
            return false;
        }
    }
}
?>
