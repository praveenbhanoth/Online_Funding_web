<!-- admin_dashboard.php -->
<?php
session_start();

// Hardcoded credentials for simplicity (replace with database lookup)
$adminUsername = "admin";
$adminPassword = "password";

if ($_POST['username'] === $adminUsername && $_POST['password'] === $adminPassword) {
    $_SESSION['admin'] = true;
    header("Location: victim_list.php"); // Redirect to victim details page
    exit();
} else {
    echo "Invalid credentials. Please try again.";
}
?>
