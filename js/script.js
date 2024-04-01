const keyword = document.querySelector('.keyword');
const tombolCari = document.querySelector('.tombol-cari');
const container = document.querySelector('.container');

tombolCari.style.display = 'none';

keyword.addEventListener('keyup', function(){
    // fetch()
    fetch('ajax/ajax.php?keyword=' + keyword.value)
        .then(response => response.text())
        .then(response => container.innerHTML = response);
});

// preview image untuk tambah dan ubah
function previewImage() {
    const gambar = document.querySelector('.gambar');
    const imgPreview = document.querySelector('.image-preview');
    const oFReader = new FileReader();

    oFReader.readAsDataURL(gambar.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}