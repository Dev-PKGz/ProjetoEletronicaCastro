<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit();
}

// Função para verificar o nível de acesso
function has_access($required_sectors) {
    $sectors_hierarchy = ['Ven' => 1, 'ecom' => 2, 'Dev' => 3, 'Adm' => 4];
    if (!isset($_SESSION['sector']) || !isset($sectors_hierarchy[$_SESSION['sector']])) {
        return false;
    }
    
    foreach ($required_sectors as $sector) {
        if (isset($sectors_hierarchy[$sector]) && $sectors_hierarchy[$_SESSION['sector']] >= $sectors_hierarchy[$sector]) {
            return true;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/style.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
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
<nav class="menu-lateral">
        <div class="btn-expandir" id="btn-exp">
            <i class="bi bi-list" id="btn-exp"></i>
        </div><!--btn-expandir-->

        <ul>
            <?php
           // Array que define os itens do menu com níveis de acesso
           $menuItems = [
            'Home' => ['icon' => 'bi-house-door', 'link' => '#', 'sectors' => ['Dev']],
            'Dashboard' => ['icon' => 'bi-columns-gap', 'link' => '#', 'sectors' => ['Dev']],
            'Sistema Senha' => ['icon' => 'bi-pass', 'link' => '../manager', 'sectors' => ['Dev']],
            'Configurações' => ['icon' => 'bi-gear', 'link' => '#', 'sectors' => ['ecom']],
            'Conta' => ['icon' => 'bi-person-circle', 'link' => 'javascript:void(0);', 'sectors' => ['Ven', 'Dev'], 'id' => 'userDropdown']
        ];

             // Renderiza os itens do menu com base no nível de acesso
            foreach ($menuItems as $name => $item) {
                if (has_access($item['sectors'])) {
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

    <script src="../home/menu.js"></script>

    <div class="container">
        <h1>Gerenciador de Fila com Senha</h1>
        <button onclick="gerarSenha()">Gerar Nova Senha</button>
        <button onclick="chamarProximaSenha()">Chamar Próxima Senha</button>
        <div id="message" class="message"></div>
        <br><br>
        <a href="exibir_senhas.php" target="_blank" class="button">Abrir Exibir Senhas</a>
    </div>

    <script src="javascript/gerar_senha.js"></script>
    <script src="javascript/chamar_proxima_senha.js"></script>
</body>
</html>
