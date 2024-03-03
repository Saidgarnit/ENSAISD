<?php

class StudentModel {
    private $db;

    public function __construct() {
        // Replace with your database connection details
        $host = 'localhost';
        $db_name = 'ecole';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getAllStudents() {
        $query = $this->db->prepare("SELECT * FROM students");
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
