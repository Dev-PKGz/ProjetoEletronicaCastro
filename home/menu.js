document.addEventListener('DOMContentLoaded', function() {
    const btnExpandir = document.getElementById('btn-exp');
    const menuLateral = document.querySelector('.menu-lateral');

    btnExpandir.addEventListener('click', function() {
        menuLateral.classList.toggle('minimizado');
    });
});
