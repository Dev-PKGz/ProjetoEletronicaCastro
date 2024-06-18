let lastProximaSenha = '';

        function atualizarSenhas() {
            fetch('./connections/obter_senhas.php')
                .then(response => response.json())
                .then(data => {
                    const senhaAtualElement = document.getElementById('senhaAtual');
                    const proximaSenhaElement = document.getElementById('proximaSenha');

                    // Verificar se a próxima senha mudou
                    if (data.proxima_senha !== lastProximaSenha) {
                        lastProximaSenha = data.proxima_senha;

                        // Tocar o som
                        const audio = document.getElementById('alertSound');
                        audio.currentTime = 0;  // Reinicia o áudio se já estiver tocando
                        audio.play();
                    }

                    senhaAtualElement.innerText = data.senha_atual;
                    proximaSenhaElement.innerText = data.proxima_senha;

                    // Adicionar classe de erro se não houver senha na fila
                    senhaAtualElement.classList.toggle('error', data.senha_atual === "Nenhuma senha na fila");
                    proximaSenhaElement.classList.toggle('error', data.proxima_senha === "Nenhuma senha na fila");
                });
        }

        setInterval(atualizarSenhas, 1000);  // Atualiza a cada 1 segundo
        window.onload = atualizarSenhas;