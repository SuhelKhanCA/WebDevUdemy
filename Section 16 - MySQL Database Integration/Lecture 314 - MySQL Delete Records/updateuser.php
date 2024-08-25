<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mywebsite";

// Function to sanitize input
function val($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Sanitize POST data
$fname = val($_POST["fname"]);  
$lname = val($_POST["lname"]);  
$email = val($_POST["email"]); 
$id = intval($_POST["id"]); // Use intval() to ensure $id is an integer

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare an SQL statement
$stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=? WHERE id=?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssi", $fname, $lname, $email, $id);

// Execute the query
if ($stmt->execute()) {
    header("Location: delete.php?message=success&id=" . $id);
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
