<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Entradas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Cadastro de Entrada</h2>

    <form method="POST" action="salvar_baixa.php">
        <label for="numeroNF">Número NF:</label>
        <input type="text" id="numeroNF" name="NumeroNF" required>

        <label for="codigoFornecedor">Código Fornecedor:</label>
        <input type="text" id="codigoFornecedor" name="CodigoFornecedor" readonly>

        <label for="dataEntrada">Data Entrada:</label>
        <input type="text" id="dataEntrada" name="DataEntrada" readonly>

        <label for="razaoSocial">Razão Social:</label>
        <input type="text" id="razaoSocial" name="RazaoSocial" readonly>

        <label for="fantasia">Fantasia:</label>
        <input type="text" id="fantasia" name="Fantasia" readonly>

        <label for="dataBaixa">Data da Baixa:</label>
        <input type="date" id="dataBaixa" name="DataBaixa" required>

        <label for="nomeBaixa">Nome de Quem Baixou:</label>
        <input type="text" id="nomeBaixa" name="NomeBaixa" required>

        <button type="submit">Salvar</button>
    </form>

    <script>
       $(document).ready(function() {
    function buscarNota() {
        var numeroNF = $('#numeroNF').val().trim();

        if (numeroNF !== "") {
            $.ajax({
                url: 'buscar_nota.php',
                type: 'POST',
                data: { NumeroNF: numeroNF },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Debug no console

                    if (response.status === 'success') {
                        $('#codigoFornecedor').val(response.CodigoFornecedor);
                        $('#dataEntrada').val(response.DataEntrada);
                        $('#razaoSocial').val(response.RazaoSocial);
                        $('#fantasia').val(response.Fantasia);
                    } else {
                        alert(response.message || 'Nota Fiscal não encontrada.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Erro AJAX: ", xhr.responseText); // Debug
                    alert('Erro ao buscar a Nota Fiscal.');
                }
            });
        }
    }

    $('#numeroNF').on('keypress', function(event) {
        if (event.which == 13) { // Enter
            event.preventDefault();
            buscarNota();
        }
    });

    $('#numeroNF').on('blur', function() {
        buscarNota();
    });
});

    </script>

</body>
</html>
