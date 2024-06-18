function chamarProximaSenha() {
    fetch('./connections/chamar_proxima_senha.php')
        .then(response => response.json())
        .then(data => {
            const messageElement = document.getElementById('message');
            messageElement.innerText = data.message;
            if (data.message === "Nenhuma senha na fila") {
                messageElement.classList.add('error');
            } else {
                messageElement.classList.remove('error');
            }
            setTimeout(() => { messageElement.innerText = ""; }, 2000);
        });
}