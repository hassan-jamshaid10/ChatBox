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
      const password = passwordInput.value;


      if (username.trim() === '') 
      {
          alert('Username is required');
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

      return isValid;
  }
});
