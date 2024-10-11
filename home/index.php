<?php
require_once '/xampp/htdocs/connections/check_page_access.php'; // Certifique-se de incluir o arquivo com as funções
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAEC - Home</title>
    <link rel="stylesheet" href="css/menu_style.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
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

    <div class="home-content">
        <h1 class="home-title">Bem-vindo ao Sistema SAEC</h1>
        <div class="home-cards">
            <div class="card">
                <i class="bi bi-person-circle card-icon"></i>
                <h3>Usuários</h3>
                <p>Gerencie usuários, permissões e funções no sistema.</p>
            </div>
            <div class="card">
                <i class="bi bi-gear-fill card-icon"></i>
                <h3>Configurações</h3>
                <p>Ajuste configurações do sistema conforme suas necessidades.</p>
            </div>
            <div class="card">
                <i class="bi bi-bar-chart-fill card-icon"></i>
                <h3>Relatórios</h3>
                <p>Acesse relatórios detalhados de desempenho.</p>
            </div>
        </div>
    </div>

    <script src="javascript/menu.js"></script>
</body>
</html>
