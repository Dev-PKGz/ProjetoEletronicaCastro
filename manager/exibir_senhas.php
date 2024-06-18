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
        .error { color: red; }
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

    <!-- Adicionando o elemento de áudio -->
    <audio id="alertSound">
        <source src="alert.mp3" type="audio/mpeg">
        Seu navegador não suporta áudio HTML5.
    </audio>

    <script>
        let lastProximaSenha = '';

        function atualizarSenhas() {
            fetch('obter_senhas.php')
                .then(response => response.json())
                .then(data => {
                    const senhaAtualElement = document.getElementById('senhaAtual');
                    const proximaSenhaElement = document.getElementById('proximaSenha');

                    // Verificar se a próxima senha mudou
                    if (data.proxima_senha !== lastProximaSenha) {
                        lastProximaSenha = data.proxima_senha;

                        // Tocar o som
                        const audio = document.getElementById('alertSound');
                        audio.currentTime = 0;  // Reinicia o áudio se já estiver tocando
                        audio.play();
                    }

                    senhaAtualElement.innerText = data.senha_atual;
                    proximaSenhaElement.innerText = data.proxima_senha;

                    // Adicionar classe de erro se não houver senha na fila
                    senhaAtualElement.classList.toggle('error', data.senha_atual === "Nenhuma senha na fila");
                    proximaSenhaElement.classList.toggle('error', data.proxima_senha === "Nenhuma senha na fila");
                });
        }

        setInterval(atualizarSenhas, 1000);  // Atualiza a cada 1 segundo
        window.onload = atualizarSenhas;
    </script>
</body>
</html>
