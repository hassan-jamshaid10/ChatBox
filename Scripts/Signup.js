document.addEventListener("DOMContentLoaded", function() 
{
  const toggleButtons = document.querySelectorAll(".toggle-password");

  toggleButtons.forEach(button => 
    {
      button.addEventListener("click", function() 
      {
          const passwordInput = this.previousElementSibling;

          if (passwordInput.type === "password") 
          {
              passwordInput.type = "text"; 
              this.textContent = "🙈"; 
          } 
          else
           {
              passwordInput.type = "password"; 
              this.textContent = "👁️"; 
          }
      });
  });

  const form = document.querySelector('form');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const emailInput = document.getElementById('email');


  form.addEventListener('submit', function(event) 
  {
      if (!validateForm()) 
      {
          event.preventDefault();
      }
  });

  function validateForm() 
  {
      let isValid = true;

      const username = document.getElementById('username').value;
      const email = emailInput.value;
      const password = passwordInput.value;
      const confirmPassword = confirmPasswordInput.value;

      if (username.trim() === '')
      {
          alert('Username is required');
          isValid = false;
      }

      if (email.trim() === '') 
      {
          alert('Email is required');
          isValid = false;
      } 
      else if (!isValidEmail(email))
      {
          alert('Please enter a valid email');
          isValid = false;
      }

      if (password.trim() === '') 
      {
          alert('Password is required');
          isValid = false;
      }
      else if (password.length < 6) 
      {
          alert('Password must be at least 6 characters long');
          isValid = false;
      }

      if (confirmPassword.trim() === '') 
      {
          alert('Please confirm your password');
          isValid = false;
      } 
      else if (confirmPassword !== password) 
      {
          alert('Passwords do not match');
          isValid = false;
      }

      return isValid;
  }

  function isValidEmail(email) 
  {
      const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return regex.test(email);
  }
});
