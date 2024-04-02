<?php

require_once 'db_connection.php';
$currentPage = 'contact';

    // Sanitize and validate form fields
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // read FILTER_SANITIZE_FULL_SPECIAL_CHARS https://www.w3schools.com/php/filter_sanitize_special_chars.asp
    
    // Validate email
    if (!$email) {
        echo "Invalid email address";
        exit();
    }

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO contact (name, email, subject, message, date_posted) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->execute([$name, $email, $subject, $message]);

    echo "success";


$pdo = null;



?>




