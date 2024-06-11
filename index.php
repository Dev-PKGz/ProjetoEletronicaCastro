<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Auxiliar Eletronica Castro</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="login-container">
        <!-- Adicione sua logo aqui -->
        <img src="./img/logo_inicio.png" alt="Logo da Empresa" class="logo">
        
        <h2>Bem-vindo</h2>
        <form action="connections/process_login.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Digite Seu E-mail" required>
            
            <label for="password">Senha:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Digite Sua Senha" required>
                <i id="togglePassword" class="bi bi-eye toggle-password" onclick="togglePasswordVisibility()"></i>
            </div>
            
            <button type="submit">Entrar</button>
        </form>
        <a class="register-link" href="register">Não tem uma conta? Cadastre-se</a>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
