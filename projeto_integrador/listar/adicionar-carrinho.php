<?php
session_start();

// Verifica se os dados foram enviados via POST
if (isset($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['quantidade'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    // Estrutura do item
    $item = [
        'id' => $id,
        'nome' => $nome,
        'preco' => $preco,
        'quantidade' => $quantidade
    ];

    // Se já houver um carrinho na sessão, adiciona ou atualiza
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$id] = $item;
    }

    // Redireciona para o carrinho ou outra página
    header("Location: carrinho.php");
    exit;
} else {
    echo "Dados incompletos!";
}
?>
