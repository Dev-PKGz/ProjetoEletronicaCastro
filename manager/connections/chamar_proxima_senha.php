<?php
session_start();

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

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    die("Usuário não está logado.");
}

// Nome do usuário logado
$usuario = $_SESSION['username'];

// Marcar a senha atual como atendida com o nome do usuário
$conn->query("UPDATE senhas SET atendida = TRUE, usuario_atendeu = '$usuario' WHERE atendida = FALSE ORDER BY id ASC LIMIT 1");

// Obter senhas atuais
$result = $conn->query("SELECT senha FROM senhas WHERE atendida = FALSE ORDER BY id ASC");
$senhas = [];
while ($row = $result->fetch_assoc()) {
    $senhas[] = $row['senha'];
}

$senha_atual = isset($senhas[0]) ? $senhas[0] : "Nenhuma senha na fila";
$proxima_senha = isset($senhas[1]) ? $senhas[1] : "Nenhuma senha na fila";

$message = $senha_atual == "Nenhuma senha na fila" ? "Nenhuma senha na fila" : "Próxima senha chamada!";

echo json_encode([
    'senha_atual' => $senha_atual,
    'proxima_senha' => $proxima_senha,
    'message' => $message
]);

$conn->close();
?>
