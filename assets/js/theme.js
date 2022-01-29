const toggleTheme = document.querySelector(".toggle-theme");
const tag = document.querySelector(".tag");
const links = document.querySelectorAll(".fa-link");
const cards = document.querySelectorAll(".card");
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
  } else if (bodyTheme == "bg-light text-dark") {
    document.getElementsByTagName("BODY")[0].className = "bg-dark text-white";
    tag.className = "btn btn-light tag";
    links.forEach(link => {
      link.className = "fas fa-link me-2 text-white";
    });
    cards.forEach(card => {
      card.className = "card border-dark mb-3 rounded";
    });
  }
});
