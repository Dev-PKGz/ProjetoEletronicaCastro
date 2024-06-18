<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Fila com Senha</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; text-align: center; }
        button { padding: 10px 20px; font-size: 18px; margin: 10px; }
        .message { font-size: 18px; color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciador de Fila com Senha</h1>
        <button onclick="gerarSenha()">Gerar Nova Senha</button>
        <button onclick="chamarProximaSenha()">Chamar Próxima Senha</button>
        <div id="message" class="message"></div>
    </div>

    <script>
        function gerarSenha() {
            fetch('gerar_senha.php')
                .then(response => response.json())
                .then(data => {
                    const messageElement = document.getElementById('message');
                    messageElement.innerText = "Nova senha gerada!";
                    messageElement.classList.remove('error');
                    setTimeout(() => { messageElement.innerText = ""; }, 2000);
                });
        }

        function chamarProximaSenha() {
            fetch('chamar_proxima_senha.php')
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
    </script>
</body>
</html>
