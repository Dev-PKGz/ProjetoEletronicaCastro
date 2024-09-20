function gerarSenha() {
    fetch('./connections/gerar_senha.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('message').innerText = 'Erro: ' + data.error;
            } else {
                const senha = data.senha_atual;
                document.getElementById('message').innerText = 'Senha gerada: ' + senha;
                imprimirSenha(senha);
            }
        })
        .catch(error => {
            document.getElementById('message').innerText = 'Erro na requisição: ' + error;
        });
}

function imprimirSenha(senha) {
    var janelaImpressao = window.open('', '', 'height=400,width=600');
    janelaImpressao.document.write('<html><head><title>Imprimir Senha</title>');
    janelaImpressao.document.write('<style>');
    janelaImpressao.document.write('@page { size: 80mm auto; margin: 0; }');
    janelaImpressao.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }');
    janelaImpressao.document.write('.ticket { text-align: center; padding: 10mm; width: 100%; box-sizing: border-box; }');
    janelaImpressao.document.write('.ticket img { max-width: 100%; height: auto; margin-bottom: 10mm; }');
    janelaImpressao.document.write('.ticket h1 { margin-top: 10px; font-size: 60px; color: black; }');
    janelaImpressao.document.write('.ticket p { margin: 5px 0; font-size: 18px; color: black; }');
    janelaImpressao.document.write('</style>');
    janelaImpressao.document.write('</head><body>');
    janelaImpressao.document.write('<div class="ticket">');
    janelaImpressao.document.write('<img src="https://i.ibb.co/gzYdQn3/preto-e-branco.png">');
    janelaImpressao.document.write('<p>------------------</p>');
    janelaImpressao.document.write('<p>Senha</p>');
    janelaImpressao.document.write('<br>');
    janelaImpressao.document.write('<h1>' + senha + '</h1>');
    janelaImpressao.document.write('<br>');
    janelaImpressao.document.write('<p>------------------</p>');
    janelaImpressao.document.write('<p>Não Perca Nossas Novidades:</p>');
    // Insira a imagem do QR Code
    janelaImpressao.document.write('<img src="https://qr.io/qr-svg/shXpwv.svg?1726841050633" alt="QR Code">');
    
    janelaImpressao.document.write('<p>' + new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString() + '</p>');
    janelaImpressao.document.write('<br>');
    janelaImpressao.document.write('<p>------------------</p>');
    janelaImpressao.document.write('</div>');
    janelaImpressao.document.write('</body></html>');
    janelaImpressao.document.close();
    janelaImpressao.print();
}



// Exemplo com o SDK da Epson
function imprimirSenhaEpson(senha) {
    const epos = new epos.EPOSPrinter();
    epos.connect('USB', function (status) {
        if (status === 'OK') {
            epos.addTextSize(2, 2);
            epos.addTextAlign(epos.ALIGN_CENTER);
            epos.addText('Senha: ' + senha + '\n\n');
            epos.addFeedLine(1);
            epos.addCut(epos.CUT_FEED);
            epos.send();
        } else {
            console.error('Erro na conexão com a impressora.');
        }
    });
}