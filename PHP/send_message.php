<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ChatBox");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    $senderId = $_POST['sender_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) 
    {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = "../uploads/";
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpName, $imagePath)) 
        {
            $image = $imageName;
        }
         else 
        {
            echo "Error uploading the image.";
        }
    }

    $stmt = $conn->prepare("INSERT INTO messages (message, sender_id, receiver_id, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $message, $senderId, $receiverId, $image);

    if ($stmt->execute())
    {
        echo "Message sent successfully.";
    }
     else
    {
        echo "Error sending message.";
    }
}
?>
