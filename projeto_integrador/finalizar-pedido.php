<?php
session_start();
require_once 'listar/conexao.php'; // ou o caminho correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo = $_POST['metodo_pagamento'] ?? '';

    if ($metodo === 'cartao') {
    $nome = trim($_POST['nome_titular'] ?? '');
    $numero = preg_replace('/\D/', '', $_POST['numero_cartao'] ?? '');
    $validade = trim($_POST['validade'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');

    $erros = [];

    if (empty($nome)) $erros[] = "Nome do titular é obrigatório.";

    if (!preg_match('/^\d{16}$/', $numero)) $erros[] = "Número do cartão inválido.";

    if (!preg_match('/^\d{2}\/\d{2}$/', $validade)) {
        $erros[] = "Formato da validade inválido (use MM/AA).";
    } else {
        [$mes, $ano] = explode('/', $validade);
        $mes = (int)$mes;
        $ano = (int)$ano + 2000;
        $agora = new DateTime();
        $validadeData = DateTime::createFromFormat('Y-m', "$ano-$mes");

        if ($mes < 1 || $mes > 12 || $validadeData < $agora) {
            $erros[] = "Data de validade expirada.";
        }
    }

    if (!preg_match('/^\d{3,4}$/', $cvv)) $erros[] = "CVV inválido.";

    if (!empty($erros)) {
        echo "<h3>Erros no pagamento:</h3><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Voltar</a>";
        exit;
    }
}


    // Aqui entra o switch
    switch ($metodo) {
        case 'cartao':
            // Aqui você pode pegar os dados do cartão e salvar no banco (simulado)
            // Por segurança, você não deve salvar dados reais em produção
            break;

        case 'pix':
            // Você pode mostrar a chave ou QR Code (simulado)
            break;

        case 'presencial':
            // Marca o pedido como "pagamento na entrega"
            break;

        case 'mercado_pago':
            // Redireciona para o gateway Mercado Pago
            // Você pode chamar um outro arquivo que crie a "preferência" como aquele `pagamento_mercadopago.php`
            require 'pagamento_mercadopago.php';
            exit;

        default:
            echo "Método de pagamento inválido.";
            exit;
    }

    // Aqui você pode salvar o pedido no banco (status, total, itens...)
    // Redirecionar para página de sucesso
    // Suponha que aqui já foi verificado e aprovado (cartão, pix, presencial...)
if ($pagamento_aprovado) {
    header("Location: sucesso.php");
    exit;
} else {
    header("Location: falha.php");
    exit;
}
}
?>
