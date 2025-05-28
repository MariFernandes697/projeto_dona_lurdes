<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('../listar/conexao.php');

// Consulta os pedidos com JOIN para puxar o nome do usuário
$sql = "SELECT p.id, u.nome AS cliente, p.data_pedido, p.total, p.status
        FROM pedidos p
        JOIN usuarios u ON p.usuario_id = u.id
        ORDER BY p.data_pedido DESC";

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ver Pedidos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fefae0;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #6c3900;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        th {
            background-color: #8b5e3c;
            color: white;
        }

        tr:hover {
            background-color: #f1ead0;
        }

        a {
            color: #6c3900;
            text-decoration: none;
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
    <h2>Pedidos Recebidos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Total</th>
            <th>Status</th>
            <th>Detalhes</th>
        </tr>
        <?php while ($pedido = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo htmlspecialchars($pedido['cliente']); ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                <td>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($pedido['status']); ?></td>
                <td><a href="detalhes-pedido.php?id=<?php echo $pedido['id']; ?>">Ver</a></td>
            </tr>
        <?php } ?>
    </table>

    <a class="voltar" href="painel-admin.php">Voltar ao Painel</a>
</body>
</html>