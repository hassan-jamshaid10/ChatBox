// Load users and messages on page load
document.addEventListener("DOMContentLoaded", () => {
  loadUsers();
  loadMessages();
});

// Fetch users from the database
function loadUsers() {
  fetch("../PHP/fetch_users.php")
    .then((response) => response.json())
    .then((users) => {
      const usersList = document.getElementById("usersList");
      usersList.innerHTML = users
        .map(
          (user) => `
        <div class="chat-item" onclick="loadMessages(${user.id})">
          <img src="user-avatar.png" alt="User Avatar">
          <div class="chat-info">
            <h3>${user.username}</h3>
          </div>
        </div>`
        )
        .join("");
    });
}

// Fetch messages for a specific user
function loadMessages(userId = 1) {
  fetch(`../PHP/fetch_messages.php?userId=${userId}`)
    .then((response) => response.json())
    .then((messages) => {
      const chatMessages = document.getElementById("chatMessages");
      chatMessages.innerHTML = messages
        .map(
          (msg) => `
        <div class="message ${msg.sender === "me" ? "sent" : "received"}">
          <p>${msg.message}</p>
        </div>`
        )
        .join("");
    });
}

// Send a message
function sendMessage() {
  const messageInput = document.getElementById("messageInput");
  const message = messageInput.value.trim();
  if (message) {
    fetch("../PHP/send_message.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ userId: 1, message }),
    })
      .then((response) => response.json())
      .then((status) => {
        if (status.success) {
          loadMessages(1); // Reload messages
          messageInput.value = ""; // Clear input
        }
      });
  }
}
