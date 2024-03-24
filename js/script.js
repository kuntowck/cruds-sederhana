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