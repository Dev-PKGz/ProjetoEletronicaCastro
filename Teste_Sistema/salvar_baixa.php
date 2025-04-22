<?php
// Conexão com o banco de dados
$host = "192.168.0.239";
$user = "admin";
$pass = "admin";
$dbname = "BaseNotas";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os valores foram recebidos corretamente
    var_dump($_POST);

    $codigoFornecedor = $_POST['CodigoFornecedor'];
    $numeroNF = $_POST['NumeroNF'];
    $dataEntrada = $_POST['DataEntrada'];
    $razaoSocial = $_POST['RazaoSocial'];
    $fantasia = $_POST['Fantasia'];
    $dataBaixa = $_POST['DataBaixa'];
    $nomeBaixa = $_POST['NomeBaixa'];

    // Query corrigida
    $query = "INSERT INTO entradas (CodigoFornecedor, NumeroNF, DataEntrada, RazaoSocial, Fantasia, DataBaixa, NomeBaixa) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    // Verifica se a preparação da query falhou
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Corrige o tipo de dado, caso necessário
    $stmt->bind_param("iisssss", $codigoFornecedor, $numeroNF, $dataEntrada, $razaoSocial, $fantasia, $dataBaixa, $nomeBaixa);

    if ($stmt->execute()) {
        echo "Entrada salva com sucesso!";
    } else {
        echo "Erro ao salvar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
