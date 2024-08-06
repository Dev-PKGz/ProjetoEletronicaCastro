<?php

// Função para atualizar o email do usuário
function updateEmail($conn, $id, $email) {
    $sql = "UPDATE users SET email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $id);
    
    if ($stmt->execute()) {
        echo "Email updated successfully.";
    } else {
        echo "Error updating email: " . $conn->error;
    }
}

// Função para atualizar a senha do usuário
function updatePassword($conn, $id, $password) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashedPassword, $id);
    
    if ($stmt->execute()) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

// Função para atualizar o setor do usuário
function updateSector($conn, $id, $sector) {
    $sql = "UPDATE users SET sector=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $sector, $id);
    
    if ($stmt->execute()) {
        echo "Sector updated successfully.";
    } else {
        echo "Error updating sector: " . $conn->error;
    }
}

// Função para excluir o usuário
function deleteUser($conn, $id) {
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Checando qual formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    
    if (isset($_POST['update_email'])) {
        $email = $_POST['email'];
        updateEmail($conn, $id, $email);
    } elseif (isset($_POST['update_password'])) {
        $password = $_POST['password'];
        updatePassword($conn, $id, $password);
    } elseif (isset($_POST['update_sector'])) {
        $sector = $_POST['sector'];
        updateSector($conn, $id, $sector);
    } elseif (isset($_POST['delete_user'])) {
        deleteUser($conn, $id);
    }
}

// Listando os usuários
$sql = "SELECT id, username, email, sector FROM users";
$result = $conn->query($sql);

?>