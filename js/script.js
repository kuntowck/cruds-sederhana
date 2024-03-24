const keyword = document.querySelector('.keyword');
const tombolCari = document.querySelector('.tombol-cari');
const container = document.querySelector('.container');

tombolCari.style.display = 'none';

keyword.addEventListener('keyup', function(){
    ajax - xmlhttprequest
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    }

    xhr.open('get', 'ajax/ajax.php?keyword=' + keyword.value);
    xhr.send();

    // // fetch()
    // fetch('ajax/ajax.php?keyword=' + keyword.value)
    //     .then(response => response.text())
    //     .then(response => container.innerHTML = response);
});