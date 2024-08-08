<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /index.php");
    exit();
    $_SESSION['username'] = $nomeDoUsuarioLogado;
}

// Função para verificar acesso com base em credenciais específicas
function has_access($required_sectors) {
    if (!isset($_SESSION['sector'])) {
        return false;
    }
    
    return in_array($_SESSION['sector'], $required_sectors);
}

// Função para verificar o acesso à página
function check_page_access($required_sectors) {
    if (!has_access($required_sectors)) {
        echo '<script>alert("Usuário não autorizado"); window.location.href = "../home";</script>';
        exit();
    }
}
?>


