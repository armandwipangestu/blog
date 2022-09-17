const codes = document.querySelectorAll("code");
const pre = document.querySelectorAll("pre");
// codes.forEach((res) => {
//   const toggleCodeTheme = document.createElement("i");
//   toggleCodeTheme.setAttribute("class", "fas fa-moon code-theme");
//   codeBadge.forEach((badge) => {
//     res.insertBefore(toggleCodeTheme, badge.firstChild);
//   });
//   console.log(res);
//   //   res.appendChild(toggleCodeTheme);
// });

pre.forEach((badge) => {
  const d = document.createElement("div");
  d.setAttribute("class", "container");
  const toggleCodeTheme = document.createElement("i");
  toggleCodeTheme.setAttribute("class", "fas fa-moon code-theme text-dark");
  d.appendChild(toggleCodeTheme);
  badge.insertBefore(d, badge.firstChild);
});

const getToggle = document.querySelectorAll(".code-theme");
let stateTheme = "dark";
getToggle.forEach((res) => {
  res.addEventListener("click", () => {
    if (stateTheme == "dark") {
      res.setAttribute("class", "fas fa-sun code-theme text-light");
      stateTheme = "light";
      document
        .querySelector(`link[title="${highlightLightTheme}"]`)
        .removeAttribute("disabled");

      document
        .querySelector(`link[title="${highlightDarkTheme}"]`)
        .setAttribute("disabled", "disabled");
    } else {
      res.setAttribute("class", "fas fa-moon code-theme text-light");
      stateTheme = "dark";
      document
        .querySelector(`link[title="${highlightDarkTheme}"]`)
        .removeAttribute("disabled");

      document
        .querySelector(`link[title="${highlightLightTheme}"]`)
        .setAttribute("disabled", "disabled");
    }
  });
});
