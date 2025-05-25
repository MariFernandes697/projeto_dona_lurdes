<?php
session_start();

// Verifica se a Dona Lurdes está logada
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: login-admin.php");
    exit;
}

require_once '../listar/conexao.php';

// Busca os pedidos
$sql = "SELECT p.id, p.usuario_id, p.total, p.metodo_pagamento, p.status, p.data_criacao, u.nome AS nome_cliente
        FROM pedidos p
        JOIN usuarios u ON p.usuario_id = u.id
        ORDER BY p.data_criacao DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="estilo-admin.css?v=3">
</head>
<body>
    <div class="container-login">
        <h2>Bem-vinda, Dona Lurdes!</h2>
        <h3>Pedidos recentes:</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:20px; font-size:14px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Valor Total</th>
                    <th>Método</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while($pedido = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>{$pedido['id']}</td>
                                <td>{$pedido['nome_cliente']}</td>
                                <td>R$ ".number_format($pedido['total'], 2, ',', '.')."</td>
                                <td>{$pedido['metodo_pagamento']}</td>
                                <td>{$pedido['status']}</td>
                                <td>".date('d/m/Y H:i', strtotime($pedido['data_criacao']))."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum pedido encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br><br>
        <form action="logout-admin.php" method="post">
            <button type="submit">Sair do Painel</button>
        </form>
    </div>
</body>
</html>
