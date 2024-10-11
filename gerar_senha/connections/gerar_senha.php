<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fila_senha";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    echo json_encode(['error' => $conn->connect_error]);
    exit();
}

// Obter a última senha
$sql_last_senha = "SELECT senha FROM senhas ORDER BY id DESC LIMIT 1";
$result_last_senha = $conn->query($sql_last_senha);

if ($result_last_senha->num_rows > 0) {
    $last_senha_row = $result_last_senha->fetch_assoc();
    $last_senha = intval(substr($last_senha_row['senha'], 1)); // Remover o "S" e converter para inteiro
} else {
    $last_senha = 0; // Se não houver senhas no banco, começa com 0
}

// Gerar nova senha incremental
$nova_senha = 'S' . str_pad($last_senha + 1, 4, '0', STR_PAD_LEFT);

$sql = "INSERT INTO senhas (senha) VALUES ('$nova_senha')";

if ($conn->query($sql) === TRUE) {
    // Obter senhas atuais
    $result = $conn->query("SELECT senha FROM senhas WHERE atendida = FALSE ORDER BY id ASC");
    $senhas = [];
    while ($row = $result->fetch_assoc()) {
        $senhas[] = $row['senha'];
    }

    $senha_atual = isset($senhas[0]) ? $senhas[0] : "Nenhuma";
    $proxima_senha = isset($senhas[1]) ? $senhas[1] : "Nenhuma";

    echo json_encode([
        'senha_atual' => $nova_senha,
        'proxima_senha' => $proxima_senha
    ]);
} else {
    echo json_encode(['error' => $conn->error]);
}

$conn->close();
?>
