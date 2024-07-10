<?php
include('../connections/acess_db.php');

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
    }
}

// Listando os usuários
$sql = "SELECT id, username, email, sector FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="modal.css">
    <script>
        function showModal(userId) {
            document.getElementById('modal').style.display = 'flex';
            document.getElementById('user-id').value = userId;
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
                // Fecha o modal clicando fora dele (na área escura)
                window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>

        <h3>Users List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Sector</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["sector"]."</td><td><button onclick='showModal(".$row["id"].")'>Alterar</button></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </table>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form method="post" action="index.php">
                    <input type="hidden" id="user-id" name="id">
                    
                    <h3>Update Email</h3>
                    <label for="email">Email:</label>
                    <input type="email" name="email"><br><br>
                    <input type="submit" name="update_email" value="Update Email"><br><br>
                    
                    <h3>Update Password</h3>
                    <label for="password">Password:</label>
                    <input type="password" name="password"><br><br>
                    <input type="submit" name="update_password" value="Update Password"><br><br>
                    
                    <h3>Update Sector</h3>
                    <label for="sector">Sector:</label>
                    <select name="sector">
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="IT">IT</option>
                        <option value="Marketing">Marketing</option>
                    </select><br><br>
                    <input type="submit" name="update_sector" value="Update Sector"><br><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
