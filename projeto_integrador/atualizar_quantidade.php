<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id = $_POST['id'];
    $quantidade = (int) $_POST['quantidade'];

    if ($quantidade > 0 && isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] = $quantidade;
    }
}

header("Location: carrinho.php");
exit;
