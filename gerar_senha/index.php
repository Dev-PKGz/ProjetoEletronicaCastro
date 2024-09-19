<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/css/style.css">
    <link rel="stylesheet" href="css/style_password.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <title>Gerenciador de Fila com Senha</title>
</head>
<body>

    <div class="container">
        <h1>Gerar Senha</h1>
        <button onclick="gerarSenha()" class="button">Gerar Nova Senha</button>
        <div id="message" class="message"></div>
    </div>

    <!-- Capturar a tecla F9 para gerar a senha -->
    <script>
        // Função para gerar uma nova senha
        function gerarSenha() {
            // Aqui você adiciona a lógica para gerar a senha
            document.getElementById('message').innerHTML = "Gerando nova senha...";
        }

        // Evento para capturar a tecla F9
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F9') {
                event.preventDefault();  // Evita a ação padrão da tecla F9 no navegador
                gerarSenha();  // Chama a função de gerar a senha
            }
        });
    </script>

    <script src="javascript/gerar_senha.js"></script>
</body>
</html>
