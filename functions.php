<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form has been submitted, proceed with processing the data
       
    
    // Function to sanitize input data
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    // Retrieve and sanitize form data
    $firstname = isset($_POST['firstname']) ? sanitizeInput($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? sanitizeInput($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

} else {
    // Form has not been submitted, show an appropriate message or redirect
    echo "Form has not been submitted.";
}

// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'coffee_db';


// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Insert form data into the database
$sql = "INSERT INTO visitors (firstname, lastname, email, phone, message) VALUES ('$firstname', '$lastname', '$email', '$phone', '$message')";
if ($conn->query($sql) === TRUE) {
echo "Form submitted successfully!";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>