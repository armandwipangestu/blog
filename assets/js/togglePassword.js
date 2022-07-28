const togglePassword = document.querySelector("#togglePassword");
const formPassword = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
  const type =
    formPassword.getAttribute("type") === "password"
      ? "text"
      : "password";
  formPassword.setAttribute("type", type);
  if (type === "text") {
    togglePassword.className = "text-primary"
  } else if (type === "password") {
    togglePassword.className = "text-muted"
  }
});

let icon = togglePassword
  .querySelector("#iconTogglePassword")
  .getAttribute("class");

const changeIcon = (iconChange) => {
  $("#togglePassword").click(() => {
    $("#iconTogglePassword").toggleClass(`fas ${iconChange}`);
  });
  icon = `fas ${iconChange} input-icon`;

};

if (icon == "fas fa-eye input-icon") {
  changeIcon("fa-eye-slash");
}

if (icon == "fas fa-eye-slash input-icon") {
  changeIcon("fa-eye");
}