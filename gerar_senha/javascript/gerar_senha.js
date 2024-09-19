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
    janelaImpressao.document.write('</head><body >');
    janelaImpressao.document.write('<h1>Senha Gerada: ' + senha + '</h1>');
    janelaImpressao.document.write('</body></html>');
    janelaImpressao.document.close();
    janelaImpressao.focus();

        // Dispara a impressão automaticamente sem caixa de diálog
    janelaImpressao.print();
    janelaImpressao.close();
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