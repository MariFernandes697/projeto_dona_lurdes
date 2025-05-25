<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Não Aprovado</title>
    <link rel="stylesheet" href="falha.css">
</head>
<body>
    <div class="erro-container">
        <h1>Ops! Algo deu errado...</h1>
        <p>Infelizmente, o pagamento não foi aprovado.</p>
        <p>Verifique os dados informados e tente novamente.</p>
        <a href="../funcionalidades/confirmar-pedido.php" class="botao-tentar">Tentar novamente</a>
        <a href="../index.php" class="botao-voltar">Voltar à loja</a>
    </div>
</body>
</html>
