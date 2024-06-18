<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit();
}

// Função para verificar o nível de acesso
function has_access($required_sector) {
    $sectors_hierarchy = ['Ven' => 1, 'Ecom' => 2, 'Dev' => 3, 'Adm' => 4];
    return isset($_SESSION['sector']) && isset($sectors_hierarchy[$_SESSION['sector']]) && $sectors_hierarchy[$_SESSION['sector']] >= $sectors_hierarchy[$required_sector];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAEC - Home</title>
    <link rel="stylesheet" href="style.css">
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
            // Array que define os itens do menu com níveis de acesso
            $menuItems = [
                'Home' => ['icon' => 'bi-house-door', 'link' => '../home', 'sector' => 'Dev'],
                'Dashboard' => ['icon' => 'bi-columns-gap', 'link' => '#', 'sector' => 'Dev'],
                'Sistema Senha' => ['icon' => 'bi-pass', 'link' => '../manager', 'sector' => 'Dev'],
                'Configurações' => ['icon' => 'bi-gear', 'link' => '#', 'sector' => 'Dev'],
                'Conta' => ['icon' => 'bi-person-circle', 'link' => 'javascript:void(0);', 'sector' => 'Ven', 'id' => 'userDropdown']
            ];

            // Renderiza os itens do menu com base no nível de acesso
            foreach ($menuItems as $name => $item) {
                if (has_access($item['sector'])) {
                    echo '<li class="item-menu">';
                    echo '<a href="' . $item['link'] . '"';
                    if (isset($item['id'])) echo ' id="' . $item['id'] . '"';
                    echo '>';
                    echo '<span class="icon"><i class="bi ' . $item['icon'] . '"></i></span>';
                    echo '<span class="txt-link">' . $name . '</span>';
                    echo '</a>';
                    if ($name == 'Conta') {
                        echo '<div id="userDropdownContent" class="dropdown-content">';
                        echo '<p>Nome de usuário: ' . $_SESSION['username'] . '</p>';
                        if (isset($_SESSION['sector'])) {
                            echo '<p>Setor: ' . $_SESSION['sector'] . '</p>';
                        }
                        echo '<a href="logout.php" class="logout-btn">Deslogar</a>';
                        echo '</div>';
                    }
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </nav><!--menu-lateral-->

    <script src="menu.js"></script>
</body>
</html>
