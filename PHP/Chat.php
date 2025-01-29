<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Page</title>
  <link rel="stylesheet" href="../Styles/Chat.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ChatBox");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$loggedInUserId = $_SESSION['user_id']; 
$usersResult = $conn->query("SELECT id, username FROM users WHERE id != $loggedInUserId");
$messagesResult = $conn->query("SELECT message, sender_id, image FROM messages WHERE sender_id = $loggedInUserId OR receiver_id = $loggedInUserId ORDER BY timestamp ASC");
?>

<header class="header">
  <div class="logo">Chatbox App</div>
  <div class="user-menu">
    <button class="user-button">
      <i class="fas fa-user"></i> User
    </button>
    <div class="dropdown">
      <a href="../Pages/Profile.html">Profile</a>
      <a href="../PHP/Logout.php">Logout</a>
    </div>
  </div>
</header>


<div class="chat-container">
  <aside class="chat-list">
    <h2>Chats</h2>
    <div id="usersList">
      <?php while ($user = $usersResult->fetch_assoc()): ?>
        <div class="chat-item" onclick="openChat(<?php echo $user['id']; ?>)">
          <img src="../uploads/user.jpg" alt="User Avatar">
          <div class="chat-info">
            <h3><?php echo htmlspecialchars($user['username']); ?></h3>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </aside>



  <main class="chat-window">
    <div class="chat-header">
      <button class="call-button"><i class="fas fa-user"></i></button>
    </div>
    <div class="messages" id="messageContainer">
      <?php while ($message = $messagesResult->fetch_assoc()): ?>
        <div class="message <?php echo $message['sender_id'] == $loggedInUserId ? 'sent' : 'received'; ?>">
          <p><?php echo htmlspecialchars($message['message']); ?></p>
          <?php if ($message['image']): ?>
            <img src="../uploads/<?php echo $message['image']; ?>" alt="Image" class="chat-image">
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="chat-input">
      <form id="messageForm" method="POST" enctype="multipart/form-data">
        <button class="emoji-button" type="button" onclick="toggleEmojiPicker()"><i class="fas fa-smile"></i></button>
        <input type="text" name="message" id="messageInput" placeholder="Type your message here..." required>
        <input type="file" name="image" id="imageInput" accept="image/*" style="display: none;">
        <button class="attach-button" type="button" onclick="document.getElementById('imageInput').click();"><i class="fas fa-paperclip"></i></button>
        <button class="send-button" type="submit"><i class="fas fa-paper-plane"></i></button>
        <input type="hidden" name="sender_id" id="sender_id" value="<?php echo $loggedInUserId; ?>">
        <input type="hidden" name="receiver_id" id="receiver_id" value="2"> 
      </form>

      <div id="emojiPicker" style="display: none;">
        <button class="emoji" type="button" onclick="insertEmoji('😊')">😊</button>
        <button class="emoji" type="button" onclick="insertEmoji('😂')">😂</button>
        <button class="emoji" type="button" onclick="insertEmoji('😍')">😍</button>
        <button class="emoji" type="button" onclick="insertEmoji('😢')">😢</button>
        <button class="emoji" type="button" onclick="insertEmoji('😉')">😉</button>
        <button class="emoji" type="button" onclick="insertEmoji('😎')">😎</button>
        <button class="emoji" type="button" onclick="insertEmoji('😜')">😜</button>
        <button class="emoji" type="button" onclick="insertEmoji('😅')">😅</button>
        <button class="emoji" type="button" onclick="insertEmoji('😆')">😆</button>
        <button class="emoji" type="button" onclick="insertEmoji('🤔')">🤔</button>
        <button class="emoji" type="button" onclick="insertEmoji('😡')">😡</button>
        <button class="emoji" type="button" onclick="insertEmoji('😴')">😴</button>
        <button class="emoji" type="button" onclick="insertEmoji('🥺')">🥺</button>
        <button class="emoji" type="button" onclick="insertEmoji('😈')">😈</button>
        <button class="emoji" type="button" onclick="insertEmoji('🤩')">🤩</button>
        <button class="emoji" type="button" onclick="insertEmoji('🥳')">🥳</button>
        <button class="emoji" type="button" onclick="insertEmoji('😇')">😇</button>
        <button class="emoji" type="button" onclick="insertEmoji('👻')">👻</button>
        <button class="emoji" type="button" onclick="insertEmoji('💀')">💀</button>
        <button class="emoji" type="button" onclick="insertEmoji('🐱')">🐱</button>
        <button class="emoji" type="button" onclick="insertEmoji('🐶')">🐶</button>
      </div>
    </div>
  </main>

</div>

<script>
  function openChat(userId)
   {
    document.getElementById('receiver_id').value = userId;
    fetchMessages(userId);
   }

 
  function fetchMessages(userId)
  {
  fetch(`../PHP/get_messages.php?user_id=${userId}`)
    .then(response => response.json())
    .then(messages => {
      const messageContainer = document.getElementById('messageContainer');
      messageContainer.innerHTML = ''; 
      messages.forEach(message =>
       {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');
        messageElement.classList.add(message.sender_id == <?php echo $loggedInUserId; ?> ? 'sent' : 'received');
        messageElement.innerHTML = `<p>${message.message}</p>`;

        if (message.image) {
          const img = document.createElement('img');
          img.src = `../uploads/${message.image}`;
          img.classList.add('chat-image');
          messageElement.appendChild(img);
        }

        messageContainer.appendChild(messageElement);
      });
      scrollToBottom();
    })
    .catch(error => console.error('Error fetching messages:', error));
 }

//ajax
  document.getElementById('messageForm').addEventListener('submit', function(event) 
  {
    event.preventDefault(); 
    const formData = new FormData(this);
    fetch('../PHP/send_message.php', {
      method: 'POST',
      body: formData,
    })
    .then(response => response.text())
    .then(data => 
    {
      const receiverId = document.getElementById('receiver_id').value;
      fetchMessages(receiverId);
      document.getElementById('messageInput').value = '';
    })
    .catch(error => console.error('Error sending message:', error));
  });

  function scrollToBottom()
   {
    const messageContainer = document.getElementById('messageContainer');
    messageContainer.scrollTop = messageContainer.scrollHeight;
  }

  window.onload = scrollToBottom;

  function toggleEmojiPicker()
  {
    const picker = document.getElementById('emojiPicker');
    picker.style.display = (picker.style.display === 'none' || picker.style.display === '') ? 'block' : 'none';
  }

  function insertEmoji(emoji) 
  {
    const messageInput = document.getElementById('messageInput');
    messageInput.value += emoji; 
    toggleEmojiPicker();
  }
</script>
</body>
</html>
