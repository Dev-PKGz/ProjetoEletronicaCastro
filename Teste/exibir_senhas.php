<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senhas da Fila</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; text-align: center; }
        .senha { font-size: 24px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Senhas da Fila</h1>
        <div class="senha">
            <h2>Senha Atual: <span id="senhaAtual"></span></h2>
        </div>
        <div class="senha">
            <h2>Próxima Senha: <span id="proximaSenha"></span></h2>
        </div>
    </div>

    <script>
        function atualizarSenhas() {
            fetch('obter_senhas.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('senhaAtual').innerText = data.senha_atual;
                    document.getElementById('proximaSenha').innerText = data.proxima_senha;
                });
        }

        setInterval(atualizarSenhas, 1000);  // Atualiza a cada 1 segundo
        window.onload = atualizarSenhas;
    </script>
</body>
</html>
