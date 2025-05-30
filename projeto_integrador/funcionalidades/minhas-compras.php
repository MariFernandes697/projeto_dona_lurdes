<?php
session_start();
require_once('../listar/conexao.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT id, data_pedido, total, status FROM pedidos WHERE usuario_id = $usuario_id ORDER BY data_pedido DESC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras</title>
    <link rel="stylesheet" href="html/loja_dona_lurdes/css/style.css">
    <style>
        :root{
            --color01: #FFE9A3; 
            --color02: #A4C994;
            --color03: #634A1A; 
            --color04: #452409;
            --color05: #1C150A; 
        }
        .compras-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fefae0;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ccc;
        }
        .compras-container h2{
            font-size: 2em;
            color: var(--color04);
            font-family:  'Poppins', sans-serif;
            text-align: center;
        }
        .compras-container p {
            color: var(--color05);
            font-family: 'Poppins', sans-serif;
            font-size: 1.2em;
            text-align: justify;
        }
        .compra {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .compra:last-child {
            border-bottom: none;
        }
        .compra strong {
            display: inline-block;
            width: 130px;
        }
        .produto-item {
            margin-left: 20px;
            font-size: 1em;
            color: #333;
        }
        .botao-detalhes {
            margin-top: 10px;
            display: inline-block;
            background-color: #5cb85c;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .botao-detalhes:hover {
            background-color: #4cae4c;
        }
        .lista-produtos {
        background-color: #fff;
        border-left: 5px solid var(--color02);
        margin: 10px 0 20px 0;
        padding: 10px 20px;
        border-radius: 8px;
        list-style: none;
    }

    .lista-produtos li {
        padding: 6px 0;
        font-size: 1.4em;
        color: var(--color04);
        font-family: 'Poppins', sans-serif;
        border-bottom: 1px dashed #ddd;
        transition: transform 0.1s;
    }
    .lista-produtos li:hover{
        color: var(--color04);
        transform: scale(1.02);
    }

    .lista-produtos li:last-child {
        border-bottom: none;
    }
    </style>
</head>
<body>

<div class="compras-container">
    <h2>Minhas Compras</h2>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while($pedido = mysqli_fetch_assoc($resultado)): ?>
            <div class="produto-item">
                    <p><strong>Produtos:</strong></p>
                    <ul class="lista-produtos">
                        <?php
                        $pedido_id = $pedido['id'];
                        $sql_produtos = "
                            SELECT ip.produto_id, p.nome, ip.quantidade, ip.preco_unitario
                            FROM itens_pedido ip
                            JOIN produtos p ON ip.produto_id = p.id
                            WHERE ip.pedido_id = $pedido_id
                        ";
                        $res_produtos = mysqli_query($conexao, $sql_produtos);

                        while ($item = mysqli_fetch_assoc($res_produtos)) {
                           echo '<li>
        <a href="../ver-produto.php?id=' . $item['produto_id'] . '" style="text-decoration: none; color: inherit;">
            <strong>' . $item['nome'] . '</strong> - ' . $item['quantidade'] . 'x R$ ' . number_format($item['preco_unitario'], 2, ',', '.') . '
        </a>
      </li>';
                        }
                        ?>
                    </ul>
                </div>
            <div class="compra">
                <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($pedido['data_pedido'])); ?></p>
                <p><strong>Valor:</strong> R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($pedido['status']); ?></p>

            </div> 
        <?php endwhile; ?>
    <?php else: ?>
        <p>Você ainda não fez nenhuma compra.</p>
    <?php endif; ?>
</div>

</body>
</html>