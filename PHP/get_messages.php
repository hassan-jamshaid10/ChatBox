<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ChatBox");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = intval($_GET['user_id']); // Get the user ID from the query parameter

// Fetch messages between the logged-in user and the selected user
$sql = "SELECT message, sender_id, image FROM messages WHERE (sender_id = $user_id OR receiver_id = $user_id) AND (sender_id = {$_SESSION['user_id']} OR receiver_id = {$_SESSION['user_id']}) ORDER BY timestamp ASC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
  $messages[] = $row;
}

echo json_encode($messages);
$conn->close();
?>
