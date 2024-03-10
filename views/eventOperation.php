<?php
include_once 'connection.php';

// Function to fetch events from the database
function fetchEvents($conn) {
    try {
        // Prepare and execute the query
        $stmt = $conn->query("SELECT * FROM events");
        // Fetch all rows as associative arrays
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Base64 encode image blob data
        foreach ($events as &$event) {
            $event['image_data'] = base64_encode($event['image_data']);
        }

        return $events;
    } catch(PDOException $e) {
        // Handle database errors
        die("Error fetching events: " . $e->getMessage());
    }
}

// Fetch events from the database
$events = fetchEvents($conn);

// Output events as JSON
header('Content-Type: application/json');
echo json_encode($events);
