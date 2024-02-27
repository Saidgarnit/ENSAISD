<?php

class UserModel {
    private $conn;
    private $isConnectionClosed = false;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM students WHERE email='$email'";
        $result = $this->conn->query($sql);

        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    public function registerUser($first_name, $last_name, $password, $CIN, $CNE, $filiere, $email) {
      // Hash the password before storing it in the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // SQL query to insert data into the database
      $sql = "INSERT INTO students (prenom, nom, password, cin, cne, filiere, email) VALUES ('$first_name', '$last_name', '$hashed_password', '$CIN', '$CNE', '$filiere', '$email')";

      if ($this->conn->query($sql) === TRUE) {
          // Registration successful
          return true;
      } else {
          // Registration failed
          return false;
      }
  }

  public function getUserDataById($userId) {
    // You might want to add some validation here for $userId

    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $this->conn->query($sql);

    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}
    public function closeConnection() {
        if (!$this->isConnectionClosed) {
            $this->conn->close();
            $this->isConnectionClosed = true;
        }
    }
}
?>