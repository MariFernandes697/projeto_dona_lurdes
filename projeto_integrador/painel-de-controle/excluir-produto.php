// excluir_produto.php

<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('listar/conexao.php');

if (!isset($_GET['id'])) {
    echo "ID do produto não informado.";
    exit;
}

$id = intval($_GET['id']);
$query = "DELETE FROM produtos WHERE id = $id";

if (mysqli_query($conexao, $query)) {
    header("Location: listar-produtos.php?msg=excluido");
    exit;
} else {
    echo "Erro ao excluir o produto.";
}
?>