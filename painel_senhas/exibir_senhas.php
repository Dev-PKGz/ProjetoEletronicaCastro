<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senhas da Fila</title>
</head>
<body>
    <div class="container">
        <div class="anuncios">
            <?php
            $lastUploadFile = './anuncio/uploads/last_upload.txt';
            
            if (file_exists($lastUploadFile)) {
                $mediaFile = './anuncio/uploads/' . file_get_contents($lastUploadFile);
                $fileType = strtolower(pathinfo($mediaFile, PATHINFO_EXTENSION));

                if ($fileType == "jpg" || $fileType == "jpeg" || $fileType == "png") {
                    echo "<img src='$mediaFile' alt='Anúncio'>";
                } elseif ($fileType == "mp4" || $fileType == "avi" || $fileType == "mov") {
                    echo "<video autoplay muted loop controls>
                            <source src='$mediaFile' type='video/$fileType'>
                            Seu navegador não suporta o elemento de vídeo.
                          </video>";
                } else {
                    echo "Nenhum anúncio disponível.";
                }
            } else {
                echo "Nenhum anúncio disponível.";
            }
            ?>
        </div>

        <div class="senha-container">
            <div class="senha">
                <h2>Senha Atual: <span id="senhaAtual"></span></h2>
            </div>
            <div class="senha">
                <h2>Próxima Senha: <span id="proximaSenha"></span></h2>
            </div>
        </div>
    </div>

    <!-- Adicionando o elemento de áudio -->
    <audio id="alertSound">
        <source src="sound/alert.mp3" type="audio/mpeg">
        Seu navegador não suporta áudio HTML5.
    </audio>

    <script src="javascript/exibir_senhas.js"></script>
</body>
</html>
