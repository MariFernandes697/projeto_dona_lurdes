<?php
session_start();
require_once('../listar/conexao.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verifica se o pedido pertence ao usuário
$verifica = mysqli_query($conexao, "SELECT * FROM pedidos WHERE id = $pedido_id AND usuario_id = $usuario_id");

if (mysqli_num_rows($verifica) == 0) {
    echo "Pedido não encontrado ou acesso não autorizado.";
    exit();
}

// Busca os itens do pedido
$sql = "
    SELECT ip.quantidade, ip.preco_unitario, p.nome, p.imagem 
    FROM itens_pedido ip
    JOIN produtos p ON ip.produto_id = p.id
    WHERE ip.pedido_id = $pedido_id
";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Pedido</title>
    <link rel="stylesheet" href="html/loja_dona_lurdes/css/style.css">
    <style>
        .detalhes-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ccc;
        }

        .item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .info {
            flex-grow: 1;
        }

        .info p {
            margin: 4px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="detalhes-container">
    <h2>Detalhes do Pedido #<?php echo $pedido_id; ?></h2>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while ($item = mysqli_fetch_assoc($resultado)): ?>
            <div class="item">
                <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>">
                <div class="info">
                    <p><strong><?php echo $item['nome']; ?></strong></p>
                    <p>Quantidade: <?php echo $item['quantidade']; ?></p>
                    <p>Preço Unitário: R$ <?php echo number_format($item['preco_unitario'], 2, ',', '.'); ?></p>
                    <p>Subtotal: R$ <?php echo number_format($item['preco_unitario'] * $item['quantidade'], 2, ',', '.'); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Não há itens neste pedido.</p>
    <?php endif; ?>
</div>

</body>
</html>