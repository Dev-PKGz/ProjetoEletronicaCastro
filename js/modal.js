function showModal(userId) {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('user-id').value = userId;
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Fecha o modal clicando fora dele (na área escura)
window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
            modals[i].style.display = "none";
        }
    }
}