const toggleTheme = document.querySelector(".toggle-theme");
const tag = document.querySelector(".tag");
toggleTheme.addEventListener("click", function() {
  const bodyTheme = document.getElementsByTagName("BODY")[0].className;
  if (bodyTheme == "bg-dark text-white") {
    document.getElementsByTagName("BODY")[0].className = "bg-light text-dark";
    tag.className = "btn btn-dark tag";
  } else if (bodyTheme == "bg-light text-dark") {
    document.getElementsByTagName("BODY")[0].className = "bg-dark text-white";
    tag.className = "btn btn-light tag";
  }
});
