document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".js-services-slider");
  const dots = document.querySelectorAll(".dot");

  if (!slider || dots.length === 0) return;
  dots.forEach((dot, index) => {
    dot.addEventListener("click", (e) => {
      e.preventDefault();
      const cards = slider.querySelectorAll(".service-card");
      if (cards[index]) {
        const scrollPos = cards[index].offsetLeft - slider.offsetLeft;
        slider.scrollTo({
          left: scrollPos,
          behavior: "smooth",
        });
      }
    });
  });

  slider.addEventListener("scroll", () => {
    const scrollLeft = slider.scrollLeft;
    const cardWidth = slider.querySelector(".service-card").offsetWidth + 15;
    const activeIndex = Math.round(scrollLeft / cardWidth);

    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === activeIndex);
    });
  });
});
