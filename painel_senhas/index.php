<?php

require_once '/xampp/htdocs/connections/check_page_access.php'; // Certifique-se de incluir o arquivo com as funções

// Verifica o acesso à página
check_page_access(['Ven', 'Dev', 'ecom']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/css/style.css">
    <link rel="stylesheet" href="css/style_manager.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <title>Gerenciador de Fila com Senha</title>
</head>
<body>
<nav class="menu-lateral">
        <div class="btn-expandir" id="btn-exp">
            <i class="bi bi-list" id="btn-exp"></i>
        </div><!--btn-expandir-->

        <ul>
        <?php
            include('../connections/menu.php');
            ?>
                        <!-- Item Logout -->
                        <li class="item-menu">
                <a href="../connections/logout.php">
                    <span class="icon"><i class="bi bi-box-arrow-right"></i></span>
                    <span class="txt-link">Logout</span>
                </a>
            </li>

        </ul>
    </nav><!--menu-lateral-->

    <script src="../home/javascript/menu.js"></script>

    <div class="container">
        <h1>Sistema de Senha e Fila</h1>
        <button onclick="chamarProximaSenha()" class="button">Chamar Próxima Senha</button>
        <div id="message" class="message"></div>
        <br><br>
        <a href="exibir_senhas" target="_blank" class="button">Abrir Exibir Senhas</a>
    </div>

    <script src="javascript/gerar_senha.js"></script>
    <script src="javascript/chamar_proxima_senha.js"></script>
</body>
</html>
