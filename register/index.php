<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAEC - Registro</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h3>Registrar</h3>
        <form id="registerForm" action="../connections/process_register.php" method="POST">
            <label for="username">Nome:</label>
            <input type="text" id="username" name="username" placeholder="Digite Seu Nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Digite Seu E-mail" required>
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" minlength="6" placeholder="Digite Sua Senha" required>
            
            <label for="sector">Setor:</label>
            <select id="sector" name="sector" required>
                <option value="">Selecione o Setor</option>
                <option value="Adm">Administração</option>
                <option value="Dev">Desenvolvimento</option>
                <option value="ecom">E-Com</option>
                <option value="Ven">Vendedor</option>
                <!-- Adicione outros setores conforme necessário -->
            </select>
            
            <button type="submit">Registrar</button>
        </form>
        <a class="login-link" href="/index.php">Já tem uma conta? Faça login</a>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
