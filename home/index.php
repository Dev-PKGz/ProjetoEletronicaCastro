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
    <link rel="stylesheet" href="css/style.css">
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

    <script src="javascript/menu.js"></script>
</body>
</html>
