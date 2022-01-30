const toggleTheme = document.querySelector(".toggle-theme");
const tag = document.querySelector(".tag");
const links = document.querySelectorAll(".fa-link");
const cards = document.querySelectorAll(".card");
const highlightLightTheme = "base16/one-light.min";
const highlightDarkTheme = "atom-one-dark-reasonable.min";
toggleTheme.addEventListener("click", function() {
  const bodyTheme = document.getElementsByTagName("BODY")[0].className;
  if (bodyTheme == "bg-dark text-white") {
    document.getElementsByTagName("BODY")[0].className = "bg-light text-dark";
    tag.className = "btn btn-dark tag";
    links.forEach(link => {
      link.className = "fas fa-link me-2 text-dark";
    });
    cards.forEach(card => {
      card.className = "card border-light mb-3 rounded";
    });
    document
      .querySelector(`link[title="${highlightDarkTheme}"]`)
      .removeAttribute("disabled");
    document
      .querySelector(`link[title="${highlightLightTheme}"]`)
      .setAttribute("disabled", "disabled");
  } else if (bodyTheme == "bg-light text-dark") {
    document.getElementsByTagName("BODY")[0].className = "bg-dark text-white";
    tag.className = "btn btn-light tag";
    links.forEach(link => {
      link.className = "fas fa-link me-2 text-white";
    });
    cards.forEach(card => {
      card.className = "card border-dark mb-3 rounded";
    });
    document
      .querySelector(`link[title="${highlightLightTheme}"]`)
      .removeAttribute("disabled");
    document
      .querySelector(`link[title="${highlightDarkTheme}"]`)
      .setAttribute("disabled", "disabled");
  }
});
