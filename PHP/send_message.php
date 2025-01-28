<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ChatBox");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['sender_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];
    $image = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = "../uploads/";
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imageName; // Store image name in database
        } else {
            echo "Error uploading the image.";
        }
    }

    // Insert message and image data into the database
    $stmt = $conn->prepare("INSERT INTO messages (message, sender_id, receiver_id, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $message, $senderId, $receiverId, $image);
    if ($stmt->execute()) {
        echo "Message sent successfully.";
    } else {
        echo "Error sending message.";
    }
}
?>
