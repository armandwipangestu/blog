// Get Element
const toggleTheme = document.querySelector(".toggle-theme");
const tag = document.querySelector(".tag");
const links = document.querySelectorAll(".fa-link");
const hashtags = document.querySelectorAll(".fa-hashtag");
const cardBodys = document.querySelectorAll(".card-body");
const cardFooters = document.querySelectorAll(".card-footer");
const codes = document.querySelectorAll("code");
const highlightLightTheme = "github.min";
const highlightDarkTheme = "github-dark-dimmed.min";
const tables = document.querySelectorAll("table");

const setTheme = (theme) => {
  document.documentElement.className = theme;
}

toggleTheme.addEventListener("click", function() {
  const bodyTheme = document.getElementsByTagName("BODY")[0].className;
  if (bodyTheme == "bg-dark text-light") {
    setTheme('bg-light text-dark');
    console.log(setTheme());
    document.getElementsByTagName("BODY")[0].className = "bg-light text-dark";

    //tag.className = "btn btn-dark tag";
    
    links.forEach(link => {
      link.className = "fas fa-link me-2 text-dark";
    });

    hashtags.forEach(hashtag => {
      hashtag.className = "fas fa-hashtag me-2 text-dark";
    });

    cardBodys.forEach(cardBody => {
      cardBody.className = "card-body bg-light text-dark";
    });

    cardFooters.forEach(cardFooter => {
      cardFooter.className = "card-footer bg-light text-dark";
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

    links.forEach(link => {
      link.className = "fas fa-link me-2 text-light";
    });

    hashtags.forEach(hashtag => {
      hashtag.className = "fas fa-hashtag me-2 text-light";
    });

    cardBodys.forEach(cardBody => {
      cardBody.className = "card-body bg-dark text-light";
    });

    cardFooters.forEach(cardFooter => {
      cardFooter.className = "card-footer bg-dark text-light";
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
