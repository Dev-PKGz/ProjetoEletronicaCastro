<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fila_senha";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter senhas atuais
$result = $conn->query("SELECT senha FROM senhas WHERE atendida = FALSE ORDER BY id ASC");
$senhas = [];
while ($row = $result->fetch_assoc()) {
    $senhas[] = $row['senha'];
}

$senha_atual = isset($senhas[0]) ? $senhas[0] : "Nenhuma senha na fila";
$proxima_senha = isset($senhas[1]) ? $senhas[1] : "Nenhuma senha na fila";

echo json_encode([
    'senha_atual' => $senha_atual,
    'proxima_senha' => $proxima_senha
]);

$conn->close();
?>
