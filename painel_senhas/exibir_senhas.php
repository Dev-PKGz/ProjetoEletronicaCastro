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
        <source src="sound/alert.mp3" type="audio/mpeg">
        Seu navegador não suporta áudio HTML5.
    </audio>

    <script src="javascript/exibir_senhas.js"></script>
</body>
</html>