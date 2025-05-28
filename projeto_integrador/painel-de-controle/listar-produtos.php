<?php
session_start();

if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('../listar/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="../html/loja_dona_lurdes/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fffaf5;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #6a1f10;
            margin-bottom: 30px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px #ccc;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #6a1f10;
            color: white;
        }
        a.botao {
            background-color: #a9441e;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 2px;
            display: inline-block;
        }
        a.botao:hover {
            background-color: #872f0c;
        }
        .voltar {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c3900;
        }
    </style>
</head>
<body>

<h2>Lista de Produtos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    <?php
    $query = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $query);

    while ($produto = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>{$produto['id']}</td>";
        echo "<td>{$produto['nome']}</td>";
        echo "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
        echo "<td>{$produto['categoria']}</td>";
        echo "<td>
                <a class='botao' href='editar-produto.php?id={$produto['id']}'>Editar</a>
                <a class='botao' href='excluir-produto.php?id={$produto['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este produto?')\">Excluir</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
    <a class="voltar" href="painel-admin.php">Voltar ao Painel</a>

</body>
</html>