document.addEventListener("DOMContentLoaded", function () {
    const toggleButtons = document.querySelectorAll(".toggle-password");
  
    toggleButtons.forEach(button => {
      button.addEventListener("click", function () {
        // Find the corresponding password input field
        const passwordInput = this.previousElementSibling;
  
        if (passwordInput.type === "password") {
          passwordInput.type = "text"; 
          this.textContent = "🙈"; 
        } else {
          passwordInput.type = "password"; 
          this.textContent = "👁️"; 
        }
      });
    });
  });
  