<?php
session_start();
require_once 'listar/conexao.php'; 

// Se o usuário não estiver logado, redireciona pra minha-conta.php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: minha-conta.php?redirect=finalizar-pedido.php');
    exit;
}


if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    echo "Carrinho vazio!";
    exit;
}

// Simulando usuário 
$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
    echo "Você precisa estar logado para finalizar o pedido.";
    exit;
}
$data_pedido = date('Y-m-d H:i:s');

// 1. Inserir pedido
$sql_pedido = "INSERT INTO pedidos (usuario_id, data_pedido) VALUES ($usuario_id, '$data_pedido')";
if (mysqli_query($conexao, $sql_pedido)) {
    $pedido_id = mysqli_insert_id($conexao);

    // 2. Inserir itens do pedido
    foreach ($_SESSION['carrinho'] as $produto_id => $item) {
        $quantidade = $item['quantidade'];

        $sql_item = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade) 
                     VALUES ($pedido_id, $produto_id, $quantidade)";
        mysqli_query($conexao, $sql_item);
    }

    // 3. Limpar o carrinho
    unset($_SESSION['carrinho']);
    
    echo "<h2>Pedido realizado com sucesso! Pedido #$pedido_id</h2>";
    echo "<a href='index.php'>Voltar para a loja</a>";
} else {
    echo "Erro ao cadastrar pedido: " . mysqli_error($conexao);
}
?>
