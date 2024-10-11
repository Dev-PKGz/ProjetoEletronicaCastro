<?php

require_once '/xampp/htdocs/connections/check_page_access.php';
check_page_access(['Ven', 'Dev', 'ecom']);

// Verificar e salvar a seleção do som
$selectedSoundFile = 'sound/selected_alert.txt';
$selectedSound = 'alert2.mp3'; // Valor padrão

// Carregar o som salvo, se existir
if (file_exists($selectedSoundFile)) {
    $selectedSound = file_get_contents($selectedSoundFile);
}

// Salvar nova seleção se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alertSound'])) {
    $selectedSound = $_POST['alertSound'];
    file_put_contents($selectedSoundFile, $selectedSound);  // Salva a seleção em um arquivo
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/css/menu_style.css">
    <link rel="stylesheet" href="css/style_manager.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Gerenciar Som de Alerta</title>
</head>
<body>
<nav class="menu-lateral">
    <div class="btn-expandir" id="btn-exp">
        <i class="bi bi-list" id="btn-exp"></i>
    </div>

    <ul>
        <?php include('../connections/menu.php'); ?>
        <li class="item-menu">
            <a href="../connections/logout.php">
                <span class="icon"><i class="bi bi-box-arrow-right"></i></span>
                <span class="txt-link">Logout</span>
            </a>
        </li>
    </ul>
</nav>

<script src="../home/javascript/menu.js"></script>

<div class="container">
    <h1>Gerenciar Som de Alerta</h1>
    
    <!-- Formulário para selecionar o som de alerta -->
    <form method="POST">
        <label for="alertSound">Selecione o som de alerta:</label>
        <select name="alertSound" id="alertSound">
            <option value="alert1.mp3" <?php if ($selectedSound == 'alert1.mp3') echo 'selected'; ?>>Alerta 1</option>
            <option value="alert2.mp3" <?php if ($selectedSound == 'alert2.mp3') echo 'selected'; ?>>Alerta 2</option>
            <option value="alert3.mp3" <?php if ($selectedSound == 'alert3.mp3') echo 'selected'; ?>>Alerta 3</option>
        </select>
        <button type="submit" class="button">Salvar Som</button>
    </form>
</div>

</body>
</html>
