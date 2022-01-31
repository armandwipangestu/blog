hljs.highlightAll();
hljs.initLineNumbersOnLoad();
//hljs.initHighlightingOnLoad();
//hljs.initLineNumbersOnLoad();

const errorAlert = document.querySelectorAll("#errorAlert");
errorAlert.forEach(eA => {
  eA.addEventListener("click", function () {
    Swal.fire({
      icon: 'error',
      title: 'Error'
    });
  });
});

//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

document.addEventListener('copy', (event) => {
  const pagelink = "prank :v";

  event.clipboardData.setData('text/plan',
    document.getSelection() + pagelink);

  event.preventDefault();
})
