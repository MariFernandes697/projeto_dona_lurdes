<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('../listar/conexao.php');

if (!isset($_GET['id'])) {
    echo "ID do pedido não fornecido.";
    exit;
}

$idPedido = intval($_GET['id']);
$mensagem = "";

// Atualiza o status do pedido se enviado pelo form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $novoStatus = $_POST['status'];
    $sqlUpdate = "UPDATE pedidos SET status = ? WHERE id = ?";
    $stmtUpdate = $conexao->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $novoStatus, $idPedido);

    if ($stmtUpdate->execute()) {
        $mensagem = "Status atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar o status.";
    }
}

// Recarrega os dados atualizados do pedido
$sqlPedido = "SELECT * FROM pedidos WHERE id = ?";
$stmtPedido = $conexao->prepare($sqlPedido);
$stmtPedido->bind_param("i", $idPedido);
$stmtPedido->execute();
$resultadoPedido = $stmtPedido->get_result();
$pedido = $resultadoPedido->fetch_assoc();

if (!$pedido) {
    echo "Pedido não encontrado.";
    exit;
}

$sqlItens = "SELECT p.nome, p.preco, ip.quantidade
             FROM itens_pedido ip
             JOIN produtos p ON ip.produto_id = p.id
             WHERE ip.pedido_id = ?";
$stmtItens = $conexao->prepare($sqlItens);
$stmtItens->bind_param("i", $idPedido);
$stmtItens->execute();
$resultadoItens = $stmtItens->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Pedido</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fefae0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            background: #fff;
            padding: 30px;
            margin: 30px auto;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            color: #6c3900;
            margin-bottom: 20px;
        }

        .info-pedido {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background-color: #8b5e3c;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f8f4e3;
        }

        .form-status {
            margin-top: 15px;
        }

        select, button {
            padding: 8px 12px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .mensagem {
            color: green;
            margin-bottom: 15px;
        }

        .btn-voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #8b5e3c;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-voltar:hover {
            background-color: #a66b43;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalhes do Pedido #<?php echo $pedido['id']; ?></h2>

        <?php if ($mensagem): ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <div class="info-pedido">
            <strong>Nome do cliente:</strong> <?php echo $pedido['usuario_id']; ?><br>
            <strong>Email:</strong> <?php echo $pedido['email']; ?><br>
            <strong>Data:</strong> <?php echo date("d/m/Y H:i", strtotime($pedido['data_pedido'])); ?><br>

            <form class="form-status" method="POST">
                <label for="status"><strong>Status do Pedido:</strong></label><br>
                <select name="status" id="status">
                    <option value="Pendente" <?= $pedido['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="Em andamento" <?= $pedido['status'] === 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                    <option value="Enviado" <?= $pedido['status'] === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
                    <option value="Concluído" <?= $pedido['status'] === 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                    <option value="Cancelado" <?= $pedido['status'] === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
                <button type="submit">Atualizar Status</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($item = $resultadoItens->fetch_assoc()):
                    $subtotal = $item['quantidade'] * $item['preco'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $item['nome']; ?></td>
                    <td><?php echo $item['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <th colspan="3">Total</th>
                    <th>R$ <?php echo number_format($total, 2, ',', '.'); ?></th>
                </tr>
            </tbody>
        </table>

        <a class="btn-voltar" href="ver-pedido.php">← Voltar para pedidos</a>
    </div>
</body>
</html>
