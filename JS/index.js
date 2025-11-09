// Function to navigate to different pages
function navigateToPage(pageName) {
   switch (pageName) {
      case "favourates":
         window.location.href = "favourates.php";
         break;
      case "Shop":
         window.location.href = "shop.php";
         break;
      case "contact":
         window.location.href = "contact.php";
         break;
      case "cart":
         window.location.href = "cart.php";
         break;
      case "s-pay":
         window.location.href = "s-pay.html";
         break;
      case "signup":
         window.location.href = "signup.php";
         break;
      case "login":
         window.location.href = "login.php";
         break;
      default:
         console.error("Page not found");
   }
}
document.addEventListener("DOMContentLoaded", function () {
   document.querySelectorAll("button").forEach((button) => {
      if (
         [
            "favourates",
            "Shop",
            "contact",
            "cart",
            "buy",
            "s-pay",
            "signup",
            "login",
            "s-login",
         ].includes(button.id)
      ) {
         button.addEventListener("click", function () {
            navigateToPage(button.id);
         });
      }
   });
});
/* Function to toggle heart icon */
function toggleHeart(element) {
   const currentSrc = element.getAttribute("src");

   const filledHeart = "../Images/Icons/heart.svg";
   const outlineHeart = "../Images/Icons/heart_on.svg";

   if (currentSrc.includes("heart_on")) {
      element.setAttribute("src", filledHeart);
   } else {
      element.setAttribute("src", outlineHeart);
   }
}
