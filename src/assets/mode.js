// Runs before first paint (loaded without defer) so evening visitors don't see a flash of the day palette.
(() => {
  let m = null;
  try { m = localStorage.getItem("mode"); } catch { /* storage blocked */ }
  const h = new Date().getHours();
  document.documentElement.dataset.mode = m === "day" || m === "evening" ? m : (h >= 18 || h < 7 ? "evening" : "day");
})();
