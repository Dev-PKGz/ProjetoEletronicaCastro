function gerarSenha() {
    fetch('./connections/gerar_senha.php')
        .then(response => response.json())
        .then(data => {
            const messageElement = document.getElementById('message');
            messageElement.innerText = "Nova senha gerada!";
            messageElement.classList.remove('error');
            setTimeout(() => { messageElement.innerText = ""; }, 2000);
        });
}