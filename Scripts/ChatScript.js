// ChatScript.js

// Select DOM elements
const chatInput = document.querySelector('.chat-input input');
const sendButton = document.querySelector('.send-button');
const emojiButton = document.querySelector('.emoji-button');
const attachButton = document.querySelector('.attach-button');
const messagesContainer = document.querySelector('.messages');
const userButton = document.querySelector('.user-button');
const dropdown = document.querySelector('.dropdown');
const chatItems = document.querySelectorAll('.chat-item');
const searchInput = document.querySelector('.search-input');

// Add event listener for sending a message
sendButton.addEventListener('click', sendMessage);

// Handle "Enter" key press for sending messages
chatInput.addEventListener('keypress', (event) => {
  if (event.key === 'Enter') {
    sendMessage();
  }
});

// Function to send a message
function sendMessage() {
  const messageText = chatInput.value.trim();

  if (messageText === '') return;

  // Create and append the message element
  const message = document.createElement('div');
  message.classList.add('message', 'sent');
  message.innerHTML = `<p>${messageText}</p>`;
  messagesContainer.appendChild(message);

  // Clear the input field and scroll to the latest message
  chatInput.value = '';
  messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Add event listener for emoji button
emojiButton.addEventListener('click', () => {
  alert('Emoji picker coming soon!');
});

// Add event listener for attach button
attachButton.addEventListener('click', () => {
  alert('Attachment feature coming soon!');
});

// Toggle user dropdown menu
userButton.addEventListener('click', () => {
  dropdown.classList.toggle('active');
});

// Close dropdown if clicked outside
window.addEventListener('click', (event) => {
  if (!userButton.contains(event.target) && !dropdown.contains(event.target)) {
    dropdown.classList.remove('active');
  }
});

// Add click functionality to chat items
chatItems.forEach((chatItem) => {
  chatItem.addEventListener('click', () => {
    alert(`Opening chat with ${chatItem.querySelector('h3').textContent}`);
  });
});

// Filter chats based on search input
searchInput.addEventListener('input', () => {
  const query = searchInput.value.toLowerCase();
  chatItems.forEach((chatItem) => {
    const chatName = chatItem.querySelector('h3').textContent.toLowerCase();
    if (chatName.includes(query)) {
      chatItem.style.display = 'flex';
    } else {
      chatItem.style.display = 'none';
    }
  });
});
