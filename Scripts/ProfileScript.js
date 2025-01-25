document.addEventListener("DOMContentLoaded", () => {
    // Assuming profile data is stored in session storage
    const profileData = JSON.parse(sessionStorage.getItem("profile_data"));
  
    if (profileData) {
      document.getElementById("username").textContent = profileData.username;
      document.getElementById("email").textContent = profileData.email;
      document.getElementById("created_at").textContent = profileData.created_at;
    } else {
      // Redirect to login if data is not available
      window.location.href = "../Pages/Login.html";
    }
  });
  