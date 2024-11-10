<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Display user info
echo "Welcome, " . $_SESSION['fullName'] . "!<br>";
echo "Your email: " . $_SESSION['emailAddress'] . "<br>";
echo "<a href='logout.php'>Logout</a>";
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

