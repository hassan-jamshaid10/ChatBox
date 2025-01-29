<?php

include '../Config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);


    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) 
    {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid email format.";
        exit;
    }

    if ($password !== $confirm_password) 
    {
        echo "Passwords do not match.";
        exit;
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) 
    {
        echo "Username or email already exists.";
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) 
    {
        echo "Signup successful. Redirecting to login...";
        header("Location: ../Pages/Login.html");
        exit;
    }
    else 
    {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
