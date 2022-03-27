// Get Element
const toggleTheme = document.querySelector(".toggle-theme");
const tag = document.querySelector(".tag");
const links = document.querySelectorAll(".fa-link");
const hashtags = document.querySelectorAll(".fa-hashtag");
const searchBar = document.querySelector(".search");
const cards = document.querySelectorAll(".card");
const cardBodys = document.querySelectorAll(".card-body");
const cardFooters = document.querySelectorAll(".card-footer");
const codes = document.querySelectorAll("code");
const highlightLightTheme = "github.min";
const highlightDarkTheme = "github-dark-dimmed.min";
const tables = document.querySelectorAll("table");

toggleTheme.addEventListener("click", function () {
  const bodyTheme = document.getElementsByTagName("BODY")[0].className;
  if (bodyTheme == "bg-dark text-light") {
    document.getElementsByTagName("BODY")[0].className = "bg-light text-dark";

    //tag.className = "btn btn-dark tag";
    //searchBar.className = "form-control search bg-light text-dark mt-5 text-center";

    links.forEach(link => {
      link.className = "fas fa-link me-2 text-dark";
    });

    hashtags.forEach(hashtag => {
      hashtag.className = "fas fa-hashtag me-2 text-dark";
    });

    cards.forEach(card => {
      card.className = "card h-100 bg-light text-dark";
    });

    cardBodys.forEach(cardBody => {
      cardBody.className = "card-body bg-light text-dark";
    });

    cardFooters.forEach(cardFooter => {
      cardFooter.className = "card-footer bg-light text-dark text-end";
    });

    tables.forEach(table => {
      table.className = "table table-dark table-striped table-bordered";
    });

    document
      .querySelector(`link[title="${highlightDarkTheme}"]`)
      .removeAttribute("disabled");

    document
      .querySelector(`link[title="${highlightLightTheme}"]`)
      .setAttribute("disabled", "disabled");

  } else if (bodyTheme == "bg-light text-dark") {

    document.getElementsByTagName("BODY")[0].className = "bg-dark text-light";

    //tag.className = "btn btn-light tag";
    //searchBar.className = "form-control search bg-dark text-light mt-5 text-center";

    links.forEach(link => {
      link.className = "fas fa-link me-2 text-light";
    });

    hashtags.forEach(hashtag => {
      hashtag.className = "fas fa-hashtag me-2 text-light";
    });

    cards.forEach(card => {
      card.className = "card h-100 bg-dark text-light";
    });

    cardBodys.forEach(cardBody => {
      cardBody.className = "card-body bg-dark text-light";
    });

    cardFooters.forEach(cardFooter => {
      cardFooter.className = "card-footer bg-dark text-light text-end";
    });

    tables.forEach(table => {
      table.className = "table table-secondary table-striped table-bordered";
    });

    document
      .querySelector(`link[title="${highlightLightTheme}"]`)
      .removeAttribute("disabled");

    document
      .querySelector(`link[title="${highlightDarkTheme}"]`)
      .setAttribute("disabled", "disabled");
  }
});
