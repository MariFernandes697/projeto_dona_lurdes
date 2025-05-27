<?php
session_start();
require_once('../listar/conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: minha_conta.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Busca os pedidos do usuário
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
            background-color: var(--color02);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ccc;
        }
        .compras-container h2, p{
            color: var(--color05);
            font-family: 'Poppins', sans-serif;
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

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<div class="compras-container">
    <h2>Minhas Compras</h2>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while($pedido = mysqli_fetch_assoc($resultado)): ?>
            <div class="compra">
                <p><strong>Pedido:</strong> #<?php echo $pedido['id']; ?></p>
                <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($pedido['data_pedido'])); ?></p>
                <p><strong>Valor:</strong> R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($pedido['status']); ?></p>
                <a href="detalhes_pedido.php?id=<?php echo $pedido['id']; ?>" class="botao-detalhes">Ver Detalhes</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Você ainda não fez nenhuma compra.</p>
    <?php endif; ?>
</div>

</body>
</html>