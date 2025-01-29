<?php

include '../Config/db.php';
session_start();


if (!isset($_SESSION['user_id'])) 
{
    header("Location: ../Pages/Login.html");
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) 
{
    $user = $result->fetch_assoc();
}
 else 
{
    echo "Error: User not found.";
    exit;
}


$_SESSION['profile_data'] = $user;
?>
