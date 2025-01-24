// JavaScript to handle dropdown interaction (optional enhancement)
document.addEventListener("DOMContentLoaded", () => {
    const userButton = document.querySelector(".user-button");
    const dropdown = document.querySelector(".dropdown");
  
    userButton.addEventListener("click", () => {
      dropdown.classList.toggle("show");
    });
  
    document.addEventListener("click", (event) => {
      if (!userButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove("show");
      }
    });
  });
  