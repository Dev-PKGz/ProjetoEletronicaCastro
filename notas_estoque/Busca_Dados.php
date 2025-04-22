<?php
// Conexão com o banco de dados
$host = "192.168.0.239";
$user = "admin"; // Usuário do MySQL
$pass = "admin"; // Senha do MySQL (se houver)
$dbname = "BaseNotas";

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Captura os filtros
$fabricante = isset($_GET['fabricante']) ? $_GET['fabricante'] : '';
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$data_fim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';

$result = null; // Inicializa a variável de resultados apenas após a busca

if (!empty($fabricante) || (!empty($data_inicio) && !empty($data_fim))) {
    // Monta a consulta SQL
    $sql = "SELECT * FROM Entradas WHERE 1=1";

    if (!empty($fabricante)) {
        $sql .= " AND RazaoSocial LIKE '%" . $conn->real_escape_string($fabricante) . "%'";
    }

    if (!empty($data_inicio) && !empty($data_fim)) {
        $sql .= " AND DataEntrada BETWEEN '" . $conn->real_escape_string($data_inicio) . "' 
                  AND '" . $conn->real_escape_string($data_fim) . "'";
    }

    // Executa a consulta
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Entradas</title>
</head>
<body>

    <h2>Consultar Entradas</h2>

    <form method="GET" action="">
        <label>Fabricante:</label>
        <input type="text" name="fabricante" value="<?= htmlspecialchars($fabricante) ?>">
        
        <label>Data de Entrada (Início):</label>
        <input type="date" name="data_inicio" value="<?= htmlspecialchars($data_inicio) ?>">

        <label>Data de Entrada (Fim):</label>
        <input type="date" name="data_fim" value="<?= htmlspecialchars($data_fim) ?>">
        
        <button type="submit">Consultar</button>
    </form>

    <?php if ($result !== null): ?>
        <h3>Resultados:</h3>
        <table border="1">
            <tr>
                <th>Código Fornecedor</th>
                <th>Número NF</th>
                <th>Data Entrada</th>
                <th>Razão Social</th>
                <th>Fantasia</th>
                <th>Data Baixa</th>
                <th>Nome Baixa</th>
            </tr>
            
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["CodigoFornecedor"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["NumeroNF"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["DataEntrada"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["RazaoSocial"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Fantasia"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["DataBaixa"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["NomeBaixa"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum resultado encontrado.</td></tr>";
            }
            ?>
        </table>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>