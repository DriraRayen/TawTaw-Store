(function () {
   const TOAST_DURATION = 4200;
   const container = document.createElement("div");
   container.className = "toast-container";

   function ensureContainer() {
      if (!document.body.contains(container)) {
         document.body.appendChild(container);
      }
   }

   function getIconMarkup(type) {
      switch (type) {
         case "success":
            return '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
         case "error":
            return '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.5"/><circle cx="12" cy="16.5" r="1.25" fill="currentColor"/></svg>';
         case "warning":
            return '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 9V13" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M12 17.2H12.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M10.6188 4.56596L2.26087 19.8261C1.86803 20.5542 2.39913 21.4348 3.21739 21.4348H20.7826C21.6009 21.4348 22.132 20.5542 21.7391 19.8261L13.3812 4.56597C12.9779 3.81801 12.0221 3.81801 11.6188 4.56596Z" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/></svg>';
         default:
            return '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.5H12.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M12 6.5V13" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.5"/></svg>';
      }
   }

   function showToast(message, options = {}) {
      if (!message) {
         return;
      }

      ensureContainer();

      const { type = "info", caption = "" } = options;
      const toast = document.createElement("div");
      toast.className = `toast toast-${type}`;

      const icon = document.createElement("div");
      icon.className = "toast-icon";
      icon.innerHTML = getIconMarkup(type);

      const content = document.createElement("div");
      content.className = "toast-content";

      const messageEl = document.createElement("p");
      messageEl.className = "toast-message";
      messageEl.textContent = message;
      content.appendChild(messageEl);

      if (caption) {
         const captionEl = document.createElement("p");
         captionEl.className = "toast-caption";
         captionEl.textContent = caption;
         content.appendChild(captionEl);
      }

      const closeButton = document.createElement("button");
      closeButton.className = "toast-close";
      closeButton.setAttribute("aria-label", "Close notification");
      closeButton.innerHTML = "&times;";

      closeButton.addEventListener("click", () => dismissToast(toast));

      toast.appendChild(icon);
      toast.appendChild(content);
      toast.appendChild(closeButton);

      container.appendChild(toast);

      requestAnimationFrame(() => {
         toast.classList.add("show");
      });

      const duration =
         typeof options.duration === "number"
            ? options.duration
            : TOAST_DURATION;
      let hideTimeout = window.setTimeout(() => dismissToast(toast), duration);
      toast.__hideTimeout = hideTimeout;

      toast.addEventListener("mouseenter", () => {
         window.clearTimeout(hideTimeout);
         toast.__hideTimeout = undefined;
      });

      toast.addEventListener("mouseleave", () => {
         if (!toast.dataset.dismissed) {
            hideTimeout = window.setTimeout(
               () => dismissToast(toast),
               duration / 1.5
            );
            toast.__hideTimeout = hideTimeout;
         }
      });

      return toast;
   }

   function dismissToast(toast) {
      if (!toast || toast.dataset.dismissed) {
         return;
      }
      if (toast.__hideTimeout) {
         window.clearTimeout(toast.__hideTimeout);
         toast.__hideTimeout = undefined;
      }
      toast.dataset.dismissed = "true";
      toast.classList.remove("show");
      toast.classList.add("hide");
      window.setTimeout(() => {
         if (toast.parentElement) {
            toast.parentElement.removeChild(toast);
         }
         if (container.childElementCount === 0 && container.parentElement) {
            container.parentElement.removeChild(container);
         }
      }, 220);
   }

   function showConfirm(message, options = {}) {
      if (!message) {
         return Promise.resolve(false);
      }

      const overlay = document.createElement("div");
      overlay.className = "confirm-overlay";

      const dialog = document.createElement("div");
      dialog.className = "confirm-dialog";

      const content = document.createElement("p");
      content.className = "confirm-message";
      content.textContent = message;

      const actions = document.createElement("div");
      actions.className = "confirm-actions";

      const confirmLabel = options.confirmText || "Confirm";
      const cancelLabel = options.cancelText || "Cancel";

      const confirmBtn = document.createElement("button");
      confirmBtn.className = "confirm-primary";
      confirmBtn.textContent = confirmLabel;

      const cancelBtn = document.createElement("button");
      cancelBtn.className = "confirm-secondary";
      cancelBtn.textContent = cancelLabel;

      actions.appendChild(cancelBtn);
      actions.appendChild(confirmBtn);

      dialog.appendChild(content);
      dialog.appendChild(actions);
      overlay.appendChild(dialog);
      document.body.appendChild(overlay);

      requestAnimationFrame(() => {
         overlay.classList.add("show");
      });

      return new Promise((resolve) => {
         function cleanup(result) {
            overlay.classList.remove("show");
            window.setTimeout(() => {
               if (overlay.parentElement) {
                  overlay.parentElement.removeChild(overlay);
               }
            }, 200);
            resolve(result);
         }

         confirmBtn.addEventListener("click", () => cleanup(true));
         cancelBtn.addEventListener("click", () => cleanup(false));

         overlay.addEventListener("click", (event) => {
            if (event.target === overlay) {
               cleanup(false);
            }
         });

         document.addEventListener(
            "keydown",
            function handleKeydown(event) {
               if (event.key === "Escape") {
                  event.preventDefault();
                  cleanup(false);
                  document.removeEventListener("keydown", handleKeydown);
               }
               if (event.key === "Enter") {
                  event.preventDefault();
                  cleanup(true);
                  document.removeEventListener("keydown", handleKeydown);
               }
            },
            { once: true }
         );
      });
   }

   window.showToast = showToast;
   window.showConfirm = showConfirm;
})();
