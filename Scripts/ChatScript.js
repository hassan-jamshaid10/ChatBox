// Example: Chatbox Interactive Features
document.addEventListener("DOMContentLoaded", () => {
    const sendButton = document.querySelector(".send-button");
    const chatInput = document.querySelector(".chat-input input");
    const chatMessages = document.querySelector(".chat-messages");
  
    sendButton.addEventListener("click", () => {
      const message = chatInput.value.trim();
      if (message) {
        const newMessage = document.createElement("div");
        newMessage.classList.add("message", "sent");
        newMessage.innerHTML = `<p>${message}</p>`;
        chatMessages.appendChild(newMessage);
        chatInput.value = "";
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    });
  });
  