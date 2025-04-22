<?php
header('Content-Type: application/json');

$host = "192.168.0.239";
$user = "admin"; // Substitua se necessário
$pass = "admin";
$dbname = "BaseNotas";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Falha na conexão com o banco de dados']));
}

// Verifica se o NumeroNF foi recebido corretamente
if (!isset($_POST['NumeroNF']) || empty($_POST['NumeroNF'])) {
    echo json_encode(['status' => 'error', 'message' => 'NumeroNF não recebido']);
    exit;
}

$numeroNF = $_POST['NumeroNF'];

// Verifica se a conexão está ativa
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Erro na conexão com o banco']);
    exit;
}

// Debug: Exibir a consulta
$query = "SELECT CodigoFornecedor, NumeroNF, DataEntrada, RazaoSocial, Fantasia FROM notasfiscais WHERE NumeroNF = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da query']);
    exit;
}

$stmt->bind_param("s", $numeroNF);
$stmt->execute();
$result = $stmt->get_result();

// Debug: Verificar se encontrou registros
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status' => 'success'] + $row);
} else {
    echo json_encode(['status' => 'not_found', 'message' => 'Nenhum registro encontrado']);
}

$conn->close();
?>
