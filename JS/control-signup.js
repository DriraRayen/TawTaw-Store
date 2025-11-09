document.addEventListener("DOMContentLoaded", function () {
   const form = document.querySelector("form"); // Select the form element
   const notify = (message, type = "info") => {
      if (typeof window.showToast === "function") {
         window.showToast(message, { type });
      } else {
         window.alert(message);
      }
   };

   form.addEventListener("submit", function (e) {
      const fields = {
         email: document.querySelector("input[name='email']").value.trim(),
         password: document
            .querySelector("input[name='password']")
            .value.trim(),
         confirmPassword: document
            .querySelector("input[name='confirm_password']")
            .value.trim(),
      };

      const regex = {
         email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // Regex to validate email format
         specialChar: /[.@\-_/*$]/, // Updated to include * and $
         upperCase: /[A-Z]/,
         lowerCase: /[a-z]/,
      };

      const messages = {
         email: "Enter a valid email address.",
         passwordEmpty: "Enter a password.",
         passwordLength: "Use at least 8 characters.",
         passwordSecurity:
            "Add a special character plus upper and lower case letters.",
         confirmPassword: "Passwords must match.",
      };

      // Validate email
      if (!fields.email || !regex.email.test(fields.email)) {
         notify(messages.email, "info");
         e.preventDefault();
         return;
      }

      // Validate password
      if (!fields.password) {
         notify(messages.passwordEmpty, "info");
         e.preventDefault();
         return;
      }

      if (fields.password.length < 8) {
         notify(messages.passwordLength, "info");
         e.preventDefault();
         return;
      }

      if (
         !regex.specialChar.test(fields.password) ||
         !regex.upperCase.test(fields.password) ||
         !regex.lowerCase.test(fields.password)
      ) {
         notify(messages.passwordSecurity, "info");
         e.preventDefault();
         return;
      }

      // Validate confirm password
      if (fields.password !== fields.confirmPassword) {
         notify(messages.confirmPassword, "info");
         e.preventDefault();
         return;
      }
   });
});
