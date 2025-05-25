<?php
session_start();
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../index.php");
    exit;
}
$pedido_id = rand(1000, 9999); // Simulação de um número de pedido
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido Confirmado</title>
    <link rel="stylesheet" href="sucesso.css">
</head>
<body>
    <div class="sucesso-container">
        <h1>Pedido realizado com sucesso!</h1>
        <p>Obrigado, <strong><?= $_SESSION['usuario_nome'] ?></strong>! Seu pedido <strong>#<?= $pedido_id ?></strong> foi confirmado.</p>
        <p>Logo mais ele estará chegando com todo o carinho da Dona Lurdes.</p>
        <a href="../index.php" class="botao-voltar">Voltar para a loja</a>
    </div>
</body>
</html>
