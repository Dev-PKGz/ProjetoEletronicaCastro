<?php

echo "Iniciando envio automático...\n";

$token = 'b5e584ab-ca30-4adb-98bf-a9b9a39f2fa8';

// Conexão com o banco
$pdo = new PDO("mysql:host=192.168.0.239;dbname=automatizacao", "admin", "admin");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

while (true) {
    echo "Verificando novos clientes...\n";

    // Buscar clientes sem mensagem enviada
    $stmt = $pdo->query("SELECT * FROM clientes WHERE mensagem_enviada = 0");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($clientes) === 0) {
        echo "Nenhum cliente pendente. Aguardando...\n";
        sleep(30); // Espera 30 segundos antes de checar de novo
        continue;
    }

    foreach ($clientes as $cliente) {
        $telefone = '55' . preg_replace('/\D/', '', $cliente['telefone']);
        $first_name = $cliente['nome'];
        $last_name = $cliente['sobrenome'];

        // 1. Criar o subscriber
        $subscriberData = [
            'phone' => $telefone,
            'first_name' => $first_name,
            'last_name' => $last_name
        ];

        $ch = curl_init("https://backend.botconversa.com.br/api/v1/webhook/subscriber/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "API-KEY: $token"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($subscriberData));

        $response = curl_exec($ch);
        curl_close($ch);

        $subscriberResponse = json_decode($response, true);

        if (isset($subscriberResponse['id'])) {
            $subscriber_id = $subscriberResponse['id'];

            // 2. Enviar o flow
            $flowData = ['flow' => 6913223];

            $ch = curl_init("https://backend.botconversa.com.br/api/v1/webhook/subscriber/$subscriber_id/send_flow/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "API-KEY: $token"
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($flowData));

            $flowResponse = curl_exec($ch);
            curl_close($ch);

            echo "Flow enviado para {$cliente['nome']} ({$telefone})\n";

            // 3. Marcar como enviado
            $update = $pdo->prepare("UPDATE clientes SET mensagem_enviada = 1 WHERE id = ?");
            $update->execute([$cliente['id']]);
        } else {
            echo "Erro ao enviar para {$cliente['telefone']}:\n";
            var_dump($subscriberResponse);
        }
    }

    echo "Aguardando novos cadastros...\n";
    sleep(30); // Pausa antes de repetir o loop
}
