<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : 1;

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$id] = [
            'nome' => $nome,
            'preco' => $preco,
            'imagem' => $imagem,
            'quantidade' => $quantidade
        ];
    }

    header("Location: carrinho.php");
    exit;
} else {
    echo "Requisição inválida.";
}
