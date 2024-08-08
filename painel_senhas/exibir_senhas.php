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
            <div class="hora-atual" id="horaAtual">
                <!-- Horário atual será inserido aqui -->
            </div>
            <div class="senha">
                <h2>Senha Atual: <span id="senhaAtual">001</span></h2>
            </div>
            <div class="senha">
                <h2>Próxima Senha: <span id="proximaSenha">002</span></h2>
            </div>
        </div>
    </div>

    <!-- Adicionando o elemento de áudio -->
    <audio id="alertSound">
        <source src="sound/alert.mp3" type="audio/mpeg">
        Seu navegador não suporta áudio HTML5.
    </audio>

    <script>
        // Função para atualizar o horário atual
        function atualizarHora() {
            const elementoHora = document.getElementById('horaAtual');
            const agora = new Date();
            const hora = agora.getHours().toString().padStart(2, '0');
            const minutos = agora.getMinutes().toString().padStart(2, '0');
            const segundos = agora.getSeconds().toString().padStart(2, '0');
            elementoHora.textContent = `Horario: ${hora}:${minutos}:${segundos}`;
        }

        // Atualiza o horário a cada segundo
        setInterval(atualizarHora, 1000);

        // Simulação de atualização das senhas
        document.addEventListener('DOMContentLoaded', function() {
            const senhaAtual = document.getElementById('senhaAtual');
            const proximaSenha = document.getElementById('proximaSenha');

            let atual = 1;
            let proxima = 2;

            setInterval(() => {
                senhaAtual.textContent = String(atual).padStart(3, '0');
                proximaSenha.textContent = String(proxima).padStart(3, '0');
                atual++;
                proxima++;
            }, 5000); // Atualiza a cada 5 segundos
        });
    </script>
</body>
</html>
