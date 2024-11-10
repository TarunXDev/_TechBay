<?php
// Include the database connection
include 'connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $fullName = htmlspecialchars($_POST['fullName']);
    $emailAddress = htmlspecialchars($_POST['emailAddress']);
    $passWord = $_POST['passWord'];

    // Secure the password using hashing
    $hashedPassword = password_hash($passWord, PASSWORD_BCRYPT);

    // Check if the email already exists in the database
    $checkEmail = "SELECT * FROM signUp WHERE emailAddress = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $emailAddress);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email is already registered. Please try logging in.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO signUp (fullName, emailAddress, passWord) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fullName, $emailAddress, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful. You can now log in.";
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "An error occurred during registration. Please try again later.";
        }
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
