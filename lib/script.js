const judul = document.querySelector('.judul-input');
const previewKolom = document.querySelector('.preview-colom');

// Create reference instance
const marked = require('marked.min.js');

// Set options
// `highlight` example uses https://highlightjs.org
marked.setOptions({
  renderer: new marked.Renderer(),
  highlight: function (code, lang) {
    const hljs = require('highlight.js');
    const language = hljs.getLanguage(lang) ? lang : 'plaintext';
    return hljs.highlight(code, { language }).value;
  },
  pedantic: false,
  gfm: true,
  breaks: false,
  sanitize: false,
  smartLists: true,
  smartypants: false,
  xhtml: false
});

// Compile
console.log(marked('```php echo ```'));

judul.addEventListener('keyup', function () {
  previewKolom.innerHTML = marked(judul.value);
});