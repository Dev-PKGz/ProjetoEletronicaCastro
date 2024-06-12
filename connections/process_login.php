<?php
session_start();
include 'acess_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['sector'] = $row['sector'];
            header("Location: /home");
            exit();
        } else {
            header("Location: /index.php?error=Senha incorreta");
            exit();
        }
    } else {
        header("Location: /index.php?error=E-mail não encontrado");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
