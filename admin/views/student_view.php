<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    
    <?php
    // Check if $students is set and not null
    if (isset($students) && !empty($students)) {
        echo '<ul>';
        foreach ($students as $student) {
            echo '<li>' . $student['prenom'] . ' ' . $student['nom'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No students found</p>';
    }
    ?>
</body>
</html>
