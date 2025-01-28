<?php
$conn = new mysqli("localhost", "root", "", "ChatBox");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);
$users = [];
while ($row = $result->fetch_assoc()) $users[] = $row;

echo json_encode($users);
$conn->close();
?>
