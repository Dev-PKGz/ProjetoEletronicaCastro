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
            // Array que define os itens do menu com setores de acesso
            $menuItems = [
                'Home' => ['icon' => 'bi-house-door', 'link' => '../home', 'sectors' => ['Dev','Ven', 'ecom', 'Adm']],
                'Dashboard' => ['icon' => 'bi-columns-gap', 'link' => '#', 'sectors' => ['Dev', 'Adm']],
                'Sistema Senha' => ['icon' => 'bi-pass', 'link' => '../painel_senhas', 'sectors' => ['Dev', 'Ven']],
                'Configurações' => ['icon' => 'bi-gear', 'link' => '#', 'sectors' => ['Dev', 'Adm']],
                'Conta' => ['icon' => 'bi-person-circle', 'link' => '#', 'sectors' => ['Dev', 'Ven', 'ecom', 'Adm']]            
            ];

            // Renderiza os itens do menu com base no setor de acesso
            foreach ($menuItems as $name => $item) {
                if (has_access($item['sectors'])) {
                    echo '<li class="item-menu">';
                    echo '<a href="' . $item['link'] . '"';
                    if (isset($item['id'])) echo ' id="' . $item['id'] . '"';
                    echo '>';
                    echo '<span class="icon"><i class="bi ' . $item['icon'] . '"></i></span>';
                    echo '<span class="txt-link">' . $name . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
            }
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
