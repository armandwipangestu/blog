// apply HighlightJS
var pres = document.querySelectorAll("pre>code");
for (var i = 0; i < pres.length; i++) {
  hljs.highlightElement(pres[i]);
}
    
// add HighlightJS-badge (options are optional)
var options = {   // optional
  //contentSelector: "#ArticleBody",

  // CSS class(es) used to render the copy icon.
  copyIconClass: "fas fa-clone",
  // CSS class(es) used to render the done icon.
  checkIconClass: "fas fa-check text-success"
};

window.highlightJsBadge(options);
