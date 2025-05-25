
<?php
session_start();
require_once '../listar/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: minha-conta.php");
    exit;
}

// Verifica se o carrinho tem itens
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    echo "<h3>Seu carrinho está vazio.</h3>";
    echo "<a href='../index.php'>Voltar para loja</a>";
    exit;
}

// Recupera dados do usuário
$usuario_nome = $_SESSION['usuario_nome'];
$usuario_email = ''; // opcional, se você armazenar o email na sessão

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação do Pedido</title>
    <link rel="stylesheet" href="confirmar-pedido.css?v=2"> 
</head>
<body>
    <div class="container">
        <h2>Confirmar Pedido</h2>
        <p><strong>Cliente:</strong> <?= $usuario_nome ?></p>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['carrinho'] as $produto_id => $item) {
                    $nome = $item['nome'];
                    $quantidade = $item['quantidade'];
                    $preco = $item['preco'];
                    $subtotal = $quantidade * $preco;
                    $total += $subtotal;
                    echo "<tr>
                        <td data-label='Produto'>$nome</td>
                        <td data-label='Quantidade'>$quantidade</td>
                        <td data-label='Subtotal'>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                    </tr>";

                }
                ?>
                <tr>
                    <td colspan='2' data-label='Total'><strong>Total</strong></td>
                    <td data-label='Total'><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
                </tr>

            </tbody>
        </table>

        <form action="../finalizar-pedido.php" method="POST">
            <button type="submit" name="confirmar">Confirmar e Finalizar</button>
        </form>

        <br>
        <a href="../carrinho.php">Voltar ao carrinho</a>
    </div>

