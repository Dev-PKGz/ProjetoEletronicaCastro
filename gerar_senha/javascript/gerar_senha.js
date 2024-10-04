let isPrinting = false;
let isPrintTriggered = false;

function gerarSenha() {
    if (isPrinting) {
        console.log("Uma impressão já está em andamento. Aguarde.");
        return;
    }

    isPrinting = true;

    fetch('./connections/gerar_senha.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('message').innerText = 'Erro: ' + data.error;
                isPrinting = false;
            } else {
                const senha = data.senha_atual;
                document.getElementById('message').innerText = 'Senha gerada: ' + senha;
                imprimirSenha(senha);
            }
        })
        .catch(error => {
            document.getElementById('message').innerText = 'Erro na requisição: ' + error;
            isPrinting = false;
        });
}

function imprimirSenha(senha) {
    var janelaImpressao = window.open('', '', 'height=400,width=600');
    janelaImpressao.document.write('<html><head><title>Imprimir Senha</title>');
    janelaImpressao.document.write('<style>');
    janelaImpressao.document.write('@page { size: 80mm auto; margin: 0; }');
    janelaImpressao.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }');
    janelaImpressao.document.write('.ticket { text-align: center; padding: 10mm; width: 100%; box-sizing: border-box; }');
    janelaImpressao.document.write('.ticket h1 { margin-top: 10px; font-size: 40px; color: black; }');
    janelaImpressao.document.write('.ticket p { margin: 5px 0; font-size: 16px; color: black; }');
    janelaImpressao.document.write('</style>');
    janelaImpressao.document.write('</head><body>');
    janelaImpressao.document.write('<div class="ticket">');
    
    // Imagem principal
    janelaImpressao.document.write('<p>Senha</p>');
    janelaImpressao.document.write('<h1>' + senha + '</h1>');
    janelaImpressao.document.write('<p>------------------</p>');
    janelaImpressao.document.write('<p>Promoções</p>');
    
    // Placeholder para o QR Code
    janelaImpressao.document.write('<div id="qrcode"></div>');
    janelaImpressao.document.write('<p>' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '</p>');
    janelaImpressao.document.write('<p>------------------</p>');
    janelaImpressao.document.write('</div></body></html>');
    janelaImpressao.document.close();

    // Função para gerar o QR Code automaticamente
    function gerarQRCode() {
        var qrDiv = janelaImpressao.document.getElementById('qrcode');
        var qrcode = new QRCode(qrDiv, {
            text: "https://minhaempresa.com/senha?valor=" + senha, // O texto que você deseja codificar
            width: 128, // Largura do QR Code
            height: 128 // Altura do QR Code
        });

        // Checar se o QRCode foi gerado e então imprimir
        setTimeout(function() {
            janelaImpressao.focus();
            janelaImpressao.print();
            setTimeout(function() {
                janelaImpressao.close(); // Fecha a janela após a impressão
                isPrinting = false; // Libera para nova impressão
            }, 1000);
        }, 500); // Espera meio segundo para o QR Code ser gerado
    }

    // Chama a função de geração de QR Code
    gerarQRCode();
}
