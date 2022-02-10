// apply HighlightJS
var pres = document.querySelectorAll("pre>code");
for (var i = 0; i < pres.length; i++) {
  hljs.highlightElement(pres[i]);
}
    
// add HighlightJS-badge (options are optional)
var options = {   // optional
  //contentSelector: "#ArticleBody",

  // CSS class(es) used to render the copy icon.
  copyIconClass: "fa fa-copy",
  // CSS class(es) used to render the done icon.
  checkIconClass: "fa fa-check-circle text-success"
};

window.highlightJsBadge(options);
