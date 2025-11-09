document.addEventListener("DOMContentLoaded", () => {
   const carousels = document.querySelectorAll(".product-carousel");

   carousels.forEach((carousel) => {
      const wrapper = carousel.querySelector(".product-wrapper");
      const rightArrow = carousel.querySelector(".arrow-right");
      const leftArrow = carousel.querySelector(".arrow-left");
      const MAX_VISIBLE_DESKTOP = 3;
      const cards = wrapper
         ? Array.from(wrapper.querySelectorAll(".product-card"))
         : [];

      if (!wrapper || !rightArrow || !leftArrow || cards.length === 0) {
         return;
      }

      let currentIndex = 0;
      let visibleCount = Math.min(MAX_VISIBLE_DESKTOP, cards.length);

      const isTouchLayout = () =>
         window.matchMedia("(max-width: 768px)").matches;

      const readGap = () => {
         const styles = window.getComputedStyle(wrapper);
         const gapValue = styles.columnGap || styles.gap || "0";
         return parseFloat(gapValue) || 0;
      };

      const measureCardWidth = () => {
         const measuringCard =
            cards.find((card) => card.style.display !== "none") || cards[0];
         if (!measuringCard) {
            return 0;
         }

         let restoreDisplay = null;
         if (measuringCard.style.display === "none") {
            restoreDisplay = measuringCard.style.display;
            measuringCard.style.display = "flex";
         }

         const width = measuringCard.getBoundingClientRect().width;

         if (restoreDisplay !== null) {
            measuringCard.style.display = restoreDisplay;
         }

         return width;
      };

      const computeVisibleCount = () => {
         const carouselWidth = carousel.getBoundingClientRect().width;
         const wrapperWidth = wrapper.getBoundingClientRect().width;
         const arrowsWidth =
            leftArrow.getBoundingClientRect().width +
            rightArrow.getBoundingClientRect().width;
         const gap = readGap();
         const availableWidth = Math.max(
            wrapperWidth,
            carouselWidth - arrowsWidth - gap
         );

         const cardWidth = measureCardWidth();

         if (cardWidth <= 0 || availableWidth <= 0) {
            return 1;
         }

         const count = Math.floor((availableWidth + gap) / (cardWidth + gap));
         return Math.max(1, Math.min(cards.length, MAX_VISIBLE_DESKTOP, count));
      };

      const getMaxIndex = () => Math.max(0, cards.length - visibleCount);

      const applyTouchLayout = () => {
         cards.forEach((card) => {
            card.style.display = "flex";
         });
         leftArrow.classList.add("arrow-disabled");
         rightArrow.classList.add("arrow-disabled");
      };

      const applyDesktopLayout = () => {
         visibleCount = computeVisibleCount();
         const maxIndex = getMaxIndex();
         currentIndex = Math.min(currentIndex, maxIndex);

         cards.forEach((card, index) => {
            const shouldShow =
               index >= currentIndex && index < currentIndex + visibleCount;
            card.style.display = shouldShow ? "flex" : "none";
         });

         leftArrow.classList.toggle("arrow-disabled", currentIndex === 0);
         rightArrow.classList.toggle(
            "arrow-disabled",
            currentIndex >= maxIndex
         );
      };

      const updateLayout = () => {
         if (isTouchLayout()) {
            applyTouchLayout();
         } else {
            applyDesktopLayout();
         }
      };

      const scrollRight = () => {
         if (isTouchLayout()) {
            return;
         }
         const maxIndex = getMaxIndex();
         if (currentIndex < maxIndex) {
            currentIndex += 1;
            applyDesktopLayout();
         }
      };

      const scrollLeft = () => {
         if (isTouchLayout()) {
            return;
         }
         if (currentIndex > 0) {
            currentIndex -= 1;
            applyDesktopLayout();
         }
      };

      rightArrow.addEventListener("click", scrollRight);
      leftArrow.addEventListener("click", scrollLeft);

      let resizeFrame = null;
      const handleResize = () => {
         if (resizeFrame) {
            cancelAnimationFrame(resizeFrame);
         }
         resizeFrame = requestAnimationFrame(() => {
            currentIndex = 0;
            updateLayout();
            resizeFrame = null;
         });
      };

      window.addEventListener("resize", handleResize);

      updateLayout();
   });
});
