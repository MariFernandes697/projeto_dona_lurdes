<?php
session_start();
require_once('includes/header-carrinho.php');
?>
<?php print_r($_SESSION['carrinho'] ?? []); ?></pre> 

<!--Carrinho de Compras-->
<div class="corpo-categorias carrinho-de-compras">
    <!--Tabela Carrinho de Compras-->
    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
        </tr>

        <?php
        $total = 0;

        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $id => $produto) {
                $subtotal = $produto['preco'] * $produto['quantidade'];
                $total += $subtotal;
                ?>

                <tr>
                    <td>
                        <div class="carrinho-info">
                            <img src="<?php echo $produto['imagem']; ?>" alt="">
                            <div>
                                <p><?php echo $produto['nome']; ?></p>
                                <small>Valor: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></small>
                                <br>
                                <a href="listar/remover_do_carrinho.php?id=<?= $id ?>">Remover</a>

                            </div>
                        </div>
                    </td>
                    <td>
                       <form action="atualizar_quantidade.php" method="post">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" min="1" onchange="this.form.submit()">
                        </form>

                    </td>
                    <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                </tr>

                <?php
            }
        } else {
            echo '<tr><td colspan="3">Seu carrinho está vazio.</td></tr>';
        }
        ?>
    </table>

    <div class="valor-total">
        <table>
            <tr>
                <td>Sub-Total</td>
                <td>R$ <?= number_format($total, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Frete</td>
                <td>R$ 5,00</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>R$ <?= number_format($total + 5, 2, ',', '.') ?></td>
            </tr>

        </table>
        <div class="botao-final">
            <a class="botao-finalizar" href="funcionalidades/confirmar-pedido.php">Finalizar Compra</a>

        </div>
    </div>
</div>
<!--Fim- Carrinho de Compras-->

<?php require_once('includes/footer.php'); ?>
