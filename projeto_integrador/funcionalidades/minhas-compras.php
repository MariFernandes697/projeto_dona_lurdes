<?php
session_start();
require_once '../listar/conexao.php';

// Verifica se o cliente está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta os pedidos do usuário
$sql = "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY data_criacao DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras - Armazém da Dona Lurdes</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Minhas Compras</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID do Pedido</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Método</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($pedido = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido['data_criacao'])) ?></td>
                            <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                            <td><?= $pedido['status'] ?></td>
                            <td><?= $pedido['metodo_pagamento'] ?></td>
                            <td><a href="ver-pedido.php?id=<?= $pedido['id'] ?>">Ver detalhes</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php endif; ?>
    </div>
</body>
</html>
