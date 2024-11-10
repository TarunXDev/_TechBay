<?php

// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


