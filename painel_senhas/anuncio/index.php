<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Anúncio</title>
</head>
<body>
    <div class="container">
        <h2>Upload de Anúncio</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $targetDir = "uploads/";

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
                    echo "Anúncio carregado com sucesso!";
                } else {
                    echo "Erro ao carregar o arquivo.";
                }
            } else {
                echo "Tipo de arquivo não suportado. Por favor, envie uma imagem ou vídeo.";
            }
        }
        ?>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <label for="mediaFile">Selecione uma imagem ou vídeo para o anúncio:</label>
            <input type="file" name="mediaFile" id="mediaFile">
            <input type="submit" value="Carregar Anúncio">
        </form>
    </div>
</body>
</html>
