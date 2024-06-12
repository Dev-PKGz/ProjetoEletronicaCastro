<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAEC - Home </title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</head>
<body>
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div><!--btn-expandir-->

        <ul>
            <?php
            // Array que define os itens do menu
            $menuItems = [
                'Home' => ['icon' => 'bi-house-door', 'link' => '#'],
                'Dashboard' => ['icon' => 'bi-columns-gap', 'link' => '#'],
                'Agenda' => ['icon' => 'bi-calendar3', 'link' => '#'],
                'Configurações' => ['icon' => 'bi-gear', 'link' => '#'],
                'Conta' => ['icon' => 'bi-person-circle', 'link' => 'user']
            ];

            // Renderiza os itens do menu
            foreach ($menuItems as $name => $item) {
                echo '<li class="item-menu">';
                echo '<a href="' . $item['link'] . '">';
                echo '<span class="icon"><i class="bi ' . $item['icon'] . '"></i></span>';
                echo '<span class="txt-link">' . $name . '</span>';
                echo '</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </nav><!--menu-lateral-->
    <script src="menu.js"></script>
</body>
</html>
