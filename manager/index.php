<?php
include('../connections/acess_db.php');
include('../connections/functions.php');
require_once '/xampp/htdocs/connections/check_page_access.php'; // Certifique-se de incluir o arquivo com as funções

// Verifica o acesso à página
check_page_access(['Dev', 'Adm']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/css/menu_style.css">
    <link rel="stylesheet" href="../painel_senhas//css/style_manager.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <script src="../home/javascript/menu.js"></script>
    <script src="../js/modal.js"></script>
    <title>Painel Administrador</title>
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

    <!-- Adicionando dois botões Configuração no topo -->
    <div class="config-anuncio-container">
        <a href="../painel_senhas/anuncio/" target="_blank" class="button2"><i class="bi bi-gear"></i> Configuração Anuncio</a>
        <a href="../painel_senhas/audio_config.php" target="_blank" class="button2" style="margin-left: 10px;"><i class="bi bi-gear"></i> Configuração Alerta</a>
    </div>

    <div class="container">
        <h2>Painel de Administração de Usuários</h2>

        <h3>Lista de Usuários</h3>
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Setor</th>
                <th>Ação</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["sector"]."</td><td><button onclick='showModal(".$row["id"].")'>Alterar</button><form method='post' action='' style='display:inline; margin-left: 10px;'><input type='hidden' name='id' value='".$row["id"]."'><button type='submit' name='delete_user' class='delete-button'>Deletar</button></form></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum usuário encontrado</td></tr>";
            }
            ?>
        </table>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form method="post" action="index.php">
                    <input type="hidden" id="user-id" name="id">
                    
                    <h3>Atualizar Email</h3>
                    <label for="email">Email:</label>
                    <input type="email" name="email"><br><br>
                    <input type="submit" name="update_email" value="Atualizar Email"><br><br>
                    
                    <h3>Atualizar Senha</h3>
                    <label for="password">Senha:</label>
                    <input type="password" name="password"><br><br>
                    <input type="submit" name="update_password" value="Atualizar Senha"><br><br>
                    
                    <h3>Atualizar Setor</h3>
                    <label for="sector">Setor:</label>
                    <select name="sector">
                        <option value="Dev">Desenvolvedor</option>
                        <option value="Adm">Administração</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Marketing">Marketing</option>
                        <option value="ecom">E-Com</option>
                        <option value="Ven">Vendedor</option>
                    </select><br><br>
                    <input type="submit" name="update_sector" value="Atualizar Setor"><br><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
