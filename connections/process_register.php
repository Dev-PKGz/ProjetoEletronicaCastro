<?php
session_start();
include 'acess_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sector = $_POST['sector'];

    // Verifica se o nome de usuário contém apenas letras
    if (!preg_match('/^[a-zA-Z]+$/', $user)) {
        header("Location: ../register?error=O nome de usuário deve conter apenas letras.");
        exit();
    }

    // Verifica se a senha tem pelo menos 6 caracteres
    if (strlen($pass) < 6) {
        header("Location: ../register?error=A senha deve ter pelo menos 6 caracteres.");
        exit();
    }

    // Verifica se a senha contém pelo menos um caractere especial
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pass)) {
        header("Location: ../register?error=A senha deve conter pelo menos um caractere especial.");
        exit();
    }

    // Verifica se o email já existe no banco de dados
    $check_email_sql = "SELECT * FROM users WHERE email = ?";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $result = $check_email_stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: ../register?error=O email já está em uso.");
        exit();
    }

    // Criptografa a senha antes de armazená-la no banco de dados
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password, sector) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $user, $email, $hashed_pass, $sector);

    if ($stmt->execute()) {
        $_SESSION['username'] = $user;
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../register?error=Erro ao registrar usuário");
        exit();
    }

    $stmt->close();
    $check_email_stmt->close();
}

$conn->close();
?>
