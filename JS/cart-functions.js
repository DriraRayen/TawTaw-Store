// Centralized cart and favourites management functions

const notifyUser = (message, type = "info", options = {}) => {
   if (typeof window.showToast === "function") {
      window.showToast(message, { type, ...options });
   } else {
      window.alert(message);
   }
};

const requestConfirmation = (message, options = {}) => {
   if (typeof window.showConfirm === "function") {
      return window.showConfirm(message, options);
   }
   const accepted = window.confirm(message);
   return Promise.resolve(accepted);
};

window.notifyUser = notifyUser;
window.requestConfirmation = requestConfirmation;

/**
 * Add item to cart
 * @param {number} variationId - The variation ID to add
 */
function addToCart(variationId, quantity = 1, options = {}) {
   // Check if the user is logged in (injected via PHP)
   if (typeof isUserLoggedIn === "undefined" || !isUserLoggedIn) {
      const loginError = new Error("Login required");
      notifyUser("Log in to add items to your cart.", "info");
      return Promise.reject(loginError);
   }

   const normalizedQuantity = parseInt(quantity, 10);
   const payload = {
      variation_id: Number(variationId),
   };

   if (!Number.isNaN(normalizedQuantity) && normalizedQuantity > 0) {
      payload.quantity = normalizedQuantity;
   }

   if (options && options.mode === "set") {
      payload.mode = "set";
   }

   const showSuccess = !(options && options.silentSuccess === true);
   const showError = !(options && options.silentError === true);

   // Send the AJAX request
   return fetch("../php/add-to-cart.php", {
      method: "POST",
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
   })
      .then((response) => {
         if (!response.ok) {
            throw new Error("Could not reach the server. Try again.");
         }
         return response.json();
      })
      .then((data) => {
         if (!data.success) {
            throw new Error(data.message || "Could not add the item.");
         }
         if (showSuccess) {
            notifyUser(data.message || "Added to cart.", "info");
         }
         return data;
      })
      .catch((error) => {
         if (showError) {
            notifyUser(
               error.message || "Could not add the item. Try again.",
               "error"
            );
         }
         throw error;
      });
}

/**
 * Toggle favourite status
 * @param {HTMLElement} element - The heart icon element
 * @param {number} variationId - The variation ID to toggle
 */
function toggleFavourite(element, variationId) {
   if (!element) {
      return Promise.resolve(null);
   }

   const normalizedVariationId = Number(variationId);
   if (Number.isNaN(normalizedVariationId) || normalizedVariationId <= 0) {
      notifyUser("Could not update favourites right now.", "error");
      return Promise.resolve(null);
   }

   if (typeof isUserLoggedIn === "undefined" || !isUserLoggedIn) {
      notifyUser("Log in to manage favourites.", "info");
      return Promise.resolve(null);
   }

   const isFavourite = element.getAttribute("data-favourite") === "true";

   return fetch("../php/toggle-favourite.php", {
      method: "POST",
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify({
         variation_id: normalizedVariationId,
         action: isFavourite ? "remove" : "add",
      }),
   })
      .then((response) => {
         if (!response.ok) {
            throw new Error("Could not reach the server. Try again.");
         }
         return response.json();
      })
      .then((data) => {
         if (!data.success) {
            throw new Error(data.message || "Failed to update favourites.");
         }

         const nextState = isFavourite ? "false" : "true";
         element.src = isFavourite
            ? "../Images/Icons/heart.svg"
            : "../Images/Icons/heart_on.svg";
         element.setAttribute("data-favourite", nextState);
         element.setAttribute("aria-pressed", nextState);
         notifyUser(
            data.message ||
               (nextState === "true"
                  ? "Added to favourites."
                  : "Removed from favourites."),
            "info"
         );

         if (window.location.pathname.includes("favourates.php")) {
            location.reload();
         }

         return data;
      })
      .catch((error) => {
         console.error("Favourites error:", error);
         notifyUser(error.message || "Could not update favourites.", "error");
         return null;
      });
}

/**
 * Handle one-click purchasing from product lists (shop, favourites, etc.).
 *
 * @param {number|string} variationId
 * @param {number|string} [quantity]
 */
function quickBuy(variationId, quantity = 1) {
   if (typeof isUserLoggedIn === "undefined" || !isUserLoggedIn) {
      window.location.href = "login.php";
      return Promise.reject(new Error("Login required"));
   }

   const parsedVariation = Number(variationId);
   if (Number.isNaN(parsedVariation) || parsedVariation <= 0) {
      return Promise.reject(new Error("Invalid variation"));
   }

   let normalizedQuantity = Number(quantity);
   if (Number.isNaN(normalizedQuantity) || normalizedQuantity <= 0) {
      normalizedQuantity = 1;
   }

   return addToCart(parsedVariation, normalizedQuantity, {
      mode: "set",
      silentSuccess: true,
      silentError: true,
   })
      .then(() => {
         window.location.href = `pay.php?items=${parsedVariation}`;
      })
      .catch((error) => {
         if (error && error.message === "Login required") {
            return;
         }
         notifyUser(
            error.message || "Could not start checkout. Try again.",
            "error"
         );
         throw error;
      });
}

function bindQuickBuyButtons(root = document) {
   if (!root) {
      return;
   }

   const buttons = root.querySelectorAll(".quick-buy");
   buttons.forEach((button) => {
      if (button.dataset.quickBuyBound === "true") {
         return;
      }

      button.dataset.quickBuyBound = "true";
      button.addEventListener("click", (event) => {
         event.preventDefault();
         const variationId = button.dataset.variation;
         quickBuy(variationId).catch(() => {
            /* errors already surfaced */
         });
      });
   });
}

if (document.readyState === "loading") {
   document.addEventListener("DOMContentLoaded", () => bindQuickBuyButtons());
} else {
   bindQuickBuyButtons();
}

/**
 * Delete item from cart
 * @param {number} variationId - The variation ID to remove
 */
function deleteFromCart(variationId) {
   requestConfirmation(
      "Are you sure you want to remove this item from the cart?",
      {
         confirmText: "Remove",
         cancelText: "Keep",
      }
   ).then((confirmed) => {
      if (!confirmed) {
         return;
      }

      // Send the AJAX request
      fetch("../php/delete-from-cart.php", {
         method: "POST",
         headers: {
            "Content-Type": "application/json",
         },
         body: JSON.stringify({ variation_id: variationId }),
      })
         .then((response) => response.json())
         .then((data) => {
            if (data.success) {
               notifyUser("Removed from cart.", "info");
               location.reload();
            } else {
               notifyUser(data.message || "Could not remove item.", "error");
            }
         })
         .catch((error) => {
            console.error("Error:", error);
            notifyUser("Could not remove item. Try again.", "error");
         });
   });
}
