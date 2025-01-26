<?php
include '../Config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Both fields are required.";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, username, email, created_at, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_name, $email, $created_at, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['profile_data'] = [
                'username' => $user_name,
                'email' => $email,
                'created_at' => $created_at
            ];

            echo "<script>
                    sessionStorage.setItem('profile_data', JSON.stringify(" . json_encode($_SESSION['profile_data']) . "));
                    window.location.href = '../Pages/Dashboard.html'; // Redirect to profile page
                  </script>";
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
    $conn->close();
}
?>
