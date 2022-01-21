// Preview Image untuk tambah dan ubah
function previewImage() {
  const gambar = document.querySelector(".gambar-preview");
  const imgPreview = document.querySelector(".img-preview");
  // console.log(imgPreview);

  const oFReader = new FileReader();
  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };

}