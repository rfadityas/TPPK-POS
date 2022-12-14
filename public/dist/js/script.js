const themeSwitch = document.querySelector("#theme-switcher");

if (
  localStorage.theme === "dark" ||
  (!("theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.setAttribute("data-theme", "dark");
  themeSwitch.checked = false;
} else {
  document.documentElement.setAttribute("data-theme", "light");
  themeSwitch.checked = true;
}

themeSwitch.addEventListener("click", () => {
  if (document.documentElement.getAttribute("data-theme") === "dark") {
    document.documentElement.setAttribute("data-theme", "light");
    localStorage.theme = "light";
  } else {
    document.documentElement.setAttribute("data-theme", "dark");
    localStorage.theme = "dark";
  }
});
