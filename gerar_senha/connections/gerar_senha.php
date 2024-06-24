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

// Gerar nova senha
$nova_senha = 'S' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
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
