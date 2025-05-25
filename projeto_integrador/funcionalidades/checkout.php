<?php
require_once('includes/header-carrinho.php');
session_start();
?>

<div class="corpo-categorias carrinho-de-compras">
    <h2>Finalizar Compra</h2>
    <form action="processar_pedido.php" method="post">
        <label>Nome Completo:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Endereço:</label><br>
        <input type="text" name="endereco" required><br><br>

        <button type="submit" class="botao">Finalizar Pedido</button>
    </form>
</div>

<?php require_once('includes/footer.php'); ?>
