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
    janelaImpressao.print();
}
