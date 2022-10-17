const heading3 = document.querySelectorAll("h3");
const tocTarget = document.querySelectorAll("#tocTarget");
const toc = document.querySelector("#toc");
const ulToc = document.createElement("ul");

heading3.forEach((h3) => {
  let anchor = document.createElement("a");
  let br = document.createElement("br");
  tocTarget.forEach((tt) => {
    if (`${window.location.href}#${h3.innerText}` === decodeURIComponent(tt)) {
      anchor.href = tt.href;
    }
  });
  anchor.text = `• ${h3.innerText}`;
  anchor.insertBefore(br, anchor.firstChild);
  toc.append(anchor);
});
