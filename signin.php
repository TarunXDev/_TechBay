<?php
// Include the database connection file
include('connect.php');  // Make sure the path is correct based on your file structure

// Initialize variables to store form data
$emailAddress = $passWord = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim the input data
    $emailAddress = htmlspecialchars(trim($_POST['emailAddress']));
    $passWord = htmlspecialchars(trim($_POST['passWord']));

    // Basic validation to ensure all fields are filled
    if (empty($emailAddress) || empty($passWord)) {
        die("Both email and password are required.");
    }

    // Prepare SQL query to check if the email exists in the database
    $emailCheckQuery = "SELECT * FROM signUp WHERE emailAddress = ?";
    if ($stmt = $conn->prepare($emailCheckQuery)) {
        $stmt->bind_param("s", $emailAddress);
        $stmt->execute();
        $result = $stmt->get_result();

        // If email doesn't exist in the database
        if ($result->num_rows == 0) {
            die("Invalid email address or password.");
        }

        // Fetch the result (user data)
        $user = $result->fetch_assoc();

        // Verify the entered password with the hashed password stored in the database
        if (password_verify($passWord, $user['passWord'])) {
            // Password matches, start the session and store user data
            session_start();
            $_SESSION['user_id'] = $user['id'];        // Store user ID in session
            $_SESSION['user_name'] = $user['fullName']; // Store user's full name in session
            $_SESSION['user_email'] = $user['emailAddress']; // Store user's email in session

            echo "Login successful!";
            // Redirect to the dashboard or a protected page
            header("Location: dashboard.php");  // Change this to the page you want to redirect to
            exit();
        } else {
            die("Invalid email address or password.");
        }

        $stmt->close();
    } else {
        die("Error preparing query: " . $conn->error);
    }
}

// Close the database connection after processing the form
$conn->close();
?>
