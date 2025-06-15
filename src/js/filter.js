document.addEventListener("DOMContentLoaded", () => {
  const archivePills = document.querySelectorAll(".archive-filter a");
  const archiveGrid = document.querySelector(".archive-grid");

  if (!archiveGrid || archivePills.length === 0) return;

  archivePills.forEach((pill) => {
    pill.addEventListener("click", (e) => {
      e.preventDefault();
      const filter = pill.getAttribute("data-filter");

      // Update active state
      archivePills.forEach((p) => p.classList.remove("active"));
      pill.classList.add("active");

      // Filter items
      const gridItems = Array.from(archiveGrid.children);

      gridItems.forEach((item) => {
        if (filter === "all" || item.classList.contains(filter)) {
          item.classList.remove("hidden");
        } else {
          item.classList.add("hidden");
        }
      });
    });
  });
});
