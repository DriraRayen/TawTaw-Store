document.addEventListener("DOMContentLoaded", function () {
   // Wait for the page to load before executing the JS
   const form = document.querySelector("form"); // Select the form element
   const notify = (message, type = "info") => {
      if (typeof window.showToast === "function") {
         window.showToast(message, { type });
      } else {
         window.alert(message);
      }
   };
   form.addEventListener("submit", function (e) {
      const email = document.querySelector("input[name='email']").value.trim();
      const password = document
         .querySelector("input[name='password']")
         .value.trim();

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex to validate email format

      // Check if both inputs are empty
      if (email === "" && password === "") {
         notify("Enter email and password.", "info");
         e.preventDefault(); // Prevent form submission
         return;
      }

      // Validate email format
      if (!emailRegex.test(email)) {
         notify("Enter a valid email address.", "info");
         e.preventDefault();
         return;
      }

      // Check if password is empty
      if (password === "") {
         notify("Enter your password.", "info");
         e.preventDefault();
         return;
      }
   });
});
