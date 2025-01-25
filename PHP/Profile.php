<?php
// profile.php
include '../Config/db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../Pages/Login.html");
    exit;
}

// Fetch the logged-in user's data
$user_id = $_SESSION['user_id'];
$query = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Error: User not found.";
    exit;
}

// Pass the user data to the next page
$_SESSION['profile_data'] = $user;
?>
