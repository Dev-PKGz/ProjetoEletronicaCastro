<?php

require_once '/xampp/htdocs/connections/check_page_access.php'; // Certifique-se de incluir o arquivo com as funções

// Verifica o acesso à página
check_page_access(['Ven', 'Dev', 'ecom']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Adicionar Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Anúncio</title>
</head>
<body>
    <div class="container">
        <h2>Upload de Anúncio</h2>
        <?php
        $targetDir = "uploads/";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica se o diretório existe, se não, cria o diretório.
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFile = $targetDir . basename($_FILES["mediaFile"]["name"]);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($fileType == "jpg" || $fileType == "jpeg" || $fileType == "png" || $fileType == "mp4" || $fileType == "avi" || $fileType == "mov") {
                if (move_uploaded_file($_FILES["mediaFile"]["tmp_name"], $targetFile)) {
                    // Salvar o nome do arquivo em um arquivo de texto para ser exibido na outra página
                    file_put_contents('uploads/last_upload.txt', basename($targetFile));
                    echo "<p>Anúncio carregado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao carregar o arquivo.</p>";
                }
            } else {
                echo "<p>Tipo de arquivo não suportado. Por favor, envie uma imagem ou vídeo.</p>";
            }
        }

        // Carregar o anúncio atual
        if (file_exists('uploads/last_upload.txt')) {
            $currentAd = file_get_contents('uploads/last_upload.txt');
            $currentAdPath = $targetDir . $currentAd;
            $fileType = strtolower(pathinfo($currentAdPath, PATHINFO_EXTENSION));

            echo "<div class='current-ad'>";
            echo "<h3>Anúncio Atual</h3>";

            // Botão de alternância do olho
            echo "<button id='toggleButton' class='eye-button'><i class='fas fa-eye'></i></button>";
            echo "<div id='adPreview' style='display: none;'>";

            if ($fileType == "jpg" || $fileType == "jpeg" || $fileType == "png") {
                echo "<img src='$currentAdPath' alt='Anúncio Atual' class='ad-thumbnail'>";
            } elseif ($fileType == "mp4" || $fileType == "avi" || $fileType == "mov") {
                echo "<video controls class='ad-thumbnail'>
                        <source src='$currentAdPath' type='video/$fileType'>
                        Seu navegador não suporta o elemento de vídeo.
                      </video>";
            }

            echo "</div></div>";
        }
        ?>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <label for="mediaFile">Selecione uma imagem ou vídeo para o anúncio:</label>
            <input type="file" name="mediaFile" id="mediaFile" required>
            <input type="submit" value="Carregar Anúncio">
        </form>
    </div>

    <script>
        // JavaScript para ocultar/mostrar o anúncio com ícones de olho
        document.getElementById('toggleButton').addEventListener('click', function() {
            var adPreview = document.getElementById('adPreview');
            var button = document.getElementById('toggleButton');
            var icon = button.querySelector('i');
            
            if (adPreview.style.display === 'none') {
                adPreview.style.display = 'block';
                icon.className = 'fas fa-eye-slash'; // Ícone de olho fechado
            } else {
                adPreview.style.display = 'none';
                icon.className = 'fas fa-eye'; // Ícone de olho aberto
            }
        });
    </script>
</body>
</html>
