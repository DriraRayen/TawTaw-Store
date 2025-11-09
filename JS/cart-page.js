// Cart page specific logic for item selection, totals, and checkout
(function () {
   const SUMMARY_DECIMALS = 3;

   const checkoutButton = document.getElementById("checkout-button");
   const summaryButton = document.getElementById("cart-summary");
   const summaryCount = document.getElementById("selected-count");
   const summaryLabel = document.getElementById("selected-label");
   const summaryTotal = document.getElementById("selected-total");

   const notify = (message, type = "info") => {
      if (typeof notifyUser === "function") {
         notifyUser(message, type);
         return;
      }
      if (typeof showToast === "function") {
         showToast(message, { type });
         return;
      }
      alert(message);
   };

   const formatTotal = (value) =>
      Number(value).toLocaleString(undefined, {
         minimumFractionDigits: SUMMARY_DECIMALS,
         maximumFractionDigits: SUMMARY_DECIMALS,
      });

   /**
    * Calculate totals based on selected checkboxes and update UI.
    */
   const updateSummary = () => {
      const checkboxes = Array.from(document.querySelectorAll(".select-pay"));
      let totalQuantity = 0;
      let totalAmount = 0;

      checkboxes.forEach((checkbox) => {
         if (!checkbox.checked) {
            return;
         }

         const quantity = parseInt(checkbox.dataset.quantity || "0", 10);
         const price = parseFloat(checkbox.dataset.price || "0");

         if (!Number.isNaN(quantity) && !Number.isNaN(price)) {
            totalQuantity += quantity;
            totalAmount += quantity * price;
         }
      });

      summaryCount.textContent = totalQuantity.toString();
      summaryLabel.textContent = totalQuantity === 1 ? "item" : "items";
      summaryTotal.textContent = formatTotal(totalAmount);

      const hasSelection = totalQuantity > 0;
      if (checkoutButton) {
         checkoutButton.disabled = !hasSelection;
      }
      if (summaryButton) {
         summaryButton.disabled = !hasSelection;
      }
   };

   /**
    * Gather selected items and redirect to checkout.
    */
   const handleCheckoutClick = () => {
      const selectedIds = Array.from(
         document.querySelectorAll(".select-pay:checked")
      )
         .map((checkbox) => checkbox.dataset.variation)
         .filter((value) => value && !Number.isNaN(parseInt(value, 10)));

      if (selectedIds.length === 0) {
         return;
      }

      const query = encodeURIComponent(selectedIds.join(","));
      window.location.href = `pay.php?items=${query}`;
   };

   /**
    * Attach listeners to checkboxes and quantity inputs.
    */
   const attachListeners = () => {
      document.querySelectorAll(".select-pay").forEach((checkbox) => {
         checkbox.addEventListener("change", updateSummary);
      });

      document.querySelectorAll(".cart-quantity-input").forEach((input) => {
         input.addEventListener("change", () => {
            const variationId = input.dataset.variation;
            updateCartQuantityHandler(variationId, input.value);
         });
      });

      document.querySelectorAll(".buy-now").forEach((button) => {
         button.addEventListener("click", () => {
            const variationId = button.dataset.variation;
            if (!variationId) {
               return;
            }

            document.querySelectorAll(".select-pay").forEach((checkbox) => {
               checkbox.checked = checkbox.dataset.variation === variationId;
            });

            updateSummary();
            handleCheckoutClick();
         });
      });
   };

   if (checkoutButton) {
      checkoutButton.addEventListener("click", handleCheckoutClick);
   }

   const initialiseCartPage = () => {
      attachListeners();
      updateSummary();
   };

   if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", initialiseCartPage);
   } else {
      initialiseCartPage();
   }

   /**
    * Update cart quantity for a specific variation through an API call.
    *
    * @param {number|string} variationId
    * @param {number|string} rawQuantity
    */
   function updateCartQuantityHandler(variationId, rawQuantity) {
      const checkbox = document.querySelector(
         `.select-pay[data-variation="${variationId}"]`
      );
      const input = document.querySelector(
         `.cart-quantity-input[data-variation="${variationId}"]`
      );
      const quantityDisplay = document.querySelector(
         `.cart-quantity-display[data-variation="${variationId}"]`
      );

      if (!checkbox || !input) {
         return;
      }

      const previousQuantity = parseInt(checkbox.dataset.quantity || "1", 10);
      const min = parseInt(input.min || "1", 10);
      const max = parseInt(input.max || "0", 10);
      let quantity = parseInt(rawQuantity, 10);

      if (Number.isNaN(quantity) || quantity < min) {
         quantity = previousQuantity;
      } else if (!Number.isNaN(max) && max > 0 && quantity > max) {
         quantity = max;
      }

      input.value = quantity.toString();
      checkbox.dataset.quantity = quantity.toString();
      if (quantityDisplay) {
         quantityDisplay.textContent = quantity.toString();
      }
      updateSummary();

      fetch("../php/update-cart-quantity.php", {
         method: "POST",
         headers: {
            "Content-Type": "application/json",
         },
         body: JSON.stringify({
            variation_id: Number(variationId),
            quantity,
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
               throw new Error(data.message || "Failed to update quantity");
            }

            const confirmedQuantity = parseInt(data.quantity, 10);
            checkbox.dataset.quantity = confirmedQuantity.toString();
            input.value = confirmedQuantity.toString();
            if (quantityDisplay) {
               quantityDisplay.textContent = confirmedQuantity.toString();
            }
            updateSummary();
         })
         .catch((error) => {
            console.error(error);
            notify(
               error.message || "Could not update the quantity. Try again.",
               "error"
            );
            input.value = previousQuantity.toString();
            checkbox.dataset.quantity = previousQuantity.toString();
            if (quantityDisplay) {
               quantityDisplay.textContent = previousQuantity.toString();
            }
            updateSummary();
         });
   }

   // Expose handler globally for inline event usage
   window.updateCartQuantity = updateCartQuantityHandler;
})();
