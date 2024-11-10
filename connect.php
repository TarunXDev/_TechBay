<?php
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Aam taur par root user ke liye default password khali hota hai
$dbname = "tarunKumar"; // Aapka database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database: $dbname";
}
?>