document.addEventListener('DOMContentLoaded', function() {
    const btnExpandir = document.getElementById('btn-exp');
    const menuLateral = document.querySelector('.menu-lateral');

    btnExpandir.addEventListener('click', function() {
        menuLateral.classList.toggle('minimizado');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const btnExpandir = document.getElementById('btn-exp');
    const menuLateral = document.querySelector('.menu-lateral');
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownContent = document.getElementById('userDropdownContent');

    btnExpandir.addEventListener('click', function() {
        menuLateral.classList.toggle('minimizado');
    });

    userDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
        userDropdownContent.style.display = userDropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function(event) {
        if (!userDropdown.contains(event.target) && !userDropdownContent.contains(event.target)) {
            userDropdownContent.style.display = 'none';
        }
    });
});
